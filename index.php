<?php

declare(strict_types=1);

/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * Module: Countdown
 *
 * @category        Module
 * @package         countdown
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
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

$eventsPaginationLimit = $helper->getConfig('usereventperpage');

$criteria = new \CriteriaCompo();

$criteria->setOrder('DESC');
$criteria->setSort('event_id');
$criteria->setLimit($eventsPaginationLimit);
$criteria->setStart($start);
$op    = Request::getCmd('op', '');
$today = date("Y-m-d H:i:s", time());

switch ($op) {
    case '':
    default: //Do nothing, we want to view all
		$xoopsTpl->assign('lang_events', _MD_COUNTDOWN_EVENT);
        break;
    case 'running':
        $criteria->add(new Criteria('event_date', $today, '>'));
		$xoopsTpl->assign('lang_events', _MD_COUNTDOWN_EVENT_RUNNING);
        break;
    case 'expired':
        $criteria->add(new Criteria('event_date', $today, '<'));
		$xoopsTpl->assign('lang_events', _MD_COUNTDOWN_EVENT_EXPIRED);
}

$eventsCount = $eventsHandler->getCount($criteria);
$eventsArray = $eventsHandler->getAll($criteria);

$moduleDirNameUpper = strtoupper($moduleDirName);

$id = Request::getInt('event_id', 0, 'GET');

if ($eventsCount > 0) {
    foreach (array_keys($eventsArray) as $i) {
        $events['id']           = $eventsArray[$i]->getVar('event_id');
        $events['uid']          = $eventsArray[$i]->getVar('event_uid');
        $events['submitter']    = \XoopsUser::getUnameFromId($eventsArray[$i]->getVar('event_uid'));
        $events['name']         = $eventsArray[$i]->getVar('event_name');
        $events['description']  = $eventsArray[$i]->getVar('event_description');
        $events['category']     = $eventsArray[$i]->getVar('event_categoryid');
        $categoryid             = $eventsArray[$i]->getVar('event_categoryid');
        $categoryHandler        = $helper->getHandler('category');
        $categoryObj            = $categoryHandler->get($categoryid);
        $events['categoryname'] = $categoryObj->getVar('category_title');
        $categoryname           = $categoryObj->getVar('category_title');
        $events['logo']         = $eventsArray[$i]->getVar('event_logo');
        $events['usertime']         = formatTimeStamp(time(), 'mysql');
        $events['date']         = date(_DATESTRING, strtotime($eventsArray[$i]->getVar('event_date')));
        $events['dateiso']      = $eventsArray[$i]->getVar('event_date');
        $events['date_created'] = formatTimestamp($eventsArray[$i]->getVar('date_created'));
        $date_created           = formatTimestamp($eventsArray[$i]->getVar('date_created'));
        $events['date_updated'] = formatTimestamp($eventsArray[$i]->getVar('date_updated'));
        $date_updated           = formatTimestamp($eventsArray[$i]->getVar('date_updated'));

        if ($date_created == $date_updated) {
            $events['info'] = sprintf(_MD_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($eventsArray[$i]->getVar('event_uid')), formatTimestamp($eventsArray[$i]->getVar('date_created'), 'M d Y'), $categoryname);
        } else {
            $events['info'] = sprintf(_MD_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($eventsArray[$i]->getVar('event_uid')), formatTimestamp($eventsArray[$i]->getVar('date_updated'), 'M d Y'), $categoryname);
        }

        $GLOBALS['xoopsTpl']->append('events', $events);
        $keywords[] = $eventsArray[$i]->getVar('event_id');
        unset($events);
    }
    // Display Navigation
    if ($eventsCount > $eventsPaginationLimit) {
        $GLOBALS['xoopsTpl']->assign('index_url', COUNTDOWN_URL . '/index.php');
        require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
        $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'start');
        $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
    }
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(_MD_COUNTDOWN_EVENTS_DESC);
//
$GLOBALS['xoopsTpl']->assign('eventperpage', $eventsPaginationLimit);
$GLOBALS['xoopsTpl']->assign('index_url', COUNTDOWN_URL . '/index.php');
$GLOBALS['xoopsTpl']->assign('countdown_url', COUNTDOWN_URL);
$GLOBALS['xoopsTpl']->assign('admin', COUNTDOWN_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require __DIR__ . '/footer.php';
require dirname(__DIR__, 2) . '/footer.php';
