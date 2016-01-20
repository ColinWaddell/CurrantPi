 <h4><i class="demo-icon icon-chart-area"></i> CPU Load Average</h4>

 <?php

  /*
   * The command uptime returns a bunch of information about how long
   * the system has been running and the load on the processor. Read
   * more about this information here
   *   - http://www.computerhope.com/unix/uptime.htm
   */

  $output = shell_exec('uptime');
  $loadavg = explode(' ', substr($output, strpos($output,'load average:')+14));
 ?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>1 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($loadavg[0])?></p></td>
  </tr>
  <tr>
    <td><p>5 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($loadavg[1])?></p></td>
  </tr>
  <tr>
    <td><p>15 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($loadavg[2])?></p></td>
  </tr>
  </tbody>
</table>
