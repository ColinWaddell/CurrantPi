<?php
namespace CurrantPi;

include 'content/hardware/HardwareData.php';
$hardware = new HardwareData();
$hardware_data = $hardware->getData();

?>

<h4><i class="demo-icon icon-server"></i> Hardware</h4>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>Uptime: </p></td>
    <td><p class="text-right"><?php echo $hardware_data->uptime;?></p></td>
  </tr>
  <tr>
    <td><p>Board Temperature: </p></td>
    <td><p class="text-right"><?php echo $hardware_data->temperature.'&deg;C';?></p></td>
  </tr>
 </tbody>
</table>
