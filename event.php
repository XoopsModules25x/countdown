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

$GLOBALS['xoopsOption']['template_main'] = 'countdown_event_view.tpl';
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
$criteria->setLimit($eventsPaginationLimit);
$criteria->setStart($start);

$eventsCount = $eventsHandler->getCount($criteria);
$eventsArray = $eventsHandler->getAll($criteria);

$moduleDirNameUpper = strtoupper($moduleDirName);

$id = Request::getInt('id', 0, 'GET');

//viewItem();
$eventsPaginationLimit = 1;
$myid                  = $id;
//id
$eventsObject = $eventsHandler->get($myid);

$criteria = new \CriteriaCompo();
$criteria->setSort('event_id');
$criteria->setOrder('DESC');
$criteria->setLimit($eventsPaginationLimit);
$criteria->setStart($start);
$events['id']           = $eventsObject->getVar('event_id');
$events['uid']          = $eventsObject->getVar('event_uid');
$events['submitter']    = \XoopsUser::getUnameFromId($eventsObject->getVar('event_uid'));
$events['name']         = $eventsObject->getVar('event_name');
$events['category']     = $eventsObject->getVar('event_categoryid');
$categoryHandler        = $helper->getHandler('category');
$categoryObj            = $categoryHandler->get($eventsObject->getVar('event_categoryid'));
$events['categoryname'] = $categoryObj->getVar('category_title');
$categoryname           = $categoryObj->getVar('category_title');
$events['logo']         = $eventsObject->getVar('event_logo');
$events['description']  = ($eventsObject->getVar('event_description'));
$events['usertime']     = formatTimeStamp(time(), 'mysql');
$events['date']         = date(_DATESTRING, strtotime($eventsObject->getVar('event_date')));
$events['dateiso']      = $eventsObject->getVar('event_date');
$events['date_created'] = formatTimestamp($eventsObject->getVar('date_created'));
$date_created           = formatTimestamp($eventsObject->getVar('date_created'));
$events['date_updated'] = formatTimestamp($eventsObject->getVar('date_updated'));
$date_updated           = formatTimestamp($eventsObject->getVar('date_updated'));

if ($date_created == $date_updated) {
    $events['info'] = sprintf(_MD_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($eventsObject->getVar('event_uid')), formatTimestamp($eventsObject->getVar('date_created'), 'M d Y'), $categoryname);
} else {
    $events['info'] = sprintf(_MD_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($eventsObject->getVar('event_uid')), formatTimestamp($eventsObject->getVar('date_updated'), 'M d Y'), $categoryname);
}

//       $GLOBALS['xoopsTpl']->append('events', $events);
$keywords[] = $eventsObject->getVar('event_id');

$GLOBALS['xoopsTpl']->assign('events', $events);
$start = $id;

// Display Navigation
if ($eventsCount > $eventsPaginationLimit) {
    $GLOBALS['xoopsTpl']->assign('event_url', COUNTDOWN_URL . '/event.php');
    require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
    $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'id');
    $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
}

//keywords
if (isset($keywords)) {
    $utility::metaKeywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::metaDescription(_MD_COUNTDOWN_EVENTS_DESC);
//
$GLOBALS['xoopsTpl']->assign('event_url', COUNTDOWN_URL . '/event.php');
$GLOBALS['xoopsTpl']->assign('countdown_url', COUNTDOWN_URL);
$GLOBALS['xoopsTpl']->assign('admin', COUNTDOWN_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/include/comment_view.php';
require __DIR__ . '/footer.php';
require dirname(__DIR__, 2) . '/footer.php';
