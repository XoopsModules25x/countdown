<?php

declare(strict_types=1);

namespace XoopsModules\Countdown2\Form;

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

use Xmf\Request;
use XoopsModules\Countdown2;
use XoopsModules\Countdown2\Common;
use XoopsFormTextDateSelect;
use XoopsFormSelect;

require_once  dirname(dirname(__DIR__)) . '/include/common.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
$helper        = Countdown2\Helper::getInstance();
$permHelper    = new \Xmf\Module\Helper\Permission();

xoops_load('XoopsFormLoader');

/**
 * Class EventsForm
 */
class EventsForm extends \XoopsThemeForm
{
    public $targetObject;

    /**
     * Constructor
     *
     * @param $target
     */
    public function __construct($target)
    {
		$helper = \XoopsModules\Countdown2\Helper::getInstance();
		
        $this->targetObject = $target;

        $title = $this->targetObject->isNew() ? sprintf(_AM_COUNTDOWN_EVENTS_ADD) : sprintf(_AM_COUNTDOWN_EVENTS_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('event_id', $this->targetObject->getVar('event_id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(_AM_COUNTDOWN_EVENTS_ID, $this->targetObject->getVar('event_id'), 'event_id'));
		//Category
		$category_id = 0;
		if (!$this->targetObject->isNew()) {
        $category_id = $this->targetObject->getVar('event_categoryid');
        }
		$categoryHandler = \XoopsModules\Countdown2\Helper::getInstance()->getHandler('Category');
		//$objects = $categoryHandler->getList();
        $category_select = new XoopsFormSelect(_AM_COUNTDOWN_CATEGORY, 'event_categoryid', $category_id);
		//$category_select->addOptionArray($objects);
        $this->addElement($category_select);
		
		//$categoryHandler = $helper->getHandler('category');
		//$category_select = new \XoopsFormSelect( _AM_COUNTDOWN_CATEGORY, 'event_categoryid', $category_id);
		//$category_select->addOptionArray($categoryHandler->getList());
		//$form->addElement($category_select, true);
		
        // Name
        $this->addElement(new \XoopsFormText(_AM_COUNTDOWN_EVENTS_NAME, 'event_name', 50, 255, $this->targetObject->getVar('event_name')), false);
        // Description
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'event_description';
            $editorOptions['value']  = $this->targetObject->getVar('event_description', 'e');
            $editorOptions['rows']   = 5;
            $editorOptions['cols']   = 40;
            $editorOptions['width']  = '100%';
            $editorOptions['height'] = '400px';
            //$editorOptions['editor'] = xoops_getModuleOption('countdown_editor', 'countdown');
            //$this->addElement( new \XoopsFormEditor(_AM_COUNTDOWN_EVENTS_DESCRIPTION, 'description', $editorOptions), false  );
            if ($helper->isUserAdmin()) {
                $descEditor = new \XoopsFormEditor(_AM_COUNTDOWN_EVENTS_DESCRIPTION, $helper->getConfig('countdownEditorAdmin'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            } else {
                $descEditor = new \XoopsFormEditor(_AM_COUNTDOWN_EVENTS_DESCRIPTION, $helper->getConfig('countdownEditorUser'), $editorOptions, $nohtml = false, $onfailure = 'textarea');
            }
        } else {
            $descEditor = new \XoopsFormDhtmlTextArea(_AM_COUNTDOWN_EVENTS_DESCRIPTION, 'event_description', $this->targetObject->getVar('event_description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);

		// Event Date
       $this->addElement(new \XoopsFormDateTime(_AM_COUNTDOWN_EVENTS_DATE, 'event_date', '', strtotime($this->targetObject->getVar('event_date'))));

		// Logo
        $logo = $this->targetObject->getVar('event_logo') ?: 'blank.png';

        $uploadDir   = '/uploads/countdown2/images/';
        $imgtray     = new \XoopsFormElementTray(_AM_COUNTDOWN_EVENTS_LOGO, '<br>');
        $imgpath     = sprintf(_AM_COUNTDOWN_FORMIMAGE_PATH, $uploadDir);
        $imageselect = new \XoopsFormSelect($imgpath, 'event_logo', $logo);
        $imageArray  = \XoopsLists::getImgListAsArray(XOOPS_ROOT_PATH . $uploadDir);
        foreach ($imageArray as $image) {
            $imageselect->addOption((string)$image, $image);
        }
        $imageselect->setExtra("onchange='showImgSelected(\"image_logo\", \"logo\", \"" . $uploadDir . '", "", "' . XOOPS_URL . "\")'");
        $imgtray->addElement($imageselect);
        $imgtray->addElement(new \XoopsFormLabel('', "<br><img src='" . XOOPS_URL . '/' . $uploadDir . '/' . $logo . "' name='image_logo' id='image_logo' alt=''>"));
        $fileseltray = new \XoopsFormElementTray('', '<br>');
        $fileseltray->addElement(new \XoopsFormFile(_AM_COUNTDOWN_FORMUPLOAD, 'event_logo', $helper->getConfig('maxsize')));
        $fileseltray->addElement(new \XoopsFormLabel(''));
        $imgtray->addElement($fileseltray);
        $this->addElement($imgtray);
		
		// Submitter
        $this->addElement(new \XoopsFormSelectUser(_AM_COUNTDOWN_EVENTS_POSTERNAME, 'event_uid', false, $this->targetObject->getVar('event_uid'), 1, false), false);
        
		// Data_creation
        $this->addElement(
            new XoopsFormTextDateSelect(
                \_AM_COUNTDOWN_EVENTS_DATE_CREATED, 'date_created', 0, \formatTimestamp($this->targetObject->getVar('date_created'), 's')
            )
        );
        // Data_update
        $this->addElement(
            new XoopsFormTextDateSelect(
                \_AM_COUNTDOWN_EVENTS_DATE_UPDATED, 'date_updated', 0, \formatTimestamp($this->targetObject->getVar('date_updated'), 's')
            )
        );
		
		
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
