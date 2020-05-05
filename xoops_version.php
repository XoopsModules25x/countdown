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
$moduleDirName = basename(__DIR__);

$modversion = [
    'version'             => 2.0,
    'module_status'       => 'Beta 1',
    'release_date'        => '2018/01/06',
    'name'                => _MI_COUNTDOWN_NAME,
    'description'         => _MI_COUNTDOWN_DESC,
    'release'             => '2018-01-06',
    'author'              => 'XOOPS Development Team',
    'author_mail'         => 'name@site.com',
    'author_website_url'  => 'https://xoops.org',
    'author_website_name' => 'XOOPS Project',
    'credits'             => 'XOOPS Development Team',
    //    'license' => 'GPL 2.0 or later',
    'help'                => 'page=help',
    'license'             => 'GPL 2.0 or later',
    'license_url'         => 'www.gnu.org/licenses/gpl-2.0.html',

    'release_info' => 'release_info',
    'release_file' => XOOPS_URL . "/modules/{$moduleDirName}/docs/release_info file",

    'manual'              => 'Installation.txt',
    'manual_file'         => XOOPS_URL . "/modules/{$moduleDirName}/docs/link to manual file",
    'min_php'             => '5.5',
    'min_xoops'           => '2.5.9',
    'min_admin'           => '1.2',
    'min_db'              => ['mysql' => '5.5'],
    'image'               => 'assets/images/countdown_logo.png',
    'dirname'             => $moduleDirName,
    'modicons16'          => 'assets/images/icons/16',
    'modicons32'          => 'assets/images/icons/32',
    //About
    'demo_site_url'       => 'https://xoops.org',
    'demo_site_name'      => 'XOOPS Demo Site',
    'support_url'         => 'https://xoops.org/modules/newbb',
    'support_name'        => 'Support Forum',
    'module_website_url'  => 'www.xoops.org',
    'module_website_name' => 'XOOPS Project',
    // Admin system menu
    'system_menu'         => 1,
    // Admin things
    'hasAdmin'            => 1,
    'adminindex'          => 'admin/index.php',
    'adminmenu'           => 'admin/menu.php',
    // Menu
    'hasMain'             => 1,
    // Scripts to run upon installation or update
    'onInstall'           => 'include/oninstall.php',
    'onUpdate'            => 'include/onupdate.php',
    'onUninstall'         => 'include/onuninstall.php',
    // ------------------- Mysql -----------------------------
    'sqlfile'             => ['mysql' => 'sql/mysql.sql'],
    // ------------------- Tables ----------------------------
    'tables'              => [
        $moduleDirName . '_' . 'events',
    ],
];
// ------------------- Search -----------------------------//
$modversion['hasSearch']      = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'countdown_search';
//  ------------------- Comments -----------------------------//
$modversion['hasComments']          = 1;
$modversion['comments']['itemName'] = 'com_id';
$modversion['comments']['pageName'] = 'comments.php';
// Comment callback functions
$modversion['comments']['callbackFile']        = 'include/comment_functions.php';
$modversion['comments']['callback']['approve'] = 'countdown_com_approve';
$modversion['comments']['callback']['update']  = 'countdown_com_update';
//  ------------------- Templates -----------------------------//
$modversion['templates'][] = ['file' => 'countdown_header.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'countdown_events.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'countdown_events_list.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'countdown_footer.tpl', 'description' => ''];

$modversion['templates'][] = ['file' => 'admin/countdown_admin_about.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/countdown_admin_help.tpl', 'description' => ''];
$modversion['templates'][] = ['file' => 'admin/countdown_admin_events.tpl', 'description' => ''];

// ------------------- Help files ------------------- //
$modversion['helpsection'] = [
    ['name' => _MI_COUNTDOWN_OVERVIEW, 'link' => 'page=help'],
    ['name' => _MI_COUNTDOWN_DISCLAIMER, 'link' => 'page=disclaimer'],
    ['name' => _MI_COUNTDOWN_LICENSE, 'link' => 'page=license'],
    ['name' => _MI_COUNTDOWN_SUPPORT, 'link' => 'page=support'],

    //    ['name' => _MI_COUNTDOWN_HELP1, 'link' => 'page=help1'],
    //    ['name' => _MI_COUNTDOWN_HELP2, 'link' => 'page=help2']
    //    ['name' => _MI_COUNTDOWN_HELP3, 'link' => 'page=help3'],
    //    ['name' => _MI_COUNTDOWN_HELP4, 'link' => 'page=help4'],
    //    ['name' => _MI_COUNTDOWN_HOWTO, 'link' => 'page=__howto'],
    //    ['name' => _MI_COUNTDOWN_REQUIREMENTS, 'link' => 'page=__requirements'],
    //    ['name' => _MI_COUNTDOWN_CREDITS, 'link' => 'page=__credits'],

];

// ------------------- Blocks -----------------------------//
// ------------------- Config Options -----------------------------//
xoops_load('xoopseditorhandler');
$editorHandler          = \XoopsEditorHandler::getInstance();
$modversion['config'][] = [
    'name'        => 'countdownEditorAdmin',
    'title'       => '_MI_COUNTDOWN_EDITOR_ADMIN',
    'description' => '_MI_COUNTDOWN_EDITOR_DESC_ADMIN',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'tinymce'
];

$modversion['config'][] = [
    'name'        => 'countdownEditorUser',
    'title'       => '_MI_COUNTDOWN_EDITOR_USER',
    'description' => '_MI_COUNTDOWN_EDITOR_DESC_USER',
    'formtype'    => 'select',
    'valuetype'   => 'text',
    'options'     => array_flip($editorHandler->getList()),
    'default'     => 'dhtmltextarea'
];

// -------------- Get groups --------------
/** @var XoopsMemberHandler $memberHandler */
$memberHandler = xoops_getHandler('member');
$xoopsGroups   = $memberHandler->getGroupList();
foreach ($xoopsGroups as $key => $group) {
    $groups[$group] = $key;
}
$modversion['config'][] = [
    'name'        => 'groups',
    'title'       => '_MI_COUNTDOWN_GROUPS',
    'description' => '_MI_COUNTDOWN_GROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $groups,
    'default'     => $groups
];

// -------------- Get Admin groups --------------
$criteria = new \CriteriaCompo ();
$criteria->add(new \Criteria ('group_type', 'Admin'));
/** @var XoopsMemberHandler $memberHandler */
$memberHandler    = xoops_getHandler('member');
$adminXoopsGroups = $memberHandler->getGroupList($criteria);
foreach ($adminXoopsGroups as $key => $adminGroup) {
    $admin_groups[$adminGroup] = $key;
}
$modversion['config'][] = [
    'name'        => 'admin_groups',
    'title'       => '_MI_COUNTDOWN_ADMINGROUPS',
    'description' => '_MI_COUNTDOWN_ADMINGROUPS_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'options'     => $admin_groups,
    'default'     => $admin_groups
];

$modversion['config'][] = [
    'name'        => 'keywords',
    'title'       => '_MI_COUNTDOWN_KEYWORDS',
    'description' => '_MI_COUNTDOWN_KEYWORDS_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'text',
    'default'     => 'countdown,'
];

// --------------Uploads : maxsize of image --------------
$modversion['config'][] = [
    'name'        => 'maxsize',
    'title'       => '_MI_COUNTDOWN_MAXSIZE',
    'description' => '_MI_COUNTDOWN_MAXSIZE_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 5000000
];

// --------------Uploads : mimetypes of image --------------
$modversion['config'][] = [
    'name'        => 'mimetypes',
    'title'       => '_MI_COUNTDOWN_MIMETYPES',
    'description' => '_MI_COUNTDOWN_MIMETYPES_DESC',
    'formtype'    => 'select_multi',
    'valuetype'   => 'array',
    'default'     => ['image/gif', 'image/jpeg', 'image/png'],
    'options'     => [
        'bmp'   => 'image/bmp',
        'gif'   => 'image/gif',
        'pjpeg' => 'image/pjpeg',
        'jpeg'  => 'image/jpeg',
        'jpg'   => 'image/jpg',
        'jpe'   => 'image/jpe',
        'png'   => 'image/png'
    ]
];

$modversion['config'][] = [
    'name'        => 'adminpager',
    'title'       => '_MI_COUNTDOWN_ADMINPAGER',
    'description' => '_MI_COUNTDOWN_ADMINPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];

$modversion['config'][] = [
    'name'        => 'userpager',
    'title'       => '_MI_COUNTDOWN_USERPAGER',
    'description' => '_MI_COUNTDOWN_USERPAGER_DESC',
    'formtype'    => 'textbox',
    'valuetype'   => 'int',
    'default'     => 10
];

$modversion['config'][] = [
    'name'        => 'advertise',
    'title'       => '_MI_COUNTDOWN_ADVERTISE',
    'description' => '_MI_COUNTDOWN_ADVERTISE_DESC',
    'formtype'    => 'textarea',
    'valuetype'   => 'text',
    'default'     => ''
];

$modversion['config'][] = [
    'name'        => 'bookmarks',
    'title'       => '_MI_COUNTDOWN_BOOKMARKS',
    'description' => '_MI_COUNTDOWN_BOOKMARKS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

$modversion['config'][] = [
    'name'        => 'fbcomments',
    'title'       => '_MI_COUNTDOWN_FBCOMMENTS',
    'description' => '_MI_COUNTDOWN_FBCOMMENTS_DESC',
    'formtype'    => 'yesno',
    'valuetype'   => 'int',
    'default'     => 0
];

// -------------- Notifications countdown --------------
$modversion['hasNotification']             = 1;
$modversion['notification']['lookup_file'] = 'include/notification.inc.php';
$modversion['notification']['lookup_func'] = 'countdown_notify_iteminfo';

$modversion['notification']['category'][] = [
    'name'           => 'global',
    'title'          => _MI_COUNTDOWN_GLOBAL_NOTIFY,
    'description'    => _MI_COUNTDOWN_GLOBAL_NOTIFY_DESC,
    'subscribe_from' => ['index.php', 'viewcat.php', 'singlefile.php']
];

$modversion['notification']['category'][] = [
    'name'           => 'category',
    'title'          => _MI_COUNTDOWN_CATEGORY_NOTIFY,
    'description'    => _MI_COUNTDOWN_CATEGORY_NOTIFY_DESC,
    'subscribe_from' => ['viewcat.php', 'singlefile.php'],
    'item_name'      => 'cid',
    'allow_bookmark' => 1
];

$modversion['notification']['category'][] = [
    'name'           => 'file',
    'title'          => _MI_COUNTDOWN_FILE_NOTIFY,
    'description'    => _MI_COUNTDOWN_FILE_NOTIFY_DESC,
    'subscribe_from' => 'singlefile.php',
    'item_name'      => 'lid',
    'allow_bookmark' => 1
];

$modversion['notification']['event'][] = [
    'name'          => 'new_category',
    'category'      => 'global',
    'title'         => _MI_COUNTDOWN_GLOBAL_NEWCATEGORY_NOTIFY,
    'caption'       => _MI_COUNTDOWN_GLOBAL_NEWCATEGORY_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_GLOBAL_NEWCATEGORY_NOTIFY_DESC,
    'mail_template' => 'global_newcategory_notify',
    'mail_subject'  => _MI_COUNTDOWN_GLOBAL_NEWCATEGORY_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_modify',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_COUNTDOWN_GLOBAL_FILEMODIFY_NOTIFY,
    'caption'       => _MI_COUNTDOWN_GLOBAL_FILEMODIFY_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_GLOBAL_FILEMODIFY_NOTIFY_DESC,
    'mail_template' => 'global_filemodify_notify',
    'mail_subject'  => _MI_COUNTDOWN_GLOBAL_FILEMODIFY_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_broken',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_COUNTDOWN_GLOBAL_FILEBROKEN_NOTIFY,
    'caption'       => _MI_COUNTDOWN_GLOBAL_FILEBROKEN_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_GLOBAL_FILEBROKEN_NOTIFY_DESC,
    'mail_template' => 'global_filebroken_notify',
    'mail_subject'  => _MI_COUNTDOWN_GLOBAL_FILEBROKEN_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'global',
    'admin_only'    => 1,
    'title'         => _MI_COUNTDOWN_GLOBAL_FILESUBMIT_NOTIFY,
    'caption'       => _MI_COUNTDOWN_GLOBAL_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_GLOBAL_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'global_filesubmit_notify',
    'mail_subject'  => _MI_COUNTDOWN_GLOBAL_FILESUBMIT_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'global',
    'title'         => _MI_COUNTDOWN_GLOBAL_NEWFILE_NOTIFY,
    'caption'       => _MI_COUNTDOWN_GLOBAL_NEWFILE_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_GLOBAL_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'global_newfile_notify',
    'mail_subject'  => _MI_COUNTDOWN_GLOBAL_NEWFILE_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'file_submit',
    'category'      => 'category',
    'admin_only'    => 1,
    'title'         => _MI_COUNTDOWN_CATEGORY_FILESUBMIT_NOTIFY,
    'caption'       => _MI_COUNTDOWN_CATEGORY_FILESUBMIT_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_CATEGORY_FILESUBMIT_NOTIFY_DESC,
    'mail_template' => 'category_filesubmit_notify',
    'mail_subject'  => _MI_COUNTDOWN_CATEGORY_FILESUBMIT_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'new_file',
    'category'      => 'category',
    'title'         => _MI_COUNTDOWN_CATEGORY_NEWFILE_NOTIFY,
    'caption'       => _MI_COUNTDOWN_CATEGORY_NEWFILE_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_CATEGORY_NEWFILE_NOTIFY_DESC,
    'mail_template' => 'category_newfile_notify',
    'mail_subject'  => _MI_COUNTDOWN_CATEGORY_NEWFILE_NOTIFY_SUBJECT
];

$modversion['notification']['event'][] = [
    'name'          => 'approve',
    'category'      => 'file',
    'admin_only'    => 1,
    'title'         => _MI_COUNTDOWN_FILE_APPROVE_NOTIFY,
    'caption'       => _MI_COUNTDOWN_FILE_APPROVE_NOTIFY_CAPTION,
    'description'   => _MI_COUNTDOWN_FILE_APPROVE_NOTIFY_DESC,
    'mail_template' => 'file_approve_notify',
    'mail_subject'  => _MI_COUNTDOWN_FILE_APPROVE_NOTIFY_SUBJECT
];