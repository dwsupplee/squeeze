<?php

namespace Squeeze;

// Our plugin's path.
define('SQ_PLUGIN_PATH', dirname(dirname(dirname(__FILE__))));

include "SplClassLoader.php";
$classLoader = new SplClassLoader('Squeeze', SQ_PLUGIN_PATH);
$classLoader->register();

if(function_exists('squeeze_init'))
{
  add_action('init', 'squeeze_init');
}

if(function_exists('squeeze_admin_init'))
{
  add_action('admin_init', 'squeeze_admin_init');
}