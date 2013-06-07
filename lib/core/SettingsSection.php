<?php

class SQUEEZE_Settings_Section {
  private $group_key;
  private $group_page;
  private $group_title;
  private $fields = array();

  private $view;

  public function __construct() {
    $this->view = new SQUEEZE_View;
  }

  public function setGroupKey($groupKey) {
    $this->group_key = $groupKey;
    return $this;
  }

  public function setGroupPage($groupPage) {
    $this->group_page = $groupPage;
    return $this;
  }

  public function setGroupTitle($groupTitle) {
    $this->group_title = $groupTitle;
    return $this;
  }

  public function setFields($fields) {
    if(!is_array($fields)) {
      $fields = array($fields);
    };

    foreach($fields as $field) {
      if(!($field instanceof SQUEEZE_Settings_Field)) {
        throw new Exception('$field must be an instance of SQUEEZE_Settings_Field');
      }
    }

    $this->fields = array_merge($this->fields, $fields);
  }

  public function showGroup() {
    $this->updateListener();

    $fields = $this->showFields();

    return $this->view->load('settings/section', array(
      'fields' => $fields,
      'group_title' => $this->group_title,
      'group_key' => $this->group_key,
      'group_page' => $this->group_page
    ));
  }

  private function showFields() {
    $fields = $this->fields;

    $parsed = array();
    foreach($fields as $field) {
      $parsed[] = $field->getFieldHtml();
    }

    return implode("\n", $parsed);
  }

  public function updateListener() {
    if(is_null(SQUEEZE_Input::post()))
      return;

    if(!wp_verify_nonce(SQUEEZE_Input::post('_wpnonce'), $this->group_key))
      die('Could not verify nonce');

    foreach($this->fields as $field) {
      $field->updateFieldValue(SQUEEZE_Input::post());
    }
  }
}