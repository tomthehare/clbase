<?php

/**
 * Represents a list on craigslist!
 */

class Listing {

  public $id;
  public $title;
  public $listing_date;
  public $price;
  public $bedroom_count;
  public $location;
  public $image;
  public $created_at;
  public $updated_at;
  public $url;
  public $viewed;
  public $favorite;
  public $deleted;
  public $shared;
  public $query_location;

  public function populate($map) {
    if (empty($map)) {
      return;
    }

    $properties = $this->self_get_properties_array();

    $reflectionClass = new ReflectionClass('Listing');

    foreach ($map as $row) {
      foreach ($row as $prop_name => $value) {

        if (array_key_exists($prop_name, $properties)) {
          $reflectionClass->getProperty($prop_name)->setValue($this, $value);
        }
      }
    }
  }

  private function self_get_properties_array() {
    $reflectionClass = new ReflectionClass('Listing');

    $properties = $reflectionClass->getProperties();

    if (empty($properties)) {
      die('Error getting properties of Listing.');
    }

    $return_array = [];

    foreach ($properties as $property) {
      $return_array[$property->name] = $property->name;
    }

    return $return_array;
  }

}