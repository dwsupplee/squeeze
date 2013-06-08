<?php

class SQAPP_Admin_Users {

  /**
   * @access private
   * @var object
   */
  private $view;

  /**
   * Class Constructor.
   * Instantiate our view object and save for later
   * @return null
   */
  public function __construct() {
    $this->view = new SQ_View;
  }

  /**
   * addUserFields
   * We're getting the custom field values and displaying the on the Edit User page.
   * Echoing from a function is generally bad news bears, but we're hooking into these so echoing is the way to go.
   * @param $user object
   * @return null
   */
  public function addUserFields( $user ) { 
    $user = new SQ_User($user->data->ID);

    $fieldName = $user->get_meta('fieldName');

    echo $this->view->load('AdminUserFields', array(
      'fieldName' => $fieldName,
    ));
  }

  /**
   * saveUserFields
   * Perform the update operation.
   * WordPress supplies different values to different callbacks. That's why the addUserFields function above
   * gets an object and this one gets in integer.
   * @param int $user_ID
   * @return bool|null
   */
  public function saveUserFields( $user_ID ) {
    $user = new SQ_User($user_ID);

    if ( !current_user_can( 'edit_user', $user_id ) )
      return false;

    $user->update_meta('fieldName', SQ_Input::post('fieldName'));
  }

  /**
   * showUserFieldsColumnNames
   * Add a column to the User list table.
   * @param array $columns
   * @return array
   */
  public function showUserFieldsColumnNames($columns) {
    $columns['SQ_fieldName'] = 'Field Name';

    return $columns;
  }

  /**
   * showUserFieldsColumnValues
   * Add values to the columns we defined above.
   * @param string $val
   * @param string $column_name
   * @param int $user_ID
   */
  public function showUserFieldsColumnValues( $val, $column_name, $user_ID ) {
    $user = new SQ_User($user_ID);

    $fieldName = $user->get_meta('fieldName');

    $template = $this->view->load('AdminUserColumns', array(
      'fieldName' => $fieldName,
    ));

    switch ($column_name) {
        case 'SQ_fieldName' :
            return $template;
            break;
        default:
    }
    return $return;
  }
}