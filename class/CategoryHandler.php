<?php

declare(strict_types=1);

namespace XoopsModules\Countdown;

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

use XoopsModules\Countdown;

$moduleDirName = basename(dirname(__DIR__));

$permHelper = new \Xmf\Module\Helper\Permission();

/**
 * Class CategoryHandler
 */
class CategoryHandler extends \XoopsPersistableObjectHandler
{
    /**
     * Constructor
     * @param null|\XoopsDatabase $db
     */

    public function __construct(\XoopsDatabase $db)
    {
        parent::__construct($db, 'countdown_categories', Category::class, 'category_id', 'category_title');
    }
}
