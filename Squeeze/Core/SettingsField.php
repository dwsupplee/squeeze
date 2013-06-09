<?php

namespace Squeeze\Core;

class SettingsField
{
  private $field_key;
  private $field_title;
  private $field_type;
  private $field_instructions;
  private $field_pre_parse;
  private $field_post_parse;
  private $value;

  const FIELD_TEXTAREA = 'settings/textarea';
  const FIELD_TEXT = 'settings/text';
  const FIELD_CHECKBOX = 'settings/checkbox';
  const FIELD_RADIO = 'settings/radio';

  private $view;

  public function __construct()
  {
    $this->view = new View;
  }

  public function setFieldKey($fieldKey)
  {
    $this->field_key = $fieldKey;
    $this->value = get_option($this->field_key);
    return $this;
  }

  public function getFieldKey()
  { return $this->field_key; }

  public function setFieldTitle($fieldTitle)
  {
    $this->field_title = $fieldTitle;
    return $this;
  }

  public function getFieldTitle()
  { return $this->field_title; }

  public function setFieldType($fieldType)
  {
    $this->field_type = $fieldType;
    return $this;
  }

  public function getFieldType()
  { return $this->field_type; }

  public function setFieldInstructions($fieldInstructions)
  {
    $this->field_instructions = $fieldInstructions;
    return $this;
  }

  public function getFieldInstructions()
  { return $this->field_instructions; }

  public function setFieldPreParse($fieldPreParse)
  {
    $this->field_pre_parse = $fieldPreParse;
    return $this;
  }

  public function getFieldPreParse()
  {
    $args = func_get_args();

    if(!$this->field_pre_parse)
      return $args[0];

    return call_user_func_array($this->field_pre_parse, $args);
  }

  public function setFieldPostParse($fieldPostParse)
  {
    $this->field_post_parse = $fieldPostParse;
    return $this;
  }

  public function getFieldPostParse()
  {
    $args = func_get_args();

    if(!$this->field_post_parse)
      return $args[0];

    return call_user_func_array($this->field_post_parse, $args);
  }

  public function getFieldHtml()
  {
    $field = $this->view->load($this->field_type, array(
      'field_key' => $this->field_key,
      'field_value' => $this->getFieldPreParse($this->value)
    ));

    return $this->view->load('settings/wrapper', array(
      'field_key' => $this->field_key,
      'field_title' => $this->field_title,
      'field_type' => $this->field_type,
      'field_instructions' => $this->field_instructions,
      'field' => $field
    ));
  }

  public function updateFieldValue($haystack)
  {
    $value = (isset($haystack[$this->field_key])) ? $haystack[$this->field_key] : null;

    if(is_null($value))
      return false;

    if($this->getFieldPreParse($this->value) == $value)
      return false;

    $this->value = $this->getFieldPostParse($value);
    update_option($this->field_key, $this->value);

    return true;
  }
}