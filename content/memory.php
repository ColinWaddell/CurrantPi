<h4><i class="fa fa-bolt"></i> Memory</h4>

<?php
  $output = shell_exec('cat /proc/meminfo');

  $mem_free = intval(shell_exec("free -m | awk '/buffers\/cache/ {print $3}'"));
  $mem_total = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));

  $mem_used_percentage = floor((($mem_total-$mem_free)/$mem_total)*100);
?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td>
      <p>Free:</p>
    </td>
    <td>
     <p class="text-right"><?php echo $mem_free; ?>&nbsp;MB</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Total:</p>
    </td>
    <td>
     <p class="text-right"><?php echo $mem_total; ?>&nbsp;MB</p>
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
