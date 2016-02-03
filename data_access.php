<?php
/**
 * Keeping it simple.  Let's start with a simple data access class to see if we can talk to MySQL.
 */

// namespace clbase;

class DataAccess {

  private $_server_name = '127.0.0.1';
  private $_user_name = 'root';
  private $_password = 'braindrain';
  private $_db_name = 'clbase_development';

  public function get_connection() {
    $conn = new mysqli($this->_server_name, $this->_user_name, $this->_password);

    // Check connection
    if ($conn->connect_error) {
      die("DB connection failed: " . $conn->connect_error);
    } 

    return $conn;
  }

  /**
   * Test function to get things going.
   */
  public function test() {
    $sql = 'SELECT * FROM clbase_development.listings WHERE `id` = 1603 LIMIT 1;';

    $conn = $this->get_connection();

    $results = $conn->query($sql);

    if (!empty($results)) {
      return $this->convert_to_array($results);
    }

    return null;
  }

  /**
   * No one likes result sets.
   */
  public function convert_to_array($results) {
    if (empty($results)) {
      return [];
    }

    $arr = [];

    foreach ($results as $result) {
      $current = [];

      foreach ($result as $key => $value) {
        $current[$key] = $value;
      }

      $arr[] = $current;
    }

    return $arr;
  }
}