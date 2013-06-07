<?php

class SQUEEZE_Menu {
  private $menu_parent;
  private $page_title;
  private $menu_title;
  private $menu_capability;
  private $slug;
  private $function;
  private $menu_icon;
  private $menu_priority = 99;

  public function setMenuParent($menuParent) {
    $this->menu_parent = $menuParent;
  }

  public function setPageTitle($pageTitle) {
    $this->page_title = $pageTitle;
    return $this;
  }

  public function setMenuTitle($menuTitle) {
    $this->menu_title = $menuTitle;
    return $this;
  }

  public function setMenuCapability($menuCapability) {
    $this->menu_capability = $menuCapability;
  }

  public function setSlug($slug) {
    $this->slug = $slug;
  }

  public function setFunction($function) {
    $this->function = $function;
  }

  public function execute() {
    add_action( 'admin_menu', array($this, 'register_menu_page') );
  }

  public function register_menu_page() {
    if(!$this->menu_icon) {
      $this->menu_icon = plugins_url( 'myplugin/images/icon.png' );
    }

    if($this->menu_parent) {
      add_submenu_page( $this->menu_parent, $this->page_title, $this->menu_title, $this->menu_capability, $this->slug, $this->function );
    }
    else {
      add_menu_page( $this->page_title, $this->menu_title, $this->menu_capability, $this->slug, $this->function, $this->menu_icon, $this->menu_priority );
    }
  }
}