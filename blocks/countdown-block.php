<?php

function showCountdown($options){

	$block=array();
	$block['event_id'] = $options[0];
	$selected_id=$block['event_id'];
	
	$result = $GLOBALS['xoopsDB']->query("SELECT * FROM ".$GLOBALS['xoopsDB']->prefix("countdown_events")." WHERE event_id IN ($selected_id)"); 

	while($row=$GLOBALS['xoopsDB']->fetchArray($result)) {
				$block['id']                = $row['event_id'];
                $block['uid']               = $row['event_uid'];
				$block['submitter']        = \XoopsUser::getUnameFromId($row['event_uid']);
                $block['name']              = $row['event_name'];
                $block['description']       = $row['event_description'];
			    $block['category']          = $row['event_categoryid'];
			    //$categoryHandler          = $helper->getHandler('category');
				//$categoryObj              = $categoryHandler->get($row['event_categoryid']);
				//$block['categoryname']    = $categoryObj->getVar('category_title');
				$block['logo']              = $row['event_logo'];
                $block['date']              = date(_DATESTRING, strtotime($row['event_date']));
                $block['dateiso']           = $row['event_date'];
				$block['date_created']      = formatTimestamp($row['date_created']);
				$block['date_updated']      = formatTimestamp($row['date_updated']);
				$block['postinfo']		    = sprintf(_MB_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($row['event_uid']), formatTimestamp($row['date_created'],'M d Y'), $row['event_categoryid']); 
				}
				$block['displaypostinfo']   = $options[1];
				$block['displayeventlogo']  = $options[2];
    return $block;
}

function editCountdown($options)
{	
	$form = _MB_COUNTDOWN_EVENTTODISPLAY . '&nbsp;';;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "' />&nbsp;";
	$form .= "<select name='options[0]'>";
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
	$form .= "</select><br>";
	
	$form .= _MB_COUNTDOWN_DISPLAYEVENTDESCRIPTION . '&nbsp;';
    if (1 == $options[1]) {
        $chk = " checked='checked'";
    }
    $form .= "<input type='radio' name='options[1]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[1]) {
        $chk = " checked='checked'";
    }
    $form .= "&nbsp;<input type='radio' name='options[1]' value='0'" . $chk . ' >' . _NO . '<br>';
	
	$form .= _MB_COUNTDOWN_DISPLAYEVENTLOGO . '&nbsp;';
    if (1 == $options[2]) {
        $chk = " checked='checked'";
    }
    $form .= "<input type='radio' name='options[2]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[2]) {
        $chk = " checked='checked'";
    }
    $form .= "&nbsp;<input type='radio' name='options[2]' value='0'" . $chk . ' >' . _NO . '<br>';
	
	
	$form .= _MB_COUNTDOWN_DISPLAYPOSTINFO . '&nbsp;';
    if (1 == $options[3]) {
        $chk = " checked='checked'";
    }
    $form .= "<input type='radio' name='options[3]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[3]) {
        $chk = " checked='checked'";
    }
    $form .= "&nbsp;<input type='radio' name='options[3]' value='0'" . $chk . ' >' . _NO . '<br>';
    return $form;
}

?>