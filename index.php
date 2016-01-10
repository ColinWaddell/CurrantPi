<?php
  /**
   * index.php
   *
   * Currant Pi - Raspberry Pi Status
   *
   * @author     Colin Waddell
   * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
   * @link       https://github.com/ColinWaddell/CurrantPi
   */

   /*
    * Libraries and helper function
   */
  include ('lib/string_helpers.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Header -->
    <?php include ('content/header.php'); ?>
  </head>

  <body>

    <div class="container">

      <div class="header clearfix title-area">
        <!-- Banner -->
        <?php include ('content/banner.php'); ?>
      </div>

      <div class="row">
        <!-- Hardware -->
        <div class="col-lg-6">
          <?php include ('content/hardware.php'); ?>
        </div>
        <!-- Network -->
        <div class="col-lg-6">
          <?php include ('content/network.php'); ?>
        </div>
      </div>

      <div class="row">
        <!-- Load Average -->
        <div class="col-lg-6">
          <?php include ('content/load_average.php'); ?>
        </div>
        <div class="col-lg-6">
          <!-- Memory -->
          <?php include ('content/memory.php'); ?>
        </div>
      </div>

      <div class="row">
        <!-- Storage -->
        <div class="col-lg-12">
          <?php include ('content/storage.php'); ?>
        </div>
      </div>

      <hr />

      <!-- Footer -->
      <footer class="footer">
        <?php include ('content/footer.php'); ?>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
