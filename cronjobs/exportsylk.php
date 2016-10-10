<?php
$ini = eZINI::instance( "cie.ini" );

$debug = $ini->variable( 'CieSettings', 'Debug' ) == 'enabled' ? true : false;
$collection = $ini->variable( "CieSettings", "Collection" );
$dir = $ini->variable( "CieSettings", "Directory" );
$format = $ini->variable( "CieSettings", "SylkFormat" );
$separator = $ini->variable( "CieSettings", "SylkSeparator" );
$limitedRange = $ini->variable( "CieSettings", "ExportLimitedRange" ) == 'enabled' ? true : false;
$removeExported = $ini->variable( "CieSettings", "RemoveExported" ) == 'enabled' ? true : false;

if( $limitedRange == true ) {
    $days = $ini->variable( "CieSettings", "DateRangeToExport" );
} else {
    $days = false;
}


// Export collections

exportCollections( $collection, $dir, $format, $separator, $days, $removeExported, $debug );

?>
