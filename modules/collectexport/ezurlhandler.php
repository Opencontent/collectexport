<?php

class eZURLHandler extends BaseHandler {

	function exportAttribute(&$attribute, $seperationChar) {
		$tempstring=$attribute->content() . $seperationChar . $attribute->DataText;
		return $this->escape($tempstring, $seperationChar);
	}
}

?>
