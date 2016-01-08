<h4><i class="fa fa-bolt"></i> Memory</h4>

<?php
  $output = shell_exec('cat /proc/meminfo');
  $table_rows = preg_split ('/$\R?^/m', $output);
  $row_mem_total = $table_rows[0];
  $row_mem_free  = $table_rows[1];

  $mem_total = explode(' ', $row_mem_total);
  $mem_total = $mem_total[count($mem_total)-2];

  $mem_free = explode(' ', $row_mem_free);
  $mem_free = $mem_free[count($mem_free)-2];

  $mem_used_percentage = floor((($mem_total-$mem_free)/$mem_total)*100);
?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td>
      <p>Free:</p>
    </td>
    <td>
     <p class="text-right"><?php echo floor($mem_free/1024); ?>MB&nbsp;</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Total:</p>
    </td>
    <td>
     <p class="text-right"><?php echo floor($mem_total/1000); ?>MB</p>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div class="progress">
        <div
          class="progress-bar" 
          role="progressbar" 
          aria-valuenow="<?php echo $mem_used_percentage; ?>" 
          aria-valuemin="0" 
          aria-valuemax="100" 
          style="min-width: 2em; width: <?php echo $mem_used_percentage; ?>%;"
        >
          <?php echo $mem_used_percentage; ?>%
        </div>
      </div>
    </td>
  </tr>
 </tbody>
</table>