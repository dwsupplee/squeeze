<?php

class SQUEEZE_User {
  
  /**
   * @param $user_ID int
   * @return object
   * @is_chainable true
   */
  public function __construct($user_ID) {
    $this->user_id = $user_ID;

    return $this;
  }

  /**
   * @param $key string
   * @return string
   * @is_chainable false
   */
  public function get_meta($key) {
    return get_user_meta($this->user_id, $key, true);
  }

  /**
   * @param $key string
   * @param $value string
   * @return object
   * @is_chainable true
   */
  public function update_meta($key, $value) {
    $value = SQUEEZE_Input::sanitize($value);

    update_user_meta($this->user_id, $key, $value);

    return $this;
  }
 
}