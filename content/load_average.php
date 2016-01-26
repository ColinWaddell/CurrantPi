<h4><i class="demo-icon icon-chart-area"></i> CPU Load Average</h4>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>1 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($server_info['load_average']['1 min'])?></p></td>
  </tr>
  <tr>
    <td><p>5 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($server_info['load_average']['5 min'])?></p></td>
  </tr>
  <tr>
    <td><p>15 min:</p></td>
    <td><p class="text-right"><?php echo pretty_load_average($server_info['load_average']['15 min'])?></p></td>
  </tr>
  </tbody>
</table>
