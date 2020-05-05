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
        $sql .= " WHERE uid='$userid'";
    }
    // because count() returns 1 even if a supplied variable
    // is not an array, we must check if $querryarray is really an array
    if (is_array($queryarray) && $count = count($queryarray)) {
        $sql .= " WHERE ((name LIKE '%{$queryarray[0]}%')";
        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";
            $sql .= "(name LIKE '%{$queryarray[$i]}%')";
        }
        $sql .= ') ';
    }
    $sql .= ' ORDER BY name ASC';

    $result = $GLOBALS['xoopsDB']->query($sql, (int)$limit, (int)$offset);
    $ret    = [];
    $i      = 0;
    while (false !== ($myrow = $GLOBALS['xoopsDB']->fetchArray($result))) {
        $ret[$i]['link']  = '' . XOOPS_URL . "modules\countdown2\events.php?op=view&id=" . $myrow['id'] . '';
        $ret[$i]['title'] = '' . htmlspecialchars($myrow['name'], ENT_QUOTES | ENT_HTML5) . '';
        $ret[$i]['time']  = '';
        $ret[$i]['uid']   = '' . $myrow['uid'] . '';
        $i++;
    }
    return $ret;
}
