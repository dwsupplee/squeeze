<?php

namespace Squeeze\Core;

class SettingsSection
{
  private $group_key;
  private $group_page;
  private $group_title;
  private $fields = array();

  private $view;

  public function __construct()
  {
    $this->view = new View;
  }

  /**
   * setGroupKey
   * @param string $groupKey
   * @return SettingsSection $this
   * @access public
   */
  public function setGroupKey($groupKey)
  {
    $this->group_key = $groupKey;
    return $this;
  }

  /**
   * setGroupPage
   * @param string $groupPage
   * @return SettingsSection $this
   * @access public
   */
  public function setGroupPage($groupPage)
  {
    $this->group_page = $groupPage;
    return $this;
  }

  /**
   * setGroupTitle
   * @param string $groupTitle
   * @return Settings_Section $this
   * @access public
   */
  public function setGroupTitle($groupTitle)
  {
    $this->group_title = $groupTitle;
    return $this;
  }

  /**
   * setFields
   * @param SettingsField|array $fields
   * @return SettingsSection $this
   * @access public
   */
  public function setFields($fields)
  {
    if(!is_array($fields))
    {
      $fields = array($fields);
    };

    foreach($fields as $field)
    {
      if(!($field instanceof SettingsField))
      {
        throw new Exception('$field must be an instance of SettingsField');
      }
    }

    $this->fields = array_merge($this->fields, $fields);
  }

  public function showGroup()
  {
    $this->updateListener();

    $fields = $this->showFields();

    return $this->view->load('settings/section', array(
      'fields' => $fields,
      'group_title' => $this->group_title,
      'group_key' => $this->group_key,
      'group_page' => $this->group_page
    ));
  }

  public function execute()
  {
    add_settings_section( $this->group_key, $this->group_title, function()
      {echo 'test';}, $this->group_page );

    foreach($this->fields as $field)
    {
      add_settings_field( $field->getFieldKey(), $field->getFieldTitle(), function()
        {echo 'test';}, $this->group_page, $this->group_key);
      register_setting( $this->group_key, $field->getFieldKey(), array($field, 'getFieldPostParse') );
    }
  }

  public function displaySettingsSection()
  {
    settings_fields($this->group_key);
  }

  public function updateListener()
  {
    if(is_null(Input::post()))
      return;

    if(!wp_verify_nonce(Input::post('_wpnonce'), $this->group_key))
      die('Could not verify nonce');

    foreach($this->fields as $field)
    {
      $field->updateFieldValue(Input::post());
    }
  }
}