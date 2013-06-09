<?php

namespace Squeeze\Core;

/**
 * Post
 * WordPress has a class called WP_Post
 * Sort of like WP_User whoo!
 * Oh wait, it's declared as final so I can't extend it
 * Thanks a lot guys.
 */
class Post
{
  const TYPE_POST = 'post';
  const TYPE_PAGE = 'page';
  const TYPE_ATTACHMENT = 'attachment';
  const TYPE_LINK = 'link';
  const TYPE_NAV_MENU_ITEM = 'nav_menu_item';
  const TYPE_CUSTOM = 'custom';

  const STATUS_DRAFT = 'draft';
  const STATUS_PUBLISH = 'publish';
  const STATUS_PENDING = 'pending';
  const STATUS_FUTURE = 'future';
  const STATUS_PRIVATE = 'private';
  const STATUS_CUSTOM = 'custom';

  private $meta;

  private $ID;
  private $menu_order;
  private $comment_status;
  private $ping_status;
  private $pinged;
  private $post_author;
  private $post_category;
  private $post_content;
  private $post_date;
  private $post_date_gmt;
  private $post_excerpt;
  private $post_name;
  private $post_parent;
  private $post_password;
  private $post_status;
  private $post_title;
  private $post_type;
  private $tags_input;
  private $to_ping;
  private $tax_input;
  private $post_modified;
  private $post_modified_gmt;
  private $post_content_filtered;
  private $guid;
  private $post_mime_type;
  private $comment_count;
  private $filter;

  /**
   * __construct
   * If an ID is supplied, this class will try and fetch the post then hydrate the new instance with the details.
   * @param null|int $ID
   * @uses WP_Post
   * @access public
   */
  public function __construct($ID = null)
  {
    if(!is_null($ID))
    {
      $post = WP_Post::get_instance($ID);
      if($post)
      {
        $this->hydrate($post);
      }
    }
  }

  /**
   * hydrate
   * This function will populate the current instance with the post data passed to it by the constructor.
   * @param WP_Post $post
   * @return null
   * @access private
   */
  private function hydrate(WP_Post $post)
  {
    $default_vars = get_class_vars(get_class($this));
    unset($default_vars['meta']);

    $this->meta = array();
    foreach($post as $key=>$val)
    {
      if(array_key_exists($key, $default_vars))
      {
        $this->$key = $val;
      }
      else {
        $this->meta[$key] = $val;
      }
    }

    return null;
  }

  /**
   * set
   * Set the value of a key. If the key does not exist, add the value to the meta array
   * @param string $key
   * @param string $val
   * @return Post $this
   * @access public
   */
  public function set($key, $val)
  {
    if(property_exists($this, $key))
    {
      $this->$key = $val;
    }
    else $this->meta[$key] = $val;

    return $this;
  }

  /**
   * get
   * Return the value of the given key. If the key does not exist, try and get the value from the meta array.
   * If that doesn't exist, return null.
   * @param string $key
   * @return mixed
   * @access public
   */
  public function get($key = null)
  {
    if(is_null($key))
    {
      return get_object_vars($this);
    }

    if(property_exists($this, $key))
    {
      return $this->$key;
    }

    return (isset($this->meta[$key])) ? $this->meta[$key] : null;
  }

  /**
   * save
   * Save the given post to the database.
   * If no ID is set on the current instance, will attempt to create a post.
   * Otherwise, it will update.
   * @return Post $this
   * @access public
   */
  public function save()
  {
    if($this->ID)
    {
      return $this->update();
    }

    // Insert post here.
    $this->ID = wp_insert_post($this->get());
    $this->save_meta();

    return $this;
  }

  /**
   * delete
   * Delete a given post
   * @return bool
   */
  public function delete()
  {
    if($this->ID)
    {
      wp_delete_post($this->ID, true);
      return true;
    }

    return false;
  }

  /**
   * trash
   * Trash a given post
   * @return bool
   */
  public function trash()
  {
    if($this->ID)
    {
      wp_delete_post($this->ID, false);
      return true;
    }

    return false;
  }

  /**
   * update
   * Update an existing post.
   * Should only be called from the save() function.
   * @access private
   * @return Post $this
   */
  private function update()
  {
    $this->ID = wp_update_post($this->get());
    $this->save_meta();
    return $this;
  }

  /**
   * save_meta
   * Helper function to update all the meta fields on the post
   * @access private
   * @return bool
   */
  private function save_meta()
  {
    if(is_array($this->meta))
    {
      foreach($this->meta as $key=>$val)
      {
        update_post_meta($this->ID, $key, $val);
      }
    }

    return true;
  }
}