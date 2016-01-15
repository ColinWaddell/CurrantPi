<h4><i class="demo-icon icon-sliders"></i> Memory</h4>

<?php
  $mem_free = intval(shell_exec("free -m | awk '/buffers\/cache/ {print $3}'"));
  $mem_total = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));

  $used_act = intval(shell_exec("free | awk '/buffers\/cache/ {print $3}'"));
  $free = intval(shell_exec("free | awk '/Mem/ {print $4}'"));
  $buffers = intval(shell_exec("free | awk '/Mem/ {print $6}'"));
  $cache = intval(shell_exec("free | awk '/Mem/ {print $7}'"));
  $total_act = $used_act + $free + $buffers + $cache;

  $free_p = (100*($free/$total_act));
  $buffers_p = (100*($buffers/$total_act));
  $cache_p = (100*($cache/$total_act));
  $used_act_p = (100*($used_act/$total_act));
?>

<table class="table table-striped table-hover">
  <tbody>
    <tr>
      <td colspan="4">
        <div class="row row-memory">
          <div class="col-xs-9">
            <div class="progress">
              <div class="progress-bar progress-bar-used" 
                role="progressbar" 
                aria-valuenow="<?php echo $used_act_p;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $used_act_p;?>%">
                <span class="sr-only"><?php echo strval(round($used_act_p, 2));?>% Used</span>
              </div>  
              <div class="progress-bar progress-bar-buffers" 
                role="progressbar" 
                aria-valuenow="<?php echo $buffers;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $buffers_p;?>%">
                <span class="sr-only"><?php echo strval(round($buffers_p, 2));?>% Buffers</span>
              </div>
              <div class="progress-bar progress-bar-cache" 
                role="progressbar" 
                aria-valuenow="<?php echo $cache;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $cache_p;?>%">
                <span class="sr-only"><?php echo strval(round($cache_p, 2));?>% Cache</span>
              </div>  
              <div class="progress-bar progress-bar-free" 
                role="progressbar" 
                aria-valuenow="<?php echo $free;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $free_p;?>%">
                <span class="sr-only"><?php echo strval(round($free_p, 2));?>% Free</span>
              </div>  
            </div>
          </div>
          <div class="col-xs-3">
            <p class="text-right"><?php echo $mem_total;?>MB&nbsp;</p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="membar-key">
        <span class="membar-key-used">
          <?php echo intval($used_act_p);?>%
        </div>
      </td>
      <td>
        <p>Used</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-buffers">
          <?php echo intval($buffers_p);?>%
        </div>
      </td>
      <td>
        <p>Buffers</p>
      </td>
    </tr>

    <tr>
      <td class="membar-key">
        <span class="membar-key-cache">
          <?php echo intval($cache_p);?>%
        </div>
      </td>
      <td>
        <p>Cache</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-free">
          <?php echo intval($free_p);?>%
        </div>
      </td>
      <td>
        <p>Free</p>
      </td>
    </tr> 
  </tbody>
</table>
