<?php

// Our plugin's path.
define('SQ_PLUGIN_PATH', dirname(dirname(dirname(__FILE__))));

add_action('init', function() {
  spl_autoload_register(function($className) {
    if(strpos($className, 'SQ_') === 0) {
      $unPrefixedClassName = str_replace('SQ_', '', $className);
      $unPrefixedClassName = str_replace('_', '', $unPrefixedClassName);
      require_once(SQ_PLUGIN_PATH .'/lib/core/'. $unPrefixedClassName .'.php');
    }

    if(strpos($className, 'SQAPP_') === 0) {
      $unPrefixedClassName = str_replace('SQAPP_', '', $className);
      $unPrefixedClassName = str_replace('_', '', $unPrefixedClassName);
      require_once(SQ_PLUGIN_PATH .'/lib/app/'. $unPrefixedClassName .'.php');
    }
  });
});