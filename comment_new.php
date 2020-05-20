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

require_once  dirname(dirname(__DIR__)) . '/mainfile.php';
$com_itemid = Request::getInt('com_itemid', 0);
if ($com_itemid > 0) {

    /** @var \XoopsPersistableObjectHandler $eventsHandler */
    $eventsHandler =  $helper->getHandler('Events');
    
    $events         = $eventsHandler->get($com_itemid);
    $com_replytitle = $events->getVar('id');
    require XOOPS_ROOT_PATH . '/include/comment_new.php';
}
