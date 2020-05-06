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

use Xmf\Request;
use XoopsModules\Countdown;

require_once __DIR__ . '/../../../include/cp_header.php';
require_once __DIR__ . '/../../../class/xoopsformloader.php';

require_once __DIR__ . '/../include/common.php';

include __DIR__ . '/../preloads/autoloader.php';

$moduleDirName = basename(dirname(__DIR__));

/** @var Countdown\Helper $helper */
$helper = Countdown\Helper::getInstance();
/** @var Xmf\Module\Admin $adminObject */
$adminObject = \Xmf\Module\Admin::getInstance();

$db = \XoopsDatabaseFactory::getDatabaseConnection();

$pathIcon16    = \Xmf\Module\Admin::iconUrl('', 16);
$pathIcon32    = \Xmf\Module\Admin::iconUrl('', 32);
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');

/** @var \XoopsPersistableObjectHandler $eventsHandler */
$eventsHandler = new Countdown\EventsHandler($db);
$categoryHandler = new Countdown\CategoryHandler($db);

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
