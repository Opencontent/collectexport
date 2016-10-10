<?php

class eZEmailHandler extends BaseHandler {

	function exportAttribute(&$attribute, $seperationChar) {
		
		return $this->escape($attribute->content(), $seperationChar);
	}

}

?>
