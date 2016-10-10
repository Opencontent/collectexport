<?php

class eZStringHandler extends BaseHandler {
	function exportAttribute(&$attribute, $seperationChar) {
		return $this->escape($attribute->content(), $seperationChar);		
	}
}
?>
