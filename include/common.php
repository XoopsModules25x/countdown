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

use XoopsModules\Countdown;

include __DIR__ . '/../preloads/autoloader.php';

$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = strtoupper($moduleDirName);

/** @var \XoopsDatabase $db */
/** @var  Countdown\Helper $helper */
/** @var Countdown\Utility $utility */

$db      = \XoopsDatabaseFactory::getDatabaseConnection();
$helper  = Countdown\Helper::getInstance();
$utility = new Countdown\Utility();
//$configurator = new Countdown\Common\Configurator();

$helper->loadLanguage('common');

//handlers/** @var \XoopsPersistableObjectHandler $eventsHandler */ 
$eventsHandler = new Countdown\EventsHandler($db);
$categoryHandler = new Countdown\CategoryHandler($db);

$pathIcon16 = Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32 = Xmf\Module\Admin::iconUrl('', 32);
//$pathModIcon16 = $helper->getModule()->getInfo('modicons16');
//$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

if (!defined($moduleDirNameUpper . '_CONSTANTS_DEFINED')) {
    define($moduleDirNameUpper . '_DIRNAME', basename(dirname(__DIR__)));
    define($moduleDirNameUpper . '_ROOT_PATH', XOOPS_ROOT_PATH . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_PATH', XOOPS_ROOT_PATH . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_URL', XOOPS_URL . '/modules/' . $moduleDirName);
    define($moduleDirNameUpper . '_IMAGES_URL', constant($moduleDirNameUpper . '_URL') . '/assets/images/');
    define($moduleDirNameUpper . '_IMAGES_PATH', constant($moduleDirNameUpper . '_ROOT_PATH') . '/assets/images/');
    define($moduleDirNameUpper . '_ADMIN_URL', constant($moduleDirNameUpper . '_URL') . '/admin/');
    define($moduleDirNameUpper . '_ADMIN_PATH', constant($moduleDirNameUpper . '_ROOT_PATH') . '/admin/');
    define($moduleDirNameUpper . '_ADMIN', constant($moduleDirNameUpper . '_URL') . '/admin/index.php');
    //    define($moduleDirNameUpper . '_AUTHOR_LOGOIMG', constant($moduleDirNameUpper . '_URL') . '/assets/images/logoModule.png');
    define($moduleDirNameUpper . '_UPLOAD_URL', XOOPS_UPLOAD_URL . '/' . $moduleDirName); // WITHOUT Trailing slash
    define($moduleDirNameUpper . '_UPLOAD_PATH', XOOPS_UPLOAD_PATH . '/' . $moduleDirName); // WITHOUT Trailing slash
    define($moduleDirNameUpper . '_CAT_IMAGES_URL', XOOPS_UPLOAD_URL . ' / ' . constant($moduleDirNameUpper . '_DIRNAME') . '/images/category');
    define($moduleDirNameUpper . '_CAT_IMAGES_PATH', XOOPS_UPLOAD_PATH . '/' . constant($moduleDirNameUpper . '_DIRNAME') . ' / images / category');
    define($moduleDirNameUpper . '_CACHE_PATH', XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/');
    define($moduleDirNameUpper . '_AUTHOR_LOGOIMG', $pathIcon32 . '/xoopsmicrobutton.gif');
    define($moduleDirNameUpper . '_CONSTANTS_DEFINED', 1);
}

//define option du module
//define($moduleDirNameUpper. '_DISPLAY_CAT', $helper->getConfig('$mod_name_cat_display', 'none'));

//require_once __DIR__ . '/../include/seo_functions.php';
//require_once __DIR__ . '/../class/PageNav.php';

//require_once XOOPS_ROOT_PATH . '/class/tree.php';

//require_once __DIR__ . '/../class/Tree.php';
//require_once __DIR__ . '/../class/FormSelect.php';

// Load only if module is installed
//if (is_object($helper->getModule())) {
//    // Find if the user is admin of the module
//    $publisherIsAdmin = publisher\Utility::userIsAdmin();
//    // get current page
//    $publisherCurrentPage = publisher\Utility::getCurrentPage();
//}

$icons = [
    'edit'    => "<img src='" . $pathIcon16 . "/edit.png'  alt=" . _EDIT . "' align='middle'>",
    'delete'  => "<img src='" . $pathIcon16 . "/delete.png' alt='" . _DELETE . "' align='middle'>",
    'clone'   => "<img src='" . $pathIcon16 . "/editcopy.png' alt='" . _CLONE . "' align='middle'>",
    'preview' => "<img src='" . $pathIcon16 . "/view.png' alt='" . _PREVIEW . "' align='middle'>",
    'print'   => "<img src='" . $pathIcon16 . "/printer.png' alt='" . _CLONE . "' align='middle'>",
    'pdf'     => "<img src='" . $pathIcon16 . "/pdf.png' alt='" . _CLONE . "' align='middle'>",
    'add'     => "<img src='" . $pathIcon16 . "/add.png' alt='" . _ADD . "' align='middle'>",
    '0'       => "<img src='" . $pathIcon16 . "/0.png' alt='" . 0 . "' align='middle'>",
    '1'       => "<img src='" . $pathIcon16 . "/1.png' alt='" . 1 . "' align='middle'>",
    //'active'  => "<img src='" . $pathIcon16 . "/active.gif' alt='" . _MD_ACTIVE . "' align='middle'>",
];

$debug = false;

// MyTextSanitizer object
$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoopsTpl']) || !($GLOBALS['xoopsTpl'] instanceof \XoopsTpl)) {
    require_once $GLOBALS['xoops']->path('class/template.php');
    $GLOBALS['xoopsTpl'] = new \XoopsTpl();
}

$GLOBALS['xoopsTpl']->assign('mod_url', XOOPS_URL . '/modules/' . $moduleDirName);
// Local icons path
if (is_object($helper->getModule())) {
    $pathModIcon16 = $helper->getModule()->getInfo('modicons16');
    $pathModIcon32 = $helper->getModule()->getInfo('modicons32');

    $GLOBALS['xoopsTpl']->assign('pathModIcon16', XOOPS_URL . '/modules/' . $moduleDirName . '/' . $pathModIcon16);
    $GLOBALS['xoopsTpl']->assign('pathModIcon32', $pathModIcon32);
}
