<?php

namespace Squeeze\App;

/**
 * These functions are given as callbacks in the SQ_example.php file.
 * They're passed into the setFunction() method of the SettingsMenu class.
 */
class AdminOptions
{

  public function options_page()
  {
    $date = new \Squeeze\Core\Date();
    print_r($date->getWeekDateRange());exit;
  }

  public function settings_page()
  {
    echo settings_fields('SQ_Group');
  }
}