<?php

/**
 * @param $queryarray
 * @param $andor
 * @param $limit
 * @param $offset
 * @param $userid
 * @return array
 */
function countdown_search($queryarray, $andor, $limit, $offset, $userid)
{
    $sql = 'SELECT * FROM ' . $GLOBALS['xoopsDB']->prefix('countdown_events') . ' ';
    if (0 != $userid) {
        $sql .= " WHERE event_uid='$userid'";
    }
    // because count() returns 1 even if a supplied variable
    // is not an array, we must check if $querryarray is really an array
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " WHERE ((event_name LIKE '%{$queryarray[0]}%')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(event_name LIKE '%{$queryarray[$i]}%')";
        }
        $sql .= ') ';
    }
    $sql .= ' ORDER BY event_name ASC';
    $result = $GLOBALS['xoopsDB']->query($sql, (int)$limit, (int)$offset);
    $ret    = [];
    $i      = 0;
    while (false !== ($myrow = $GLOBALS['xoopsDB']->fetchArray($result))) {
        $ret[$i]['link']  = '' . XOOPS_URL . "/modules/countdown2/events.php?op=view&id=" . $myrow['event_id'] . '';
        $ret[$i]['title'] = '' . htmlspecialchars($myrow['event_name'], ENT_QUOTES | ENT_HTML5) . '';
        $ret[$i]['time']  = '';
        $ret[$i]['uid']   = '' . $myrow['event_uid'] . '';
        $i++;
    }
    return $ret;
}
