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

use XoopsModules\Countdown2;

require  dirname(__DIR__) . '/preloads/autoloader.php';

$helper = Countdown2\Helper::getInstance();

// get path to icons
$pathIcon32    = \Xmf\Module\Admin::menuIconPath('');
$pathModIcon32 = $helper->getModule()->getInfo('modicons32');
$adminObject   = \Xmf\Module\Admin::getInstance();

$adminmenu[] = [
    'title' => _MI_COUNTDOWN_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => "{$pathIcon32}/home.png"
];

$adminmenu[] = [
    'title' => _MI_COUNTDOWN_ADMENU2,
    'link'  => 'admin/category.php',
    'icon'  => "{$pathIcon32}/category.png"
];

$adminmenu[] = [
    'title' => _MI_COUNTDOWN_ADMENU3,
    'link'  => 'admin/events.php',
    'icon'  => "{$pathIcon32}/event.png"
];

//$adminmenu[] = [
//    'title' => _MI_COUNTDOWN_ADMENU4,
//    'link'  => 'admin/permissions.php',
//    'icon'  => "{$pathIcon32}/permissions.png"
//];

$adminmenu[] = [
    'title' => _MI_COUNTDOWN_ADMENU5,
    'link'  => 'admin/about.php',
    'icon'  => "{$pathIcon32}/about.png"
];
