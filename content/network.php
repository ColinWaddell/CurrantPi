 <h4><i class="demo-icon icon-exchange"></i> Network</h4>

 <?php

  /*
   * There is a custom script alongside this project called 'uptime'
   * which figures out the amount of data going through the network
   * in the past second. This script takes one second to execute so
   * will delay the loading of the page accordingly.
   *
   * Also using one of the scripts in lib/string_helpers.php to
   * print the network speed in either b/s, Kb/s or Gb/s.
   */

  $output = shell_exec('sh ./lib/transfer_rate.sh');
  $rates = explode(' ', $output);
 ?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>Down:</p></td>
    <td><p class="text-right"><?php echo pretty_baud($rates[0]);?></p></td>
  </tr>
  <tr>
    <td><p>Up:</p></td>
    <td><p class="text-right"><?php echo pretty_baud($rates[1]);?></p></td>
  </tr>
  </tbody>
</table>
