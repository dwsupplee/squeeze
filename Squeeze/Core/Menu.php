<?php

namespace Squeeze\Core;

/**
 * Menu class
 * Create WordPress navigation menus
 */
class Menu
{

  /**
   * @var string
   * @access private
   */
  private $menu_parent;

  /**
   * @var string
   * @access private
   */
  private $page_title;

  /**
   * @var string
   * @access private
   */
  private $menu_title;

  /**
   * @var string
   * @access private
   */
  private $menu_capability;

  /**
   * @var string
   * @access private
   */
  private $slug;

  /**
   * @var callback
   * @access private
   */
  private $function;

  /**
   * @var string
   * @access private
   */
  private $menu_icon;

  /**
   * @var int
   * @access private
   */
  private $menu_priority = 99;

  /**
   * setMenuParent
   * @access public
   * @param string $menuParent
   * @return Menu $this
   */
  public function setMenuParent($menuParent)
  {
    $this->menu_parent = $menuParent;
    return $this;
  }

  /**
   * setPageTitle
   * @access public
   * @param string $pageTitle
   * @return Menu $this
   */
  public function setPageTitle($pageTitle)
  {
    $this->page_title = $pageTitle;
    return $this;
  }

  /**
   * setMenuTitle
   * @access public
   * @param string $menuTitle
   * @return Menu $this
   */
  public function setMenuTitle($menuTitle)
  {
    $this->menu_title = $menuTitle;
    return $this;
  }

  /**
   * setMenuCapability
   * @access public
   * @param string $menuCapability
   * @return Menu $this
   */
  public function setMenuCapability($menuCapability)
  {
    $this->menu_capability = $menuCapability;
    return $this;
  }

  /**
   * setSlug
   * @access public
   * @param string $slug
   * @return Menu $this
   */
  public function setSlug($slug)
  {
    $this->slug = $slug;
    return $this;
  }

  /**
   * setFunction
   * @access public
   * @param callback $function
   * @return Menu $this
   */
  public function setFunction($function)
  {
    $this->function = $function;
    return $this;
  }

  /**
   * execute
   * Once we've set all the required menu parameters, register the menu page.
   * @access public
   * @return null
   */
  public function execute()
  {
    add_action( 'admin_menu', array($this, 'register_menu_page') );
  }

  /**
   * register_menu_page
   * This is public to allow WordPress to access it. Don't call this directly.
   * @access public
   * @return null
   */
  public function register_menu_page()
  {
    if(!$this->menu_icon)
    {
      $this->menu_icon = plugins_url( 'myplugin/images/icon.png' );
    }

    if($this->menu_parent)
    {
      add_submenu_page( $this->menu_parent, $this->page_title, $this->menu_title, $this->menu_capability, $this->slug, $this->function );
    }
    else {
      add_menu_page( $this->page_title, $this->menu_title, $this->menu_capability, $this->slug, $this->function, $this->menu_icon, $this->menu_priority );
    }
  }
}