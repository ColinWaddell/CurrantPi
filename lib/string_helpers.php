<?php
  function seconds_to_time($seconds) {
      $dtF = new DateTime("@0");
      $dtT = new DateTime("@$seconds");
      return $dtF->diff($dtT)->format('%ad %hh %im');
  }

  function pretty_baud($baud) {
    $baud = intval($baud);
    $ret = "unknown";

    if ($baud > 1000000){
      $baud = $baud/1000000;
      $ret = "$baud Mb/s";
    }
    else if ($baud > 1000){
      $baud = $baud/1000;
      $ret = "$baud Kb/s";
    }
    else{
      $ret = "$baud b/s";
    }

    return $ret;
  }

  // See https://en.wikipedia.org/wiki/Load_(computing)#Unix-style_load_calculation 
  // for more info on load average % calculation
  function pretty_load_average($load_average){
    $load_average = substr($load_average, 0, -1);
    if ($load_average < 1.0) {
      $avg_percent = (($load_average-1) * -1) * 100; // * -1 to get a positive percentage
      return "{$avg_percent}% Idling ($load_average)";
    }
    else {
      $avg_percent = ($load_average-1) * 100;
      return "{$avg_percent}% Overloaded ($load_average)";
    }
  }

