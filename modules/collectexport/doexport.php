<?php

header("Content-type:text/csv; charset=utf-8");

$http = eZHTTPTool::instance();
$module = $Params['Module'];
$objectID = $Params['ObjectID'];

$object = false;

if( is_numeric( $objectID ) )
{
    $object = eZContentObject::fetch( $objectID );
}

if( !$object )
{
    return $module->handleError( EZ_ERROR_KERNEL_NOT_AVAILABLE, 'kernel' );
}

$conditions = array( 'contentobject_id' => $objectID  );

$start = false;
$end = false;
if ( $http->hasPostVariable( "start_year" ) )
{
    $start = mktime( 0,0,0, (int)$http->postVariable("start_month"), (int)$http->postVariable("start_day"), (int)$http->postVariable("start_year") );
}
if ( $http->hasPostVariable( "end_year" ) )
{
    $end = mktime( 0,0,0, (int)$http->postVariable("end_month"), (int)$http->postVariable("end_day"), (int)$http->postVariable("end_year") );
}
//@luca vedi http://bugs.php.net/bug.php?id=52154
if ( $start !== false and $start !== 943916400 and $end !== false and $end !== 943916400 )
{
    $conditions['created'] = array( false, array( $start, $end ) );
}
elseif ( $start !== false and $end === false )
{
    $conditions['created'] = array( '>', $start );
}
elseif ( $start === false and $end !== false )
{
    $conditions['created'] = array( '<', $end );
}
set_time_limit( 180 );
$collections = eZPersistentObject::fetchObjectList( eZInformationCollection::definition(),
    null,
    $conditions,
    false,
    false );

$counter=0;
$attributes_to_export=array();
while (true) {
    $currentattribute=$http->postVariable("field_$counter");
    if (!$currentattribute) {
        break;
    }
    $attributes_to_export[]=$currentattribute;
    $counter++;
}

$seperation_char = $http->postVariable("separation_char");
$export_type = $http->postVariable("export_type");
$parser=new Parser();

$date_export = date("d-m-Y");
$contentobject = eZContentObject::fetch($objectID);

eZDebug::writeDebug($contentobject);

switch($export_type){
    case 'csv':
        $filename = "export_". $date_export .".csv";
        break;
    case 'sylk':
        $filename = "export_". $date_export .".slk";
        break;
    default :
        $filename = "export_". $date_export .".csv";
        break;
}
header("Content-Disposition: attachment; filename=$filename");

$export_string=$parser->exportInformationCollection( $collections, $attributes_to_export, $seperation_char, $export_type, $objectID);

echo($export_string);

eZExecution::cleanExit();

