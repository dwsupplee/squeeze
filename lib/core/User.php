<?php

class SQ_User extends WP_User {

  /**
   * @param $key string
   * @return string
   * @is_chainable false
   */
  public function get($key) {
    return $this->__get($key);
  }

  /**
   * @param $key string
   * @param $value string
   * @return object
   * @is_chainable true
   */
  public function set($key, $value) {
    $value = SQ_Input::sanitize($value);

    // meh. I'll go ahead and fix a wordpress error. -_-
    if(!is_object($this->data)) {
      $this->data = new stdClass();
    }

    $this->__set($key, $value);
    update_user_meta($this->user_id, $key, $value);

    return $this;
  }

  /**
   * insert
   * Creates a new user.
   * Usage:
   * $user = new SQ_User;
   * $user->set('name', 'username');
   * ......
   * $user->insert();
   * @return object SQ_User
   */
  public function insert() {
    if($this->ID === 0) {
      $id = wp_insert_user($this);
      return new self($id);
    }
  }
}