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
 * Module: Countdown
 *
 * @category        Module
 * @package         countdown
 * @author          XOOPS Development Team <https://xoops.org>
 * @copyright       {@link https://xoops.org/ XOOPS Project}
 * @license         GNU GPL 2 or later (https://www.gnu.org/licenses/gpl-2.0.html)
 * @link            https://xoops.org/
 * @since           1.0.0
 */

use Xmf\Request;
use XoopsModules\Countdown;
use XoopsModules\Countdown\Helper;
use XoopsModules\Countdown\Common;

require_once dirname(dirname(__DIR__)) . '/mainfile.php';
require_once XOOPS_ROOT_PATH . '/header.php';

$moduleDirName = basename(__DIR__);

$helper       = Countdown\Helper::getInstance();
$utility      = new Countdown\Utility();
$configurator = new Common\Configurator();
$copyright    = $configurator->modCopyright;

$modulePath = XOOPS_ROOT_PATH . '/modules/' . $moduleDirName;
require_once __DIR__ . '/include/common.php';
$db = \XoopsDatabaseFactory::getDatabaseConnection();

$myts = \MyTextSanitizer::getInstance();

if (!isset($GLOBALS['xoTheme']) || !is_object($GLOBALS['xoTheme'])) {
    require $GLOBALS['xoops']->path('class/theme.php');
    $GLOBALS['xoTheme'] = new xos_opal_Theme();
}

$stylesheet = "modules/{$moduleDirName}/assets/css/style.css";
if (file_exists($GLOBALS['xoops']->path($stylesheet))) {
    $GLOBALS['xoTheme']->addStylesheet($GLOBALS['xoops']->url("www/{$stylesheet}"));
}
/** @var \XoopsPersistableObjectHandler $eventsHandler */
$eventsHandler   = new Countdown\EventsHandler($db);
$categoryHandler = new Countdown\CategoryHandler($db);

// Load language files
$helper->loadLanguage('main');
$helper->loadLanguage('modinfo');
