 <h4><i class="fa fa-area-chart"></i> Load average</h4>

 <?php
  $output = shell_exec('uptime');
  $loadavg = explode(' ', substr($output, strpos($output,'load average:')+14));
 ?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>1 min:</p></td>
    <td><p class="text-right"><?php echo substr($loadavg[0], 0, -1);?></p></td>
  </tr>
  <tr>
    <td><p>5 min:</p></td>
    <td><p class="text-right"><?php echo substr($loadavg[1], 0, -1);?></p></td>
  </tr>
  <tr>
    <td><p>15 min:</p></td>
    <td><p class="text-right"><?php echo $loadavg[2];?></p></td>
  </tr>
  </tbody>
</table>