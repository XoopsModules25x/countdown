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
        $eventsPaginationLimit                   = 1;
        $myid                                    = $id;
        //id
        $eventsObject = $eventsHandler->get($myid);

        $criteria = new \CriteriaCompo();
        $criteria->setSort('event_id');
        $criteria->setOrder('DESC');
        $criteria->setLimit($eventsPaginationLimit);
        $criteria->setStart($start);
        $events['id']             = $eventsObject->getVar('event_id');
        $events['uid']            = $eventsObject->getVar('event_uid');
		$events['postername']     = \XoopsUser::getUnameFromId($eventsObject->getVar('event_uid'));
        $events['name']           = $eventsObject->getVar('event_name');
		$events['category']       = $eventsObject->getVar('event_categoryid');
		$categoryHandler          = $helper->getHandler('Category');
		//$category                 = $categoryHandler->get($eventsObject->getVar('event_categoryid'));
		//$events['categoryname']   = $category->getVar('category_title');
		
		$events['logo']           = $eventsObject->getVar('event_logo');
        $events['description']    = ($eventsObject->getVar('event_description'));
        $events['date']           = date(_DATESTRING, strtotime($eventsObject->getVar('event_date')));
	    $events['dateiso']        = $eventsObject->getVar('event_date');
		$events['date_created']   = formatTimestamp($eventsObject->getVar('date_created'));
		$events['date_updated']   = formatTimestamp($eventsObject->getVar('date_updated'));
        $events['postinfo']		     = sprintf(_MD_COUNTDOWN_POSTEDBY, \XoopsUser::getUnameFromId($eventsObject->getVar('event_uid')), formatTimestamp($eventsObject->getVar('date_created'),'M d Y'), $eventsObject->getVar('event_categoryid')); 
		//       $GLOBALS['xoopsTpl']->append('events', $events);
        $keywords[] = $eventsObject->getVar('event_id');

        $GLOBALS['xoopsTpl']->assign('events', $events);
        $start = $id;

        // Display Navigation
        if ($eventsCount > $eventsPaginationLimit) {
            $GLOBALS['xoopsTpl']->assign('xoops_mpageurl', COUNTDOWN2_URL . '/event.php');
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
            $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'id');
            $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
        }


//keywords
if (isset($keywords)) {
    $utility::meta_keywords(xoops_getModuleOption('keywords', $moduleDirName) . ', ' . implode(', ', $keywords));
}
//description
$utility::meta_description(_MD_COUNTDOWN_EVENTS_DESC);
//
$GLOBALS['xoopsTpl']->assign('xoops_mpageurl', COUNTDOWN2_URL . '/event.php');
$GLOBALS['xoopsTpl']->assign('countdown_url', COUNTDOWN2_URL);
$GLOBALS['xoopsTpl']->assign('admin', COUNTDOWN2_ADMIN);
$GLOBALS['xoopsTpl']->assign('copyright', $copyright);

require XOOPS_ROOT_PATH . '/include/comment_view.php';
require __DIR__ . '/footer.php';
require dirname(__DIR__, 2) . '/footer.php';
