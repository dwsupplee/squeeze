<?php

/*
Plugin Name: Squeezed Framework
Plugin URI: http://github.com/jdpedrie/squeezed
Description: A collection of libraries and a hopefully decent development framework to make the a hard job (writing decent code for WordPress) a little less painful.
Version: 1.0
Author: John Dennis Pedrie
Author URI: http://johnpedrie.com
License: TBD
*/

/********************************************************
 * So, let's walk through this stuff.
 * The main plugin file will be our launcher.
 * We'll include our different classes and be move on.
 * I'd like to autoload these later, but right now they're
 * called manually.
 */

// Our plugin's path.
define('SQUEEZE_PLUGIN_PATH', dirname(__FILE__));

// Include our core libraries / helpers.
include "lib/core/Date.php";
include "lib/core/Input.php";
include "lib/core/Menu.php";
include "lib/core/Options.php";
include "lib/core/SettingsField.php";
include "lib/core/SettingsSection.php";
include "lib/core/User.php";
include "lib/core/View.php";

// Our actual application logic.
include "lib/AdminUsers.php";
include "lib/AdminOptions.php";

$adminUsers = new SQUEEZE_Admin_Users();
$adminOptions = new SQUEEZE_Admin_Options();

// Create Menu
$commitmentMenu = new SQUEEZE_Menu();
$commitmentMenu->setPageTitle('Test Menu');
$commitmentMenu->setMenuTitle('Test Menu');
$commitmentMenu->setMenuCapability('manage_options');
$commitmentMenu->setSlug('SQUEEZE_menu');
$commitmentMenu->setFunction(array($adminOptions, 'options_page')); // Assign a callback that's set in our application
$commitmentMenu->execute();

// A sub-menu
$commitmentSettingsMenu = new SQUEEZE_Menu();
$commitmentSettingsMenu->setMenuParent('SQUEEZE_menu');
$commitmentSettingsMenu->setPageTitle('Sub Menu');
$commitmentSettingsMenu->setMenuTitle('Sub Menu');
$commitmentSettingsMenu->setMenuCapability('manage_options');
$commitmentSettingsMenu->setSlug('SQUEEZE_sub_menu');
$commitmentSettingsMenu->setFunction(array($adminOptions, 'settings_page')); // Again, assign a callback from the application file.
$commitmentSettingsMenu->execute();

// Display Custom Profile Fields
add_action( 'show_user_profile', array($adminUsers, 'addUserFields') );
add_action( 'edit_user_profile', array($adminUsers, 'addUserFields') );

// Save Custom Profile Fields
add_action( 'personal_options_update', array($adminUsers, 'saveUserFields') );
add_action( 'edit_user_profile_update', array($adminUsers, 'saveUserFields') );

// Add Columns to Users Table
add_filter( 'manage_users_columns', array($adminUsers, 'showUserFieldsColumnNames') );
add_filter( 'manage_users_custom_column', array($adminUsers, 'showUserFieldsColumnValues'), 10, 3 );