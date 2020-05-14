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

use Xmf\Request;
use XoopsModules\Countdown2;

require_once  dirname(dirname(dirname(__DIR__))) . '/include/cp_header.php';
require_once  dirname(dirname(dirname(__DIR__))) . '/class/xoopsformloader.php';

require_once  dirname(__DIR__) . '/include/common.php';

require  dirname(__DIR__) . '/preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var Countdown2\Helper $helper */
$helper = Countdown2\Helper::getInstance();
/** @var Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

$db = \XoopsDatabaseFactory::getDatabaseConnection();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

/** @var \XoopsPersistableObjectHandler $eventsHandler */
$eventsHandler = new Countdown2\EventsHandler($db);
$categoryHandler = new Countdown2\CategoryHandler($db);

$myts = \MyTextSanitizer::getInstance();
if (!isset($xoopsTpl) || !is_object($xoopsTpl)) {
    require_once XOOPS_ROOT_PATH . '/class/template.php';
    $xoopsTpl = new \XoopsTpl();
}

// Load language files
$helper->loadLanguage('admin');
$helper->loadLanguage('modinfo');
$helper->loadLanguage('common');

//xoops_cp_header();
