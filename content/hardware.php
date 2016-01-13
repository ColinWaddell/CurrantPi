<h4><i class="fa fa-server"></i> Hardware</h4>

<?php
  $output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
  $temp = round(($output)/1000, 1);

  $output = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
  $time_alive = seconds_to_time(intval($output));
?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>Uptime: </p></td>
    <td><p class="text-right"><?php echo "$time_alive";?></p></td>
  </tr>
  <tr>
    <td><p>Board Temperature: </p></td>
    <td><p class="text-right"><?php echo "$temp&deg;C";?></p></td>
  </tr>
 </tbody>
</table>