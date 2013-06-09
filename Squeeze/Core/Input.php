<?php

namespace Squeeze\Core;

/**
 * Input helper functions
 */
class Input
{

  /**
   * sanitize
   * Cleans the input for DB insertion
   * @param string $string
   * @return string
   * @access public
   * @static
   */
  public static function sanitize($string)
  {
    return mysql_real_escape_string($string);
  }

  /**
   * post
   * Attempts to fetch a given key from the _POST superglobal.
   * If no key is given, return entire array.
   * If key doesn't exist, return null
   * @param mixed $var
   * @return string|array|null
   * @access public
   * @static
   */
  public static function post($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_POST)) ? $_POST : null;
    }

    return (isset($_POST[$var])) ? $_POST[$var] : null;
  }

  /**
   * cookie
   * Attempts to fetch a given key from the _COOKIE superglobal.
   * If no key is given, return entire array.
   * If key doesn't exist, return null
   * @param mixed $var
   * @return string|array|null
   * @access public
   * @static
   */
  public static function cookie($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_COOKIE)) ? $_COOKIE : null;
    }

    return (isset($_COOKIE[$var])) ? $_COOKIE[$var] : null;
  }

  /**
   * get
   * Attempts to fetch a given key from the _GET superglobal.
   * If no key is given, return entire array.
   * If key doesn't exist, return null
   * @param mixed $var
   * @return string|array|null
   * @access public
   * @static
   */
  public static function get($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_GET)) ? $_GET : null;
    }

    return (isset($_GET[$var])) ? $_GET[$var] : null;
  }

  /**
   * server
   * Attempts to fetch a given key from the _SERVER superglobal.
   * If no key is given, return entire array.
   * If key doesn't exist, return null
   * @param mixed $var
   * @return string|array|null
   * @access public
   * @static
   */
  public static function server($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_SERVER)) ? $_SERVER : null;
    }

    return (isset($_SERVER[$var])) ? $_SERVER[$var] : null;
  }
}