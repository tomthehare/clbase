<?php

include_once 'utility_functions.php';
include_once 'listing.php';
include_once 'data_access.php';
include_once 'craigslist_query_coordinator.php';

/**
 *
 * $dao = new DataAccess();
 * $results = $dao->test();
 * 
 * $listing = new Listing();
 * $listing->populate($results);
 */

// Let's shift gears and start on the actual querying of craigslist...
$clqc = new CraigslistQueryCoordinator();
$clqc->set_neighborhood('brookline');
$clqc->search_listings();




