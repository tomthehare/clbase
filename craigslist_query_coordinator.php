<?php

/**
 * Craigslist query coodinator
 *
 * sample:
 * http://boston.craigslist.org/search/aap?is_paid=all&search_distance_type=mi&min_price=1000&max_price=2200&bedrooms=1&pets_cat=1&query=brookline
 */

class CraigslistQueryCoordinator {

  private $base_url;

  private $is_paid;

  private $search_distance_type;

  private $min_price;

  private $max_price;

  private $bedrooms;

  private $pets_cat;

  private $neighborhood;

  /**
   * Sets the things that should never really change.
   */ 
  public function __construct() {
    $this->is_paid = 'all';
    $this->search_distance_type = 'mi';
    $this->min_price = 1000;
    $this->max_price = 2200;
    $this->bedrooms = 1;
    $this->pets_cat = 1;

    $this->base_url = 'http://boston.craigslist.org/search/aap';
  }

  public function set_neighborhood($neighborhood) {
    $this->neighborhood = trim(strtolower($neighborhood));
  }

  public function render_url() {
    return $this->base_url . '?' . http_build_query(
      ['is_paid' => $this->is_paid,
        'search_distance_type' => $this->search_distance_type,
        'min_price' => $this->min_price,
        'max_price' => $this->max_price,
        'bedrooms' => $this->bedrooms,
        'pets_cat' => $this->pets_cat,
        'query' => $this->neighborhood
      ]);
  }
}