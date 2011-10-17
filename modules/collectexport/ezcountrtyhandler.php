<?php

include_once('extension/collectexport/modules/collectexport/basehandler.php');

class eZCountryHandler extends BaseHandler {
	function exportAttribute(&$attribute, $seperationChar) {
		$ret = false;
		$objectAttribute = $attribute->contentObjectAttribute();
		$objectAttributeContent = $objectAttribute->content();
		if($objectAttributeContent['value'])
			$ret = $objectAttributeContent['value'][$attribute->DataText]['Name'];
		return $this->escape($ret, $seperationChar);
	}
}
?>