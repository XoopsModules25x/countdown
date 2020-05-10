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
// Admin
define('_MI_COUNTDOWN_NAME', 'Countdown');
define('_MI_COUNTDOWN_DESC', 'This module is for doing following...');
//Menu
define('_MI_COUNTDOWN_ADMENU1', 'Home');
define('_MI_COUNTDOWN_ADMENU2', 'Category');
define('_MI_COUNTDOWN_ADMENU3', 'Events');
define('_MI_COUNTDOWN_ADMENU4', 'Permission');
define('_MI_COUNTDOWN_ADMENU5', 'About');
//Blocks
define("_MI_COUNTDOWN_COUNTDOWN_BLOCK","Countdown");
define("_MI_COUNTDOWN_COUNTDOWN_BLOCKDESC","Countdown Timer Block");
// Help
define('_MI_COUNTDOWN_DIRNAME', basename(dirname(dirname(__DIR__))));
define('_MI_COUNTDOWN_HELP_HEADER', __DIR__ . '/help/helpheader.tpl');
define('_MI_COUNTDOWN_BACK_2_ADMIN', 'Back to Administration of ');
define('_MI_COUNTDOWN_OVERVIEW', 'Overview');
// The name of this module
//define('_MI_COUNTDOWN_NAME', 'YYYYY Module Name');

//define('_MI_COUNTDOWN_HELP_DIR', __DIR__);

//help multi-page
define('_MI_COUNTDOWN_DISCLAIMER', 'Disclaimer');
define('_MI_COUNTDOWN_LICENSE', 'License');
define('_MI_COUNTDOWN_SUPPORT', 'Support');
//define('_MI_COUNTDOWN_REQUIREMENTS', 'Requirements');
//define('_MI_COUNTDOWN_CREDITS', 'Credits');
//define('_MI_COUNTDOWN_HOWTO', 'How To');
//define('_MI_COUNTDOWN_UPDATE', 'Update');
//define('_MI_COUNTDOWN_INSTALL', 'Install');
//define('_MI_COUNTDOWN_HISTORY', 'History');
//define('_MI_COUNTDOWN_HELP1', 'YYYYY');
//define('_MI_COUNTDOWN_HELP2', 'YYYYY');
//define('_MI_COUNTDOWN_HELP3', 'YYYYY');
//define('_MI_COUNTDOWN_HELP4', 'YYYYY');
//define('_MI_COUNTDOWN_HELP5', 'YYYYY');
//define('_MI_COUNTDOWN_HELP6', 'YYYYY');

//Config
define('_MI_COUNTDOWN_DISPLAYEVENTDESCRIPTION_TITLE', 'Display Event Description ?');
define('_MI_COUNTDOWN_DISPLAYEVENTDESCRIPTION_DESC', 'Display event description in event list and event view page ?');
define('_MI_COUNTDOWN_DISPLAYPOSTINFO_TITLE', 'Display Event Post Info ?');
define('_MI_COUNTDOWN_DISPLAYPOSTINFO_DESC', 'Display submitted date, poster name and category in event list and event view page ?');
define('_MI_COUNTDOWN_DISPLAYEVENTLOGO_TITLE', 'Display Event Logo ?');
define('_MI_COUNTDOWN_DISPLAYEVENTLOGO_DESC', 'Display event logo in event list and event view page ?');
define('_MI_COUNTDOWN_EDITOR_ADMIN', 'Editor: Admin');
define('_MI_COUNTDOWN_EDITOR_ADMIN_DESC', 'Select the Editor to use by the Admin');
define('_MI_COUNTDOWN_EDITOR_USER', 'Editor: User');
define('_MI_COUNTDOWN_EDITOR_USER_DESC', 'Select the Editor to use by the User');
define('_MI_COUNTDOWN_KEYWORDS', 'Meta Keywords');
define('_MI_COUNTDOWN_KEYWORDS_DESC', 'Insert here the keywords (separate by comma)');
define('_MI_COUNTDOWN_ADMINEVENTPERPAGE', 'Admin: Event per page');
define('_MI_COUNTDOWN_ADMINEVENTPERPAGE_DESC', 'Admin: Event records shown per page');
define('_MI_COUNTDOWN_USEREVENTPERPAGE', 'User: Event per page');
define('_MI_COUNTDOWN_USEREVENTPERPAGE_DESC', 'User: Eevent records shown per page');
define('_MI_COUNTDOWN_MAXSIZE', 'Max size');
define('_MI_COUNTDOWN_MAXSIZE_DESC', 'Set a number of max size uploads file in byte');
define('_MI_COUNTDOWN_MIMETYPES', 'Mime Types');
define('_MI_COUNTDOWN_MIMETYPES_DESC', 'Set the mime types selected');

// Permissions Groups
define('_MI_COUNTDOWN_GROUPS', 'Groups access');
define('_MI_COUNTDOWN_GROUPS_DESC', 'Select general access permission for groups.');
define('_MI_COUNTDOWN_ADMINGROUPS', 'Admin Group Permissions');
define('_MI_COUNTDOWN_ADMINGROUPS_DESC', 'Which groups have access to tools and permissions page');

// Preferences
define('_MI_COUNTDOWN_CONFCAT_EVENTS', 'Event Preferences');
define('_MI_COUNTDOWN_CONFCAT_EVENTS_DSC', '');
define('_MI_COUNTDOWN_CONFCAT_GENERAL', 'General Preferences');
define('_MI_COUNTDOWN_CONFCAT_GENERAL_DSC', '');
define('_MI_COUNTDOWN_CONFCAT_IMAGE', 'Image Upload Preferences');
define('_MI_COUNTDOWN_CONFCAT_IMAGE_DSC', '');
define('_MI_COUNTDOWN_CONFCAT_EDITOR', 'Editor Preferences');
define('_MI_COUNTDOWN_CONFCAT_EDITOR_DSC', '');
define('_MI_COUNTDOWN_CONFCAT_PERMISSION', 'Permission Preferences');
define('_MI_COUNTDOWN_CONFCAT_PERMISSION_DSC', '');
define('_MI_COUNTDOWN_CONFCAT_COMMENT', 'Comment Preferences');
define('_MI_COUNTDOWN_CONFCAT_COMMENT_DSC', '');



//Config Categories Styling:
define('_MI_COUNTDOWN_CONFIG_STYLING_START', '<span style="color: #FF0000; font-size: Small;  font-weight: bold;">:: ');
define('_MI_COUNTDOWN_CONFIG_STYLING_END', ' ::</span> ');
define('_MI_COUNTDOWN_CONFIG_STYLING_DESC_START', '<span style="color: #FF0000; font-size: Small;">');
define('_MI_COUNTDOWN_CONFIG_STYLING_DESC_END', '</span> ');
define('_MI_COUNTDOWN_CONFIG_EVENTS', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_EVENTS . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_EVENTS_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_EVENTS_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);
define('_MI_COUNTDOWN_CONFIG_GENERAL', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_GENERAL . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_GENERAL_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_GENERAL_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);
define('_MI_COUNTDOWN_CONFIG_IMAGE', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_IMAGE . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_IMAGE_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_IMAGE_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);
define('_MI_COUNTDOWN_CONFIG_PERMISSION', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_PERMISSION . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_PERMISSION_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_PERMISSION_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);
define('_MI_COUNTDOWN_CONFIG_EDITOR', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_EDITOR . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_EDITOR_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_EDITOR_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);
define('_MI_COUNTDOWN_CONFIG_COMMENT', _MI_COUNTDOWN_CONFIG_STYLING_START . _MI_COUNTDOWN_CONFCAT_COMMENT . _MI_COUNTDOWN_CONFIG_STYLING_END);
define('_MI_COUNTDOWN_CONFIG_COMMENT_DSC', _MI_COUNTDOWN_CONFIG_STYLING_DESC_START . _MI_COUNTDOWN_CONFCAT_COMMENT_DSC . _MI_COUNTDOWN_CONFIG_STYLING_DESC_END);

