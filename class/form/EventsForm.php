<?php namespace XoopsModules\Countdown\Form;

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

require_once __DIR__ . '/../../include/common.php';

$moduleDirName = basename(dirname(dirname(__DIR__)));
$helper        = Countdown\Helper::getInstance();
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
        global $helper;
        $this->targetObject = $target;

        $title = $this->targetObject->isNew() ? sprintf(_AM_COUNTDOWN_EVENTS_ADD) : sprintf(_AM_COUNTDOWN_EVENTS_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('id', $this->targetObject->getVar('id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(_AM_COUNTDOWN_EVENTS_ID, $this->targetObject->getVar('id'), 'id'));
        // Uid
        $this->addElement(new \XoopsFormSelectUser(_AM_COUNTDOWN_EVENTS_UID, 'uid', false, $this->targetObject->getVar('uid'), 1, false), false);
        // Name
        $this->addElement(new \XoopsFormText(_AM_COUNTDOWN_EVENTS_NAME, 'name', 50, 255, $this->targetObject->getVar('name')), false);
        // Description
        if (class_exists('XoopsFormEditor')) {
            $editorOptions           = array();
            $editorOptions['name']   = 'description';
            $editorOptions['value']  = $this->targetObject->getVar('description', 'e');
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
            $descEditor = new \XoopsFormDhtmlTextArea(_AM_COUNTDOWN_EVENTS_DESCRIPTION, 'description', $this->targetObject->getVar('description', 'e'), '100%', '100%');
        }
        $this->addElement($descEditor);
        // Enddatetime
        $this->addElement(new \XoopsFormDateTime(_AM_COUNTDOWN_EVENTS_ENDDATETIME, 'enddatetime', '', strtotime($this->targetObject->getVar('enddatetime'))));

        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
