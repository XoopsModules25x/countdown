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

//Index
define('AM_COUNTDOWN_STATISTICS', 'Countdown statistics');
define('AM_COUNTDOWN_THEREARE_EVENTS', "There are <span class='bold'>%s</span> Events in the database");
//Buttons
define('AM_COUNTDOWN_ADD_EVENTS', 'Add new Events');
define('AM_COUNTDOWN_EVENTS_LIST', 'List of Events');
//General
define('AM_COUNTDOWN_FORMOK', 'Registered successfull');
define('AM_COUNTDOWN_FORMDELOK', 'Deleted successfull');
define('AM_COUNTDOWN_FORMSUREDEL', "Are you sure to Delete: <span class='bold red'>%s</span></b>");
define('AM_COUNTDOWN_FORMSURERENEW', "Are you sure to Renew: <span class='bold red'>%s</span></b>");
define('AM_COUNTDOWN_FORMUPLOAD', 'Upload');
define('AM_COUNTDOWN_FORMIMAGE_PATH', 'File presents in %s');
define('AM_COUNTDOWN_FORM_ACTION', 'Action');
define('AM_COUNTDOWN_SELECT', 'Select action for selected item(s)');
define('AM_COUNTDOWN_SELECTED_DELETE', 'Delete selected item(s)');
define('AM_COUNTDOWN_SELECTED_ACTIVATE', 'Activate selected item(s)');
define('AM_COUNTDOWN_SELECTED_DEACTIVATE', 'De-activate selected item(s)');
define('AM_COUNTDOWN_SELECTED_ERROR', 'You selected nothing to delete');
define('AM_COUNTDOWN_CLONED_OK', 'Record cloned successfully');
define('AM_COUNTDOWN_CLONED_FAILED', 'Cloning of the record has failed');

// Events
define('AM_COUNTDOWN_EVENTS_ADD', 'Add a events');
define('AM_COUNTDOWN_EVENTS_EDIT', 'Edit events');
define('AM_COUNTDOWN_EVENTS_DELETE', 'Delete events');
define('AM_COUNTDOWN_EVENTS_ID', 'ID');
define('AM_COUNTDOWN_EVENTS_UID', 'User');
define('AM_COUNTDOWN_EVENTS_NAME', 'Event');
define('AM_COUNTDOWN_EVENTS_DESCRIPTION', 'Description');
define('AM_COUNTDOWN_EVENTS_ENDDATETIME', 'End Date/Time');
define('AM_COUNTDOWN_TIME_REMAINING', 'Time Remaining');
//Blocks.php
//Permissions
define('AM_COUNTDOWN_PERMISSIONS_GLOBAL', 'Global permissions');
define('AM_COUNTDOWN_PERMISSIONS_GLOBAL_DESC', 'Only users in the group that you select may global this');
define('AM_COUNTDOWN_PERMISSIONS_GLOBAL_4', 'Rate from user');
define('AM_COUNTDOWN_PERMISSIONS_GLOBAL_8', 'Submit from user side');
define('AM_COUNTDOWN_PERMISSIONS_GLOBAL_16', 'Auto approve');
define('AM_COUNTDOWN_PERMISSIONS_APPROVE', 'Permissions to approve');
define('AM_COUNTDOWN_PERMISSIONS_APPROVE_DESC', 'Only users in the group that you select may approve this');
define('AM_COUNTDOWN_PERMISSIONS_VIEW', 'Permissions to view');
define('AM_COUNTDOWN_PERMISSIONS_VIEW_DESC', 'Only users in the group that you select may view this');
define('AM_COUNTDOWN_PERMISSIONS_SUBMIT', 'Permissions to submit');
define('AM_COUNTDOWN_PERMISSIONS_SUBMIT_DESC', 'Only users in the group that you select may submit this');
define('AM_COUNTDOWN_PERMISSIONS_GPERMUPDATED', 'Permissions have been changed successfully');
define('AM_COUNTDOWN_PERMISSIONS_NOPERMSSET', 'Permission cannot be set: No events created yet! Please create a events first.');

//Errors
define('AM_COUNTDOWN_UPGRADEFAILED0', "Update failed - couldn't rename field '%s'");
define('AM_COUNTDOWN_UPGRADEFAILED1', "Update failed - couldn't add new fields");
define('AM_COUNTDOWN_UPGRADEFAILED2', "Update failed - couldn't rename table '%s'");
define('AM_COUNTDOWN_ERROR_COLUMN', 'Could not create column in database : %s');
define('AM_COUNTDOWN_ERROR_BAD_XOOPS', 'This module requires XOOPS %s+ (%s installed)');
define('AM_COUNTDOWN_ERROR_BAD_PHP', 'This module requires PHP version %s+ (%s installed)');
define('AM_COUNTDOWN_ERROR_TAG_REMOVAL', 'Could not remove tags from Tag Module');
//directories
define('AM_COUNTDOWN_AVAILABLE', "<span style='color : green;'>Available. </span>");
define('AM_COUNTDOWN_NOTAVAILABLE', "<span style='color : red;'>is not available. </span>");
define('AM_COUNTDOWN_NOTWRITABLE', "<span style='color : red;'>" . ' should have permission ( %1$d ), but it has ( %2$d )' . '</span>');
define('AM_COUNTDOWN_CREATETHEDIR', 'Create it');
define('AM_COUNTDOWN_SETMPERM', 'Set the permission');
define('AM_COUNTDOWN_DIRCREATED', 'The directory has been created');
define('AM_COUNTDOWN_DIRNOTCREATED', 'The directory can not be created');
define('AM_COUNTDOWN_PERMSET', 'The permission has been set');
define('AM_COUNTDOWN_PERMNOTSET', 'The permission can not be set');
define('AM_COUNTDOWN_VIDEO_EXPIREWARNING', 'The publishing date is after expiration date!!!');
//Sample Data
define('AM_COUNTDOWN_ADD_SAMPLEDATA', 'Add Sample Data (will delete ALL current data)');
define('AM_COUNTDOWN_SAMPLEDATA_SUCCESS', 'Sample Date uploaded successfully');

//Error NoFrameworks
define('_AM_ERROR_NOFRAMEWORKS', 'Error: You don&#39;t use the Frameworks \'admin module\'. Please install this Frameworks');
define('AM_COUNTDOWN_MAINTAINEDBY', 'is maintained by the');
