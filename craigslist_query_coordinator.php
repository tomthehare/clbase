<?php

/**
 * Craigslist query coodinator
 *
 * sample:
 * http://boston.craigslist.org/search/aap?is_paid=all&search_distance_type=mi&min_price=1000&max_price=2200&bedrooms=1&pets_cat=1&query=brookline
 */

include_once 'lib/simple_html_dom.php';

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
   * List of Listing objects containing all the posts in that query.
   */
  public $list_of_listings;

  /**
   * Simple HTML DOM Object
   */
  private $html_dom;

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

  /**
   * Function to read all the page data from the URL.  Reads into property.
   */
  public function read_url_data_into_dom() {
    // $this->html_raw = file_get_contents($clqc->render_url());
    $this->html_dom = file_get_html($this->render_url());

    if (!empty($this->html_dom)) {
      return true;
    }

    return false;
  }

  /**
   * Should eventually end up with a list of listings.
   */
  public function unpack_html_into_listings() {
    if (empty($this->html_dom)) {
      return false;
    }

    // debug_print($this->html_dom);
  }

  /**
   *  Jumping off point.
   */
  public function search_listings() {
    if ($this->read_url_data_into_dom()) {
      $this->unpack_html_into_listings();

      // $rows = $this->html_dom->find("span[class=rows]"); 
      $content = $this->html_dom->getElementById("pagecontainer");

      $rows = $content->childNodes(2)->find('span[class=rows]');

      if (!empty($rows)) {

        $children = $rows[0]->children;

        foreach ($children as $listing_node) {
          // var_dump($listing_node);

          $pl = $listing_node->find('span[class=pl]');

          if (!empty($pl)) {
            $link = $pl[0]->find('a[href]');

            $link->dump();
            die();
          }

        }

      } else {
        debug_print('EMPTY');
      }

    }
  }
}