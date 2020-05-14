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
 * Module: Countdown2
 *
 * @category        Module
 * @package         countdown2
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
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
        $adminObject->addItemButton(_AM_COUNTDOWN_CATEGORY_ADD, 'category.php?op=new', 'add');
        echo $adminObject->displayButton('left');
        $start                 = Request::getInt('start', 0);
        $categoryPaginationLimit = $helper->getConfig('usereventperpage');

        $criteria = new \CriteriaCompo();
        $criteria->setSort('category_id ASC, category_id');
        $criteria->setOrder('ASC');
        $criteria->setLimit($categoryPaginationLimit);
        $criteria->setStart($start);
        $categoryTempRows  = $categoryHandler->getCount();
        $categoryTempArray = $categoryHandler->getAll($criteria);/*
//
// 
                    <th class='center width5'>"._AM_COUNTDOWN_FORM_ACTION."</th>
//                    </tr>";
//            $class = "odd";
*/

        // Display Page Navigation
        if ($categoryTempRows > $categoryPaginationLimit) {
            require_once XOOPS_ROOT_PATH . '/class/pagenav.php';

            $pagenav = new \XoopsPageNav($categoryTempRows, $categoryPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
            $GLOBALS['xoopsTpl']->assign('pagenav', null === $pagenav ? $pagenav->renderNav() : '');
        }

        $GLOBALS['xoopsTpl']->assign('categoryRows', $categoryTempRows);
        $categoryArray = [];

        //    $fields = explode('|', id:int:11::NOT NULL::primary:ID|uid:int:11::NOT NULL:0::User|name:varchar:50::NOT NULL:::Event|description:mediumtext:0::NOT NULL:::Description|date:timestamp:11::NOT NULL:0::End Date/Time);
        //    $fieldsCount    = count($fields);

        $criteria = new \CriteriaCompo();

        //$criteria->setOrder('DESC');
        $criteria->setSort($sort);
        $criteria->setOrder($order);
        $criteria->setLimit($categoryPaginationLimit);
        $criteria->setStart($start);

        $categoryCount     = $categoryHandler->getCount($criteria);
        $categoryTempArray = $categoryHandler->getAll($criteria);

        //    for ($i = 0; $i < $fieldsCount; ++$i) {
        if ($categoryCount > 0) {
            foreach (array_keys($categoryTempArray) as $i) {


                //        $field = explode(':', $fields[$i]);

                $selectorid = $utility::selectSorting(_AM_COUNTDOWN_CATEGORY_ID, 'category_id');
                $GLOBALS['xoopsTpl']->assign('selectorid', $selectorid);
                $categoryArray['category_id'] = $categoryTempArray[$i]->getVar('category_id');

                $selectortitle = $utility::selectSorting(_AM_COUNTDOWN_CATEGORY_TITLE, 'category_title');
                $GLOBALS['xoopsTpl']->assign('selectortitle', $selectortitle);
                $categoryArray['category_title'] = $categoryTempArray[$i]->getVar('category_title');
				
				$selectorweight = $utility::selectSorting(_AM_COUNTDOWN_CATEGORY_WEIGHT, 'category_weight');
                $GLOBALS['xoopsTpl']->assign('selectorweight', $selectorweight);
                $categoryArray['category_weight'] = $categoryTempArray[$i]->getVar('category_weight');

                $categoryArray['edit_delete'] = "<a href='category.php?op=edit&id=" . $i . "'><img src=" . $pathIcon16 . "/edit.png alt='" . _EDIT . "' title='" . _EDIT . "'></a>
               <a href='category.php?op=delete&id=" . $i . "'><img src=" . $pathIcon16 . "/delete.png alt='" . _DELETE . "' title='" . _DELETE . "'></a>
               <a href='category.php?op=clone&id=" . $i . "'><img src=" . $pathIcon16 . "/editcopy.png alt='" . _CLONE . "' title='" . _CLONE . "'></a>";

                $GLOBALS['xoopsTpl']->append_by_ref('categoryArrays', $categoryArray);
                unset($categoryArray);
            }
            unset($categoryTempArray);
            // Display Navigation
            if ($categoryCount > $categoryPaginationLimit) {
                require_once XOOPS_ROOT_PATH . '/class/pagenav.php';
                $pagenav = new \XoopsPageNav($categoryCount, $categoryPaginationLimit, $start, 'start', 'op=list' . '&sort=' . $sort . '&order=' . $order . '');
                $GLOBALS['xoopsTpl']->assign('pagenav', $pagenav->renderNav(4));
            }

            echo $GLOBALS['xoopsTpl']->fetch(XOOPS_ROOT_PATH . '/modules/' . $GLOBALS['xoopsModule']->getVar('dirname') . '/templates/admin/countdown_admin_category.tpl');
        }

        break;

    case 'new':
        $adminObject->addItemButton(_AM_COUNTDOWN_CATEGORY_LIST, 'category.php', 'list');
        echo $adminObject->displayButton('left');

        $categoryObject = $categoryHandler->create();
        $form         = $categoryObject->getForm();
        $form->display();
        break;

    case 'save':
        if (!$GLOBALS['xoopsSecurity']->check()) {
            redirect_header('category.php', 3, implode(',', $GLOBALS['xoopsSecurity']->getErrors()));
        }
        if (0 != Request::getInt('category_id', 0)) {
            $categoryObject = $categoryHandler->get(Request::getInt('category_id', 0));
        } else {
            $categoryObject = $categoryHandler->create();
        }
        // Form save fields
        $categoryObject->setVar('category_title', Request::getVar('category_title', ''));
		$categoryObject->setVar('category_weight', Request::getVar('category_weight', ''));
       
		if ($categoryHandler->insert($categoryObject)) {
            redirect_header('category.php?op=list', 2, _AM_COUNTDOWN_FORMOK);
        }

        echo $categoryObject->getHtmlErrors();
        $form = $categoryObject->getForm();
        $form->display();
        break;

    case 'edit':
        $adminObject->addItemButton(_AM_COUNTDOWN_ADD_CATEGORY, 'category.php?op=new', 'add');
        $adminObject->addItemButton(_AM_COUNTDOWN_CATEGORY_LIST, 'category.php', 'list');
        echo $adminObject->displayButton('left');
        $categoryObject = $categoryHandler->get(Request::getString('id', ''));
        $form         = $categoryObject->getForm();
        $form->display();
        break;

    case 'delete':
        $categoryObject = $categoryHandler->get(Request::getString('id', ''));
        if (1 == Request::getInt('ok', 0)) {
            if (!$GLOBALS['xoopsSecurity']->check()) {
                redirect_header('category.php', 3, implode(', ', $GLOBALS['xoopsSecurity']->getErrors()));
            }
            if ($categoryHandler->delete($categoryObject)) {
				$cat_id = Request::getString('id', '');
				$sql = 'DELETE FROM ' . $GLOBALS['xoopsDB']->prefix('countdown_events') . " WHERE event_categoryid = '" . $cat_id . "'";
			    $xoopsDB->query( $sql );
                redirect_header('category.php', 3, _AM_COUNTDOWN_FORMDELOK);
            } else {
                echo $categoryObject->getHtmlErrors();
            }
        } else {
            xoops_confirm(['ok' => 1, 'id' => Request::getString('id', ''), 'op' => 'delete'], Request::getUrl('REQUEST_URI', '', 'SERVER'), sprintf(_AM_COUNTDOWN_CATEGORY_DELETECONFIRM, $categoryObject->getVar('category_title')));
        }
        break;

    case 'clone':

        $id_field = Request::getString('id', '');

        if ($utility::cloneRecord('countdown_categories', 'category_id', $id_field)) {
            redirect_header('category.php', 3, _AM_COUNTDOWN_CLONED_OK);
        } else {
            redirect_header('category.php', 3, _AM_COUNTDOWN_CLONED_FAILED);
        }

        break;
}
require_once __DIR__ . '/admin_footer.php';
