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

  function pretty_load_average($load_average){
    $avg = intval(substr($load_avgerage, 0, -1));
    $avg_percent = $avg * 100;
    return "{$avg_percent}% Utilized";
  }

