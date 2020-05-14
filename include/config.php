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
$moduleDirName      = basename(dirname(__DIR__));
$moduleDirNameUpper = strtoupper($moduleDirName);

//Configurator
return (object)[
    'name'           => strtoupper($moduleDirName) . ' Module Configurator',
    'paths'          => [
        'dirname'    => $moduleDirName,
        'admin'      => XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/admin',
        'modPath'    => XOOPS_ROOT_PATH . '/modules/' . $moduleDirName,
        'modUrl'     => XOOPS_URL . '/modules/' . $moduleDirName,
        'uploadPath' => XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        'uploadUrl'  => XOOPS_UPLOAD_URL . '/' . $moduleDirName,
    ],
    'uploadFolders'  => [
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName,
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/thumbnails'
    ],
    'copyBlankFiles' => [
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images',
        XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images/thumbnails'
    ],

    'copyTestFolders' => [
        [
            XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/testdata/images',
            XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/images',
        ],
        [
            XOOPS_ROOT_PATH . '/modules/' . $moduleDirName . '/testdata/thumbs',
            XOOPS_UPLOAD_PATH . '/' . $moduleDirName . '/thumbs',
        ]
    ],

    'templateFolders' => [
        '/templates/',
        '/templates/blocks/',
        '/templates/admin/'

    ],
    'oldFiles'        => [
        '/include/update_functions.php',
        '/include/install_functions.php'
    ],
    'oldFolders'      => [
        '/images',
        '/css',
        '/js',
        '/tcpdf',
        '/images',
    ],
    'modCopyright'    => "<a href='https://xoops.org' title='XOOPS Project' target='_blank'>
                     <img src='" . constant($moduleDirNameUpper . '_AUTHOR_LOGOIMG') . '\' alt=\'XOOPS Project\'></a>',

];
