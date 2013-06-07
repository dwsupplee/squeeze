<?php

/**
 * These functions are given as callbacks in the SQUEEZE_example.php file.
 * They're passed into the setFunction() method of the SettingsMenu class.
 */
class SQUEEZE_Admin_Options {

  public function options_page() {
    $date = new SQUEEZE_Date();
    print_r($date->getWeekDateRange());exit;
  }

  public function settings_page() {
    // Create a field
    $textarea = new SQUEEZE_Settings_Field;
    $textarea->setFieldKey('SQUEEZE_textarea');
    $textarea->setFieldTitle('Sections List');
    $textarea->setFieldType(SQUEEZE_Settings_Field::FIELD_TEXTAREA);
    $textarea->setFieldInstructions('Enter One Value Per Line');

    // The stored value can be parsed prior to display.
    $textarea->setFieldPreParse(function($value) {
      $sections = json_decode($value);
      return implode("\n", $sections);
    });

    // We can also define a function to parse the value before saving.
    $textarea->setFieldPostParse(function($value) {
      $sections = explode("\n", $value);
      foreach($sections as $key=>$val) {
        $sections[$key] = trim($val);
      }
      return json_encode($sections);
    });

    // Create a settings section.
    $section = new SQUEEZE_Settings_Section;
    $section->setGroupTitle('Custom Field Group');
    $section->setGroupKey('squeeze_group');
    $section->setGroupPage('SQUEEZE_sub_menu');
    $section->setFields(array(
      $textarea
    ));
    echo $section->showGroup();
  }
}