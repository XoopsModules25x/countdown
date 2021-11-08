<?php

declare(strict_types=1);

use XoopsModules\Countdown;
use XoopsModules\Countdown\Helper;
use XoopsModules\Countdown\Constants;

include_once XOOPS_ROOT_PATH . '/modules/countdown/include/common.php';

function showCountdown($options)
{
    /** @var Helper $helper */
    if (!class_exists(Helper::class)) {
        return false;
    }

    $helper = Helper::getInstance();
    $helper->loadLanguage('main');

    $myts = \MyTextSanitizer::getInstance();

    $block             = [];
    $block['event_id'] = $options[0];
    $selected_id       = $block['event_id'];

    $sql    = "SELECT * FROM " . $GLOBALS['xoopsDB']->prefix("countdown_events") . " WHERE event_id=$selected_id";
    $result = $GLOBALS['xoopsDB']->query($sql);

    while ($row = $GLOBALS['xoopsDB']->fetchArray($result)) {
        $block['id']           = $row['event_id'];
        $block['uid']          = $row['event_uid'];
        $block['submitter']    = \XoopsUser::getUnameFromId($row['event_uid']);
        $block['name']         = $row['event_name'];
        $block['description']  = $row['event_description'];
        $block['categoryid']   = $row['event_categoryid'];
        $categoryid            = $row['event_categoryid'];
        $categoryHandler       = $helper->getHandler('category');
        $categoryObj           = $categoryHandler->get($categoryid);
        $block['categoryname'] = $categoryObj->getVar('category_title');
        $categoryname          = $categoryObj->getVar('category_title');
        $block['logo']         = $row['event_logo'];
        $block['date']         = date(_DATESTRING, strtotime($row['event_date']));
        $block['dateiso']      = $row['event_date'];
        $block['usertime']     = formatTimeStamp(time(), 'mysql');
        $block['date_created'] = formatTimestamp($row['date_created']);
        $date_created          = formatTimestamp($row['date_created']);
        $block['date_updated'] = formatTimestamp($row['date_updated']);
        $date_updated          = formatTimestamp($row['date_updated']);

        if ($date_created == $date_updated) {
            $block['info'] = sprintf(_MB_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($row['event_uid']), formatTimestamp($row['date_created'], 'M d Y'), $categoryname);
        } else {
            $block['info'] = sprintf(_MB_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($row['event_uid']), formatTimestamp($row['date_updated'], 'M d Y'), $categoryname);
        }
    }
    $block['displayinfo']      = $options[1];
    $block['displayeventlogo'] = $options[2];
    return $block;
}

function editCountdown($options)
{
    $form = _MB_COUNTDOWN_EVENTTODISPLAY . '&nbsp;';;
    $form .= "<input type='hidden' name='options[0]' value='" . $options[0] . "'>&nbsp;";
    $form .= "<select name='options[0]'>";
    $form .= "<option>" . _MB_COUNTDOWN_EVENTTODISPLAY . "</option>";

    $sql       = "SELECT c.category_title,c.category_id,e.event_id,e.event_name,event_categoryid FROM " . $GLOBALS['xoopsDB']->prefix("countdown_events") . " AS e JOIN " . $GLOBALS['xoopsDB']->prefix("countdown_categories") . " AS c WHERE category_id=event_categoryid";
    $result    = $GLOBALS['xoopsDB']->query($sql);
    $totaldata = $GLOBALS['xoopsDB']->getRowsNum($result);
    if ($totaldata > 0) {
        while ($myrow = $GLOBALS['xoopsDB']->fetchArray($result)) {
            $event[$myrow['category_title']][] = $myrow;
        }
        foreach ($event as $key => $values) {
            $form .= '<optgroup label="' . $key . '">';
            foreach ($values as $value) {
                if ($options[0] == $value['event_id']) {
                    $form .= '<option value="' . $options[0] . '" selected>' . $value['event_name'] . '</option>';
                } else {
                    $form .= '<option value="' . $value['event_id'] . '">' . $value['event_name'] . '</option>';
                }
            }
            $form .= "</optgroup>";
        }
    } else {
    }
    $form .= "</select><br>";

    $form .= _MB_COUNTDOWN_DISPLAYEVENTDESCRIPTION . '&nbsp;';
    if (1 == $options[1]) {
        $chk = " checked";
    }
    $form .= "<input type='radio' name='options[1]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[1]) {
        $chk = " checked";
    }
    $form .= "&nbsp;<input type='radio' name='options[1]' value='0'" . $chk . ' >' . _NO . '<br>';

    $form .= _MB_COUNTDOWN_DISPLAYEVENTLOGO . '&nbsp;';
    if (1 == $options[2]) {
        $chk = " checked";
    }
    $form .= "<input type='radio' name='options[2]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[2]) {
        $chk = " checked";
    }
    $form .= "&nbsp;<input type='radio' name='options[2]' value='0'" . $chk . ' >' . _NO . '<br>';

    $form .= _MB_COUNTDOWN_DISPLAYINFO . '&nbsp;';
    if (1 == $options[3]) {
        $chk = " checked";
    }
    $form .= "<input type='radio' name='options[3]' value='1'" . $chk . ' >&nbsp;' . _YES . '';
    $chk  = '';
    if (0 == $options[3]) {
        $chk = " checked";
    }
    $form .= "&nbsp;<input type='radio' name='options[3]' value='0'" . $chk . ' >' . _NO . '<br>';
    return $form;
}

?>
