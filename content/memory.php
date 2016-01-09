<h4><i class="fa fa-bolt"></i> Memory</h4>

<?php
  // RAM in MB
  $total_m = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));
  $used_m = intval(shell_exec("free -m | awk '/Mem/ {print $3}'"));
  $free_m = intval(shell_exec("free -m | awk '/Mem/ {print $4}'"));

  // RAM in bytes
  $total = intval(shell_exec("free | awk '/Mem/ {print $2}'"));
  $used = intval(shell_exec("free | awk '/Mem/ {print $3}'"));
  $free = intval(shell_exec("free | awk '/Mem/ {print $4}'"));

  // Percentage
  $free_p = round(100*($free/$total), 2);
  $used_p = round(100*($used/$total), 2);
?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td>
      <p>Free:</p>
    </td>
    <td>
     <p class="text-right"><?php echo $free_m; ?>/<?php echo $total_m; ?>&nbsp;MB</p>
    </td>
  </tr>
  <tr>
    <td>
      <p>Used:</p>
    </td>
    <td>
     <p class="text-right"><?php echo $used_m; ?>/<?php echo $total_m; ?>&nbsp;MB</p>
    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div class="progress">
        <div class="progress-bar progress-bar-free" style="width: <?php echo $free_p;?>%"><?php echo $free_p;?>%</div>  
        <div class="progress-bar progress-bar-used" style="width: <?php echo $used_p;?>%"><?php echo $used_p;?>%</div>  
      </div>
    </td>
  </tr>
 </tbody>
</table>
