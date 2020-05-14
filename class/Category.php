<?php

declare(strict_types=1);

namespace XoopsModules\Countdown2;

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

use XoopsModules\Countdown2;
use XoopsModules\Countdown2\Form;

$moduleDirName = basename(dirname(__DIR__));

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Category
 */
class Category extends \XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('category_id', XOBJ_DTYPE_INT);
        $this->initVar('category_title', XOBJ_DTYPE_TXTBOX);
		$this->initVar('category_weight', XOBJ_DTYPE_TXTBOX);
    }
	
    /**
     * Get form
     *
     * @param null
     * @return CategoryForm
     */
    public function getForm()
    {
        $form = new Form\CategoryForm($this);
        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('category_read', id);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('category_id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('category_submit', id);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('category_id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('category_moderation', id);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('category_id'));
    }
}

