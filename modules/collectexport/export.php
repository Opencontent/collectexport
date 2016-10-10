<?php

$http = eZHTTPTool::instance();
$module = $Params['Module'];
$objectID = $Params['ObjectID'];

$object = false;

if( !isset( $offset ) )
{
    $offset = false;
}

if( is_numeric( $objectID ) )
{
    $object = eZContentObject::fetch( $objectID );
}

if( !$object )
{
    return $module->handleError( EZ_ERROR_KERNEL_NOT_AVAILABLE, 'kernel' );
}

$collections = eZInformationCollection::fetchCollectionsList( $objectID, /* object id */
                                                              false, /* creator id */
                                                              false, /* user identifier */
                                                              array() /* limit array */ );

$numberOfCollections = eZInformationCollection::fetchCollectionsCount( $objectID );

$viewParameters = array( 'offset' => $offset );
$objectName = $object->attribute( 'name' );

$tpl = eZTemplate::factory();
$tpl->setVariable( 'module', $module );
$tpl->setVariable( 'object', $object );
$tpl->setVariable( 'collection_array', $collections );
$tpl->setVariable( 'collection_count', $numberOfCollections );
$tpl->setVariable( 'end_day', date('d') );
$tpl->setVariable( 'end_month', date('m') );
$tpl->setVariable( 'end_year', date('Y') );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:collectexport/export.tpl' );
$Result['path'] = array( array( 'url' => '/collectexport/overview',
                                'text' => ezpI18n::tr( 'extension/collectexport', 'Collected information export' ) ),
                         array( 'url' => false,
                                'text' => $objectName ) );

?>
