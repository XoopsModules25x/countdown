<?php

function showCountdown($options){

	$block=array();
	$block['event_id'] = $options[1];
    return $block;
}

function editCountdown($options){
    // require_once dirname(__DIR__) . '/class/Events.php';
   // $moduleDirName = basename(dirname(__DIR__));
	
	$form = _MB_COUNTDOWN_EVENTTODISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />";
    $form .= " <input name='options[1]' size='5' maxlength='255' value='" . $options[1] . "' type='text' />&nbsp;<br>";

    return $form;

}

?>