<?php

namespace Squeeze;

// Our plugin's path.
define('SQ_PLUGIN_PATH', dirname(dirname(dirname(__FILE__))));

include "SplClassLoader.php";
$classLoader = new SplClassLoader('Squeeze', SQ_PLUGIN_PATH);
$classLoader->register();

if(function_exists('\Squeeze\squeeze_init'))
{
  add_action('init', '\Squeeze\squeeze_init');
}

if(function_exists('\Squeeze\squeeze_admin_init'))
{
  add_action('admin_init', '\Squeeze\squeeze_admin_init');
}