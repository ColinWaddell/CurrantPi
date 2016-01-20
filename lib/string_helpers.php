<?php
  /*
   * The following scripts are used to return a nicer version
   * of a value to use on the page.
   */

  /*
   * Convert a number of seconds into the
   * Days-Hours-Minutes format.
   */
  function seconds_to_time($seconds) {
      $dtF = new DateTime("@0");
      $dtT = new DateTime("@$seconds");
      return $dtF->diff($dtT)->format('%ad %hh %im');
  }

  /*
   * Take a number of bytes and return it
   * either in terms of Gigs or Megs.
   */
  function pretty_memory($total) {
    $total= intval($total);
    $ret = "unknown";

    if ($total > 999){
      $total = round($total/1024, 2);
      $ret = "{$total} GB";
    }
    else{
      $ret = "{$total} MB";
    }

    return $ret;
  }

  /*
   * Figure out of the baud rate should be
   * shown as MB/s, Kb/s or b/s.
   */
  function pretty_baud($baud) {
    $baud = intval($baud);
    $ret = "unknown";

    if ($baud > 1000000){
      $baud = round($baud/1000000, 2);
      $ret = "$baud Mb/s";
    }
    else if ($baud > 1000){
      $baud = round($baud/1000, 2);
      $ret = "$baud Kb/s";
    }
    else{
      $ret = "$baud b/s";
    }

    return $ret;
  }

  /*
   * Take in the load_average as returned by the
   * uptime command and return it as a percentage
   * with the appropriate formating.
   */
  function pretty_load_average($load_average){
    $load_average = substr($load_average, 0, -1);
    $avg_percent = ($load_average) * 100;
    return "<span class='text-muted'>{$avg_percent}%</span>&nbsp; &nbsp; &nbsp;$load_average";
  }
