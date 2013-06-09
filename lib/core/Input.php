<?php

namespace Squeeze\Core;

class Input
{
  public static function sanitize($string)
  {
    return mysql_real_escape_string($string);
  }

  public static function post($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_POST)) ? $_POST : null;
    }

    return (isset($_POST[$var])) ? $_POST[$var] : null;
  }

  public static function cookie($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_COOKIE)) ? $_COOKIE : null;
    }

    return (isset($_COOKIE[$var])) ? $_COOKIE[$var] : null;
  }

  public static function get($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_GET)) ? $_GET : null;
    }

    return (isset($_GET[$var])) ? $_GET[$var] : null;
  }

  public static function server($var = null)
  {
    if(is_null($var))
    {
      return (!empty($_SERVER)) ? $_SERVER : null;
    }

    return (isset($_SERVER[$var])) ? $_SERVER[$var] : null;
  }
}