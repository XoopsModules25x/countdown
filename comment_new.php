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

require_once __DIR__ . '/../../mainfile.php';
require_once XOOPS_ROOT_PATH . '/modules/countdown/class/events.php';
$com_itemid = Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {

    /** @var \XoopsPersistableObjectHandler $eventsHandler */
    $eventsHandler = new countdown\\{Events}Handler($db);
    
    $events         = $eventsHandler->get($com_itemid);
    $com_replytitle = $events->getVar('id');
    include XOOPS_ROOT_PATH . '/include/comment_new.php';
}
