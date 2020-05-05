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
        $adminObject->addItemButton(_AM_COUNTDOWN_ADD_EVENTS, 'events.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                 = Request::getInt('start', 0);
        $eventsPaginationLimit = $helper->getConfig('userpager');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('id ASC, id');
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

                $selectorid = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_ID, 'id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $eventsArray['id'] = $eventsTempArray[$i]->getVar('id');

                $selectoruid = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_UID, 'uid');
                $GLOBALS['xoopsTpl']->assign('selectoruid', $selectoruid);
                $eventsArray['uid'] = $eventsTempArray[$i]->getVar('uid');

                $selectorname = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_NAME, 'name');
                $GLOBALS['xoopsTpl']->assign('selectorname', $selectorname);
                $eventsArray['name'] = $eventsTempArray[$i]->getVar('name');

                $selectordescription = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_DESCRIPTION, 'description');
                $GLOBALS['xoopsTpl']->assign('selectordescription', $selectordescription);
                $eventsArray['description'] = ($eventsTempArray[$i]->getVar('description'));

                $selectorenddatetime = $utility::selectSorting(_AM_COUNTDOWN_EVENTS_ENDDATETIME, 'enddatetime');
                $GLOBALS['xoopsTpl']->assign('selectorenddatetime', $selectorenddatetime);
                $eventsArray['enddatetime'] = date(_DATESTRING, strtotime($eventsTempArray[$i]->getVar('enddatetime')));
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

            //                     echo "<td class='center width5'>

            //                    <a href='events.php?op=edit&id=".$i."'><img src=".$pathIcon16."/edit.png alt='"._EDIT."' title='"._EDIT."'></a>
            //                    <a href='events.php?op=delete&id=".$i."'><img src=".$pathIcon16."/delete.png alt='"._DELETE."' title='"._DELETE."'></a>
            //                    </td>";

            //                echo "</tr>";

            //            }

            //            echo "</table><br><br>";

            //        } else {

            //            echo "<table width='100%' cellspacing='1' class='outer'>

            //                    <tr>

            //                     <th class='center width5'>"._AM_COUNTDOWN_FORM_ACTION."XXX</th>
            //                    </tr><tr><td class='errorMsg' colspan='6'>There are noXXX events</td></tr>";
            //            echo "</table><br><br>";

            //-------------------------------------------

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
            $eventsObject = $eventsHandler->get(Request::getInt('id', 0));
        } else {
            $eventsObject = $eventsHandler->create();
        }
        // Form save fields
        $eventsObject->setVar('uid', Request::getVar('uid', ''));
        $eventsObject->setVar('name', Request::getVar('name', ''));
        $eventsObject->setVar('description', Request::getText('description', ''));
        $eventsObject->setVar('enddatetime', date('Y-m-d H:i:s', strtotime($_REQUEST['enddatetime']['date']) + $_REQUEST['enddatetime']['time']));
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
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(_AM_COUNTDOWN_FORMSUREDEL, $eventsObject->getVar('id')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('countdown_events', 'id', $id_field)) {
            redirect_header('events.php', 3, _AM_COUNTDOWN_CLONED_OK);
        } else {
            redirect_header('events.php', 3, _AM_COUNTDOWN_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
