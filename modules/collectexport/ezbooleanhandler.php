<?php

include_once('extension/collectexport/modules/collectexport/basehandler.php');

class eZBooleanHandler extends BaseHandler {

    function exportAttribute(&$attribute, $seperationChar) {
		if($attribute->content() == 1)
        	return $this->escape('Yes', $seperationChar);
		else
			return $this->escape('No', $seperationChar);
		//return $this->escape($attribute->content(), $seperationChar);
    }

}

?>