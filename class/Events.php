<?php namespace XoopsModules\Countdown;

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
use XoopsModules\Countdown;
use XoopsModules\Countdown\Form;

$moduleDirName = basename(dirname(__DIR__));

//$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class Events
 */
class Events extends \XoopsObject
{
    /**
     * Constructor
     *
     * @param null
     */
    public function __construct()
    {
        parent::__construct();
        $this->initVar('event_id', XOBJ_DTYPE_INT);
        $this->initVar('event_uid', XOBJ_DTYPE_INT);
        $this->initVar('event_name', XOBJ_DTYPE_TXTBOX);
        $this->initVar('event_description', XOBJ_DTYPE_OTHER);
        $this->initVar('event_enddatetime', XOBJ_DTYPE_TIMESTAMP);
		$this->initVar('event_category', \XOBJ_DTYPE_INT, null, true);
		$this->initVar('event_logo', XOBJ_DTYPE_TXTBOX);
		$this->initVar('date_created', \XOBJ_DTYPE_INT, 0, false);
        $this->initVar('date_updated', \XOBJ_DTYPE_INT, 0, false);
    }

    /**
     * Get form
     *
     * @param null
     * @return EventsForm
     */
    public function getForm()
    {
        require_once XOOPS_ROOT_PATH . '/modules/countdown2/class/form/EventsForm.php';

        $form = new Form\EventsForm($this);
        return $form;
    }

    /**
     * @return array|null
     */
    public function getGroupsRead()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //return $this->publisher->getHandler('permission')->getGrantedGroupsById('events_read', id);
        return $permHelper->getGroupsForItem('sbcolumns_read', $this->getVar('event_id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsSubmit()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('events_submit', id);
        return $permHelper->getGroupsForItem('sbcolumns_submit', $this->getVar('event_id'));
    }

    /**
     * @return array|null
     */
    public function getGroupsModeration()
    {
        $permHelper = new \Xmf\Module\Helper\Permission();
        //        return $this->publisher->getHandler('permission')->getGrantedGroupsById('events_moderation', id);
        return $permHelper->getGroupsForItem('sbcolumns_moderation', $this->getVar('event_id'));
    }
}

