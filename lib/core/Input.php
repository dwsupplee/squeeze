<?php

class SQUEEZE_Input {
  public static function sanitize($string) {
    return mysql_real_escape_string($string);
  }

  public static function post($key = null) {
    if(is_null($key)) {
      return (!empty($_POST)) ? $_POST : null;
    }

    return (isset($_POST[$key])) ? $_POST[$key] : null;
  }
}