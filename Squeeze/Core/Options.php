<?php

namespace Squeeze\Core;

/**
 * Options
 * A class to get, set and manage settings stored in the WordPress database.
 */
class Options
{

  /**
   * @var string
   * @access private
   */
  private $key;

  /**
   * @var mixed
   * @access private
   */
  private $value;

  /**
   * @var string
   * @access private
   */
  private $encoding_type;

  /**
   * __construct
   * Take a given key, fetch the value from the database and attempt to determine encoding type.
   * @param string $key
   * @return null
   * @access public
   */
  public function __construct($key)
  {
    $this->key = $key;
    $this->value = get_option($key);

    if(!$this->value)
    {
      $this->encoding_type = 'json';
    }
    else
    {
      if($this->isJson($this->value))
      {
        $this->value = json_decode($this->value);
        $this->encoding_type = 'json';
      }
    }
  }

  /**
   * get
   * Return the stored value.
   * @return mixed
   * @access public
   */
  public function get() {
    return $this->value;
  }

  /**
   * set
   * Update the value
   * @param mixed $value
   * @return Options $this
   * @access public
   */
  public function set($value) {
    $this->value = $value;
    return $this;
  }

  /**
   * push
   * If the stored value is an array, add a value to the end.
   * @param string $value
   * @return Options $this
   * @access public
   */
  public function push($value) {
    if(!is_array($this->value)) return false;

    if(!is_array($value))
    {
      $value = array($value);
    }

    $this->value = array_merge($this->value, $value);

    return $this;
  }

  /**
   * save
   * Save the value to the database.
   * If the value was previously stored as json, it'll be re-encoded as json.
   * Any other types will be left to WordPress to determine.
   * @access public
   * @return bool
   */
  public function save()
  {
    $value = $this->value;
    if($this->encoding_type == 'json' && (is_object($this->value) || is_array($this->value)) )
    {
      $value = json_encode($value);
    }

    update_option($this->key, $value);
    return true;
  }

  /**
   * isJson
   * Determine if a string is json-encoded
   * @access private
   * @param string $string
   * @return bool
   */
  private function isJson($string)
  {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
  }
}