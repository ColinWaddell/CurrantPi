<h4><i class="fa fa-bolt"></i> Memory</h4>

<?php
  $mem_free = intval(shell_exec("free -m | awk '/buffers\/cache/ {print $3}'"));
  $mem_total = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));
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
      <?php include('memory_bar.php'); ?>
    </td>
  </tr>
 </tbody>
</table>
