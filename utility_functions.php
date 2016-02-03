<?php

function debug_print($thing) {

  if (is_string($thing)) {
    echo $thing;
  } else if (is_array($thing)) {
    echo print_r($thing, true);
  } else {
    var_dump($thing);
  }

  echo '<br /><br />';

}