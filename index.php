<?php

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: countdown
 *
 * @category        Module
 * @package         countdown
 * @author          XOOPS Development Team <name@site.com> - <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GPL 2.0 or later
 * @link            https://xoops.org/
 * @since           1.0.0
 */

use Xmf\Request;
use XoopsModules\Countdown;

$GLOBALS['xoopsOption']['template_main'] = 'countdown_events_list.tpl';
require_once __DIR__ . '/header.php';
$start = Request::getInt('start', 0);
// Define Stylesheet
$xoTheme->addStylesheet($stylesheet);

$db = \XoopsDatabaseFactory::getDatabaseConnection();

// Get Handler
/** @var \XoopsPersistableObjectHandler $eventsHandler */
$eventsHandler = new Countdown\EventsHandler($db);

$eventsPaginationLimit = $helper->getConfig('userpager');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setLimit($eventsPaginationLimit);
$criteria->setStart($start);

$eventsCount = $eventsHandler->getCount($criteria);
$eventsArray = $eventsHandler->getAll($criteria);

$op = Request::getCmd('op', '');
$id = Request::getInt('id', 0, 'GET');

switch ($op) {
    case 'view':
        //        viewItem();
        $GLOBALS['xoopsOption']['template_main'] = 'countdown_events.tpl';
        $eventsPaginationLimit                   = 1;
        $myid                                    = $id;
        //id
        $eventsObject = $eventsHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($eventsPaginationLimit);
        $criteria->setStart($start);
        $events['id']             = $eventsObject->getVar('id');
        $events['uid']            = $eventsObject->getVar('uid');
        $events['name']           = $eventsObject->getVar('name');
        $events['description']    = ($eventsObject->getVar('description'));
        $events['enddatetime']    = date(_DATESTRING, strtotime($eventsObject->getVar('enddatetime')));
        $events['enddatetimeiso'] = $eventsObject->getVar('enddatetime');
        //       $GLOBALS['xoopsTpl']->append('events', $events);
        $keywords[] = $eventsObject->getVar('id');

        $GLOBALS['xoopsTpl']->assign('events', $events);
        $start = $id;

        // Display Navigation
        if ($eventsCount > $eventsPaginationLimit) {

            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', COUNTDOWN_URL . '/events.php');
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
            $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'op=view&id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }

        break;
    case 'list':
    default:
        //        viewall();
        $GLOBALS['xoopsOption']['template_main'] = 'countdown_events_list.tpl';
        //    require_once __DIR__ . '/header.php';

        if ($eventsCount > 0) {
            foreach (array_keys($eventsArray) as $i) {
                $events['id']             = $eventsArray[$i]->getVar('id');
                $events['uid']            = $eventsArray[$i]->getVar('uid');
                $events['name']           = $eventsArray[$i]->getVar('name');
                $events['description']    = ($eventsArray[$i]->getVar('description'));
                $events['enddatetime']    = date(_DATESTRING, strtotime($eventsArray[$i]->getVar('enddatetime')));
                $events['enddatetimeiso'] = $eventsArray[$i]->getVar('enddatetime');
                $GLOBALS['xoopsTpl']->append('events', $events);
                $keywords[] = $eventsArray[$i]->getVar('id');
                unset($events);
            }
            // Display Navigation
            if ($eventsCount > $eventsPaginationLimit) {
                $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', COUNTDOWN_URL . '/events.php');
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'start');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }
        }
}

//keywords
if (isset($keywords)) {
    $utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::meta_description(_MD_COUNTDOWN_EVENTS_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', COUNTDOWN_URL . '/events.php');
$GLOBALS['xoopsTpl']->assign('countdown_url', COUNTDOWN_URL);
$GLOBALS['xoopsTpl']->assign('adv', xoops_getModuleOption('advertise', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('bookmarks', xoops_getModuleOption('bookmarks', $moduleDirName));
$GLOBALS['xoopsTpl']->assign('fbcomments', xoops_getModuleOption('fbcomments', $moduleDirName));
//
$GLOBALS['xoopsTpl']->assign('admin', _MD_COUNTDOWN_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);
//
require_once XOOPS_ROOT_PATH . '/footer.php';
