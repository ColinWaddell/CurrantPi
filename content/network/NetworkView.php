<?php
namespace CurrantPi;

include 'content/network/NetworkData.php';
$network = new NetworkData();
$network_data = $network->getData();

?>

<h4><i class="demo-icon icon-exchange"></i> Network - <?php echo $network->interface; ?></h4>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>Down:</p></td>
    <td><p class="text-right"><?php echo $network_data->down;?></p></td>
  </tr>
  <tr>
    <td><p>Up:</p></td>
    <td><p class="text-right"><?php echo $network_data->up;?></p></td>
  </tr>
  </tbody>
</table>
