<?php
namespace CurrantPi;

include 'content/load_average/LoadAverageData.php';
$load = new LoadAverageData();
$load_data = $load->getData();

?>

<h4><i class="demo-icon icon-chart-area"></i> CPU Load Average</h4>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>1 min:</p></td>
    <td><p class="text-right"><span class='text-muted'><?php echo $load_data->one_min['percent'] ?>&#37;</span>&nbsp; &nbsp; &nbsp;<?php echo $load_data->one_min['average'] ?></p></td>
  </tr>
  <tr>
    <td><p>5 min:</p></td>
    <td><p class="text-right"><span class='text-muted'><?php echo $load_data->five_mins['percent'] ?>&#37;</span>&nbsp; &nbsp; &nbsp;<?php echo $load_data->five_mins['average'] ?></p></td>
  </tr>
  <tr>
    <td><p>15 min:</p></td>
    <td><p class="text-right"><span class='text-muted'><?php echo $load_data->fifteen_mins['percent'] ?>&#37;</span>&nbsp; &nbsp; &nbsp;<?php echo $load_data->fifteen_mins['average'] ?></p></td>
  </tr>
  </tbody>
</table>
