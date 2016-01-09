<?php
  $used_act = intval(shell_exec("free | awk '/buffers\/cache/ {print $3}'"));
  $free = intval(shell_exec("free | awk '/Mem/ {print $4}'"));
  $buffers = intval(shell_exec("free | awk '/Mem/ {print $6}'"));
  $cache = intval(shell_exec("free | awk '/Mem/ {print $7}'"));
  $total_act = $used_act + $free + $buffers + $cache;

  $free_p = (100*($free/$total_act));
  $buffers_p = (100*($buffers/$total_act));
  $cache_p = (100*($cache/$total_act));
  $used_act = (100*($used_act/$total_act));
?>

<div class="progress">
  <div class="progress-bar progress-bar-used" 
    role="progressbar" 
    aria-valuenow="<?php echo $used_act;?>" 
    aria-valuemin="0" 
    aria-valuemax="<?php echo $total_act;?>" 
    style="width: <?php echo $used_act;?>%">
    <?php echo intval($used_act);?>% Used
  </div>  
  <div class="progress-bar progress-bar-buffers" 
    role="progressbar" 
    aria-valuenow="<?php echo $buffers;?>" 
    aria-valuemin="0" 
    aria-valuemax="<?php echo $total_act;?>" 
    style="width: <?php echo $buffers_p;?>%">
    <span class="sr-only"><?php echo intval($buffers);?>% Buffers</span>
  </div>
  <div class="progress-bar progress-bar-cache" 
    role="progressbar" 
    aria-valuenow="<?php echo $cache;?>" 
    aria-valuemin="0" 
    aria-valuemax="<?php echo $total_act;?>" 
    style="width: <?php echo $cache_p;?>%">
    <span class="sr-only"><?php echo intval($cache);?>% Cache</span>
  </div>  
  <div class="progress-bar progress-bar-free" 
    role="progressbar" 
    aria-valuenow="<?php echo $free;?>" 
    aria-valuemin="0" 
    aria-valuemax="<?php echo $total_act;?>" 
    style="width: <?php echo $free_p;?>%">
    <span class="sr-only"><?php echo intval($free);?>% Free</span>
  </div>  
</div>

<div class="row membar-info">
  <div class="col-sm-4 membar-key membar-key-buffers">
    <p>Buffers</p>
  </div>
  <div class="col-sm-4 membar-key membar-key-cache">
    <p>Cache</p>
  </div>
  <div class="col-sm-4 membar-key membar-key-free">
    <p>Free</p>
  </div>
</div>
