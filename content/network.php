 <h4><i class="fa fa-exchange"></i> Network</h4>

 <?php
  $output = shell_exec('sh ./transfer_rate.sh');
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