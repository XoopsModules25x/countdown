<?php

function showCountdown($options){

	$block=array();
	$block['event_id'] = $options[1];
	$selected_id=$block['event_id'];
	
	$result = $GLOBALS['xoopsDB']->query("SELECT * FROM ".$GLOBALS['xoopsDB']->prefix("countdown_events")." WHERE event_id IN ($selected_id)"); 

	while($row=$GLOBALS['xoopsDB']->fetchArray($result)) {
				$block['id']                = $row['event_id'];
                $block['uid']               = $row['event_uid'];
				$memberHandler 			    = xoops_getHandler('member');
				$myevent        		    = $memberHandler->getUser($row['event_uid']);
				$block['postername']        = $myevent->getVar('uname');
                $block['name']              = $row['event_name'];
                $block['description']       = $row['event_description'];
			    $block['category']          = $row['event_categoryid'];
				$block['logo']              = $row['event_logo'];
                $block['date']              = date(_DATESTRING, strtotime($row['event_date']));
                $block['dateiso']           = $row['event_date'];
				$block['date_created']      = formatTimestamp($row['date_created']);
				$block['date_updated']      = formatTimestamp($row['date_updated']);
	}
	
    return $block;
}

function editCountdown($options)
{	
	$form = _MB_COUNTDOWN_EVENTTODISPLAY;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />&nbsp;";
	$form .= "<select name='options[1]'>";
	$form .= "<option>". _MB_COUNTDOWN_EVENTTODISPLAY ."</option>";
	//$query = $GLOBALS['xoopsDB']->query("SELECT * FROM ".$GLOBALS['xoopsDB']->prefix("countdown_events")." WHERE event_id IN ($selected_id)"); 
  	$query = $GLOBALS['xoopsDB']->query("SELECT * FROM ".$GLOBALS['xoopsDB']->prefix("countdown_events").""); 
	$totaldata = $GLOBALS['xoopsDB']->getRowsNum($query);
	if ($totaldata > 0) {
	while($myrow=$GLOBALS['xoopsDB']->fetchArray($query)) {
		$event[$myrow['event_categoryid']][] = $myrow;
	}
	foreach ($event as $key => $values){
     $form .= '<optgroup label="'.$key.'">';
     foreach ($values as $value) 
     {
        $form .= '<option value="'.$value['event_id'].'">'.$value['event_name'].'</option>';
     }
     $form .= "</optgroup>";
	}
	} else {}
	$form .= "</select>";

    return $form;
}

?>