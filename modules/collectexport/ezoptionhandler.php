<?php

include_once('extension/collectexport/modules/collectexport/basehandler.php');

class eZOptionHandler extends BaseHandler {

	function exportAttribute(&$attribute, $seperationChar) {
		$ret = false;
		$objectAttribute = $attribute->contentObjectAttribute();
		$objectAttributeContent = $objectAttribute->content();
		if($objectAttributeContent->Options)
			$ret = $objectAttributeContent->Options[$attribute->DataInt]['value'];
		return $this->escape($ret, $seperationChar);
		
   }
}

?>