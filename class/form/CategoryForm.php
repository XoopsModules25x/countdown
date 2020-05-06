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
 * Class CategoryForm
 */
class CategoryForm extends \XoopsThemeForm
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

        $title = $this->targetObject->isNew() ? sprintf(_AM_COUNTDOWN_CATEGORY_ADD) : sprintf(_AM_COUNTDOWN_CATEGORY_EDIT);
        parent::__construct($title, 'form', xoops_getenv('PHP_SELF'), 'post', true);
        $this->setExtra('enctype="multipart/form-data"');

        //include ID field, it's needed so the module knows if it is a new form or an edited form

        $hidden = new \XoopsFormHidden('category_id', $this->targetObject->getVar('category_id'));
        $this->addElement($hidden);
        unset($hidden);

        // Id
        $this->addElement(new \XoopsFormLabel(_AM_COUNTDOWN_CATEGORY_ID, $this->targetObject->getVar('category_id'), 'category_id'));
        // Name
        $this->addElement(new \XoopsFormText(_AM_COUNTDOWN_CATEGORY_TITLE, 'category_title', 50, 255, $this->targetObject->getVar('category_title')), false);
		 // Weight
        $this->addElement(new \XoopsFormText(_AM_COUNTDOWN_CATEGORY_WEIGHT, 'category_weight', 5, 255, $this->targetObject->getVar('category_weight')), false);
      
        $this->addElement(new \XoopsFormHidden('op', 'save'));
        $this->addElement(new \XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
    }
}
