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

use Xmf\Module\Admin;
use Xmf\Database\Tables;
use Xmf\Debug;
use Xmf\Module\Helper;
use Xmf\Module\Helper\Permission;
use Xmf\Request;

require_once __DIR__ . '/admin_header.php';
xoops_cp_header();
//It recovered the value of argument op in URL$
$op    = Request::getString('op', 'list');
$order = Request::getString('order', 'desc');
$sort  = Request::getString('sort', '');

$adminObject->displayNavigation(basename(__FILE__));
/** @var Permission $permHelper */
$permHelper = new \Xmf\Module\Helper\Permission();
$uploadDir  = XOOPS_UPLOAD_PATH . '/countdown/images/';
$uploadUrl  = XOOPS_UPLOAD_URL . '/countdown/images/';

switch ($op) {
    case 'list':
    default:
        $adminObject->addItemButton(_AM_COUNTDOWN_EVENTS_ADD, 'events.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                 = Request::getInt('start', 0);
        $eventsPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('event_id ASC, event_id');
        $criteria->setOrder('ASC');
        $criteria->setLimit($eventsPaginationLimit);
        $criteria->setStart($start);
        $eventsTempRows  = $eventsHandler->getCount();
        $eventsTempArray = $eventsHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_COUNTDOWN_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($eventsTempRows > $eventsPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new \XoopsPageNav($eventsTempRows, $eventsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('eventsRows', $eventsTempRows);
        $eventsArray = [];

        //    $fields = explode('|', id:int:11::NOT NULL::primary:ID|uid:int:11::NOT NULL:0::User|name:varchar:50::NOT NULL:::Event|description:mediumtext:0::NOT NULL:::Description|enddatetime:timestamp:11::NOT NULL:0::End Date/Time);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($eventsPaginationLimit);
        $criteria->setStart($start);

        $eventsCount     = $eventsHandler->getCount($criteria);
        $eventsTempArray = $eventsHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($eventsCount > 0) {
            foreach (array_keys($eventsTempArray) as $i) {


                //        $field = explode(':', $fields[$i]);

                $selectorid = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_ID, 'event_id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $eventsArray['event_id'] = $eventsTempArray[$i]->getVar('event_id');

                $selectoruid = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_POSTERNAME, 'event_uid');
                $GLOBALS['xoopsTpl']->assign('selectoruid', $selectoruid);
                $eventsArray['event_uid'] = $eventsTempArray[$i]->getVar('event_uid');
				$memberHandler = xoops_getHandler('member');
				$myevent        = $memberHandler->getUser($eventsTempArray[$i]->getVar('event_uid'));
				$eventsArray['event_postername']  = $myevent->getVar('uname');

                $selectorname = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_NAME, 'event_name');
                $GLOBALS['xoopsTpl']->assign('selectorname', $selectorname);
                $eventsArray['event_name'] = $eventsTempArray[$i]->getVar('event_name');

                $selectordescription = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_DESCRIPTION, 'event_description');
                $GLOBALS['xoopsTpl']->assign('selectordescription', $selectordescription);
                $eventsArray['event_description'] = ($eventsTempArray[$i]->getVar('event_description'));

                $selectorenddatetime = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_ENDDATETIME, 'event_enddatetime');
                $GLOBALS['xoopsTpl']->assign('selectorenddatetime', $selectorenddatetime);
                $eventsArray['event_enddatetime'] = date(_DATESTRING, strtotime($eventsTempArray[$i]->getVar('event_enddatetime')));
				
				$selectorlogo = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_LOGO, 'event_logo');
                $GLOBALS['xoopsTpl']->assign('selectorlogo', $selectorlogo);
                $eventsArray['event_logo']     = "<img src='" . $uploadUrl . $eventsTempArray[$i]->getVar('event_logo') . "' name='" . 'name' . "' id=" . 'id' . " alt='' style='max-width:100px'>";
                
				$selectordatecreated = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_DATE_CREATED, 'date_created');
                $GLOBALS['xoopsTpl']->assign('selectordatecreated', $selectordatecreated);
                $eventsArray['date_created'] = formatTimestamp($eventsTempArray[$i]->getVar('date_created'));
				
				$selectordateupdated = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_DATE_UPDATED, 'date_updated');
                $GLOBALS['xoopsTpl']->assign('selectordateupdated', $selectordateupdated);
                $eventsArray['date_updated'] = formatTimestamp($eventsTempArray[$i]->getVar('date_updated'));
				
                $eventsArray['edit_delete'] = "<a href='events.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='events.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='events.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('eventsArrays', $eventsArray);
                unset($eventsArray);
            }
            unset($eventsTempArray);
            // Display Navigation
            if ($eventsCount > $eventsPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($eventsCount, $eventsPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/countdown_admin_events.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_COUNTDOWN_EVENTS_LIST, 'events.php', 'list');
        echo $adminObject->displayButton('left');

        $eventsObject = $eventsHandler->create();
        $form         = $eventsObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('events.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('id', 0)) {
            $eventsObject = $eventsHandler->get(Request::getInt('event_id', 0));
        } else {
            $eventsObject = $eventsHandler->create();
        }
        // Form save fields
        $eventsObject->setVar('event_uid', Request::getVar('event_uid', ''));
        $eventsObject->setVar('event_name', Request::getVar('event_name', ''));
        $eventsObject->setVar('event_description', Request::getText('event_description', ''));
        $eventsObject->setVar('event_enddatetime', date('Y-m-d H:i:s', strtotime($_REQUEST['event_enddatetime']['date']) + $_REQUEST['event_enddatetime']['time']));
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, Request::getString('date_created', '', 'POST'));
        $eventsObject->setVar('date_created', $dateTimeObj->getTimestamp());
        $dateTimeObj = \DateTime::createFromFormat(_SHORTDATESTRING, Request::getString('date_updated', '', 'POST'));
        $eventsObject->setVar('date_updated', $dateTimeObj->getTimestamp());
		
		require_once XOOPS_ROOT_PATH . '/class/uploader.php';
        $uploadDir = XOOPS_UPLOAD_PATH . '/countdown/images/';
        $uploader  = new \XoopsMediaUploader($uploadDir, $helper->getConfig('mimetypes'), $helper->getConfig('maxsize'), null, null);
        if ($uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0])) {

            //$extension = preg_replace( '/^.+\.([^.]+)$/sU' , '' , $_FILES['attachedfile']['name']);
            //$imgName = str_replace(' ', '', $_POST['']).'.'.$extension;

            $uploader->setPrefix('logo_');
            $uploader->fetchMedia(Request::getArray('xoops_upload_file', '', 'POST')[0]);
            if (!$uploader->upload()) {
                $errors = $uploader->getErrors();
                redirect_header('javascript:history.go(-1)', 3, $errors);
            } else {
                $eventsObject->setVar('event_logo', $uploader->getSavedFileName());
            }
        } else {
            $eventsObject->setVar('event_logo', Request::getVar('event_logo', ''));
        }
	
		if ($eventsHandler->insert($eventsObject)) {
            redirect_header('events.php?op=list', 2, _AM_COUNTDOWN_FORMOK);
        }

        echo $eventsObject->getHtmlErrors();
        $form = $eventsObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_COUNTDOWN_ADD_EVENTS, 'events.php?op=new', 'add');
        $adminObject->addItemButton(_AM_COUNTDOWN_EVENTS_LIST, 'events.php', 'list');
        echo $adminObject->displayButton('left');
        $eventsObject = $eventsHandler->get(Request::getString('id', ''));
        $form         = $eventsObject->getForm();
        $form->display();
        break;

    case 'delete':
        $eventsObject = $eventsHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('events.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($eventsHandler->delete($eventsObject)) {
                redirect_header('events.php', 3, _AM_COUNTDOWN_FORMDELOK);
            } else {
                echo $eventsObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(_AM_COUNTDOWN_FORMSUREDEL, $eventsObject->getVar('event_id')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('countdown_events', 'event_id', $id_field)) {
            redirect_header('events.php', 3, _AM_COUNTDOWN_CLONED_OK);
        } else {
            redirect_header('events.php', 3, _AM_COUNTDOWN_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
