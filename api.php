<?php
  /**
   * api.php.
   *
   * Currant Pi - Raspberry Pi Status
   *
   * @author     Colin Waddell
   * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
   *
   * @link       https://github.com/ColinWaddell/CurrantPi
   */

   /*
    * Libraries and helper function
   */
  include 'lib/string_helpers.php';
  include 'readings/server_info.php';

  echo json_encode(['server_info' => $server_info]);
