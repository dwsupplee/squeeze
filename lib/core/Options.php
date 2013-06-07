<?php

class SQUEEZE_Options {
  public static function get($key) {
    $value = get_option($key);

    if(is_serialized($value)) {
      return unserialize($value);
    }

    if(self::isJson($value)) {
      return json_decode($value);
    }

    return $value;
  }

  public static function save($key, $value, $format = 'json') {
    if(is_array($value) || is_object($value)) {
      if($format == 'json') {
        $value = json_encode($value);
      }
      else {
        $value = serialize($value);
      }
    }

    update_option($key, $value);

    return true;
  }

  private function isJson($string) {
   json_decode($string);
   return (json_last_error() == JSON_ERROR_NONE);
  }
}