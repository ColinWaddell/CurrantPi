<h4><i class="demo-icon icon-sliders"></i> Memory</h4>

<table class="table table-striped table-hover">
  <tbody>
    <tr>
      <td colspan="4">
        <div class="row row-memory">
          <div class="col-xs-9">
            <div class="progress">
              <div class="progress-bar progress-bar-used" 
                role="progressbar" 
                aria-valuenow="<?php echo $server_info['memory']['used_percentage'];?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $server_info['memory']['total'];?>" 
                style="width: <?php echo $server_info['memory']['used_percentage'];?>%">
                <span class="sr-only"><?php echo $server_info['memory']['used_percentage'];?>% Used</span>
              </div>  
              <div class="progress-bar progress-bar-buffers" 
                role="progressbar" 
                aria-valuenow="<?php echo $buffers;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $buffers_p;?>%">
                <span class="sr-only"><?php echo $server_info['memory']['buffers_percentage'];?>% Buffers</span>
              </div>
              <div class="progress-bar progress-bar-cache" 
                role="progressbar" 
                aria-valuenow="<?php echo $cache;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $cache_p;?>%">
                <span class="sr-only"><?php echo $server_info['memory']['cache_percentage'];?>% Cache</span>
              </div>  
              <div class="progress-bar progress-bar-free" 
                role="progressbar" 
                aria-valuenow="<?php echo $free;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $total_act;?>" 
                style="width: <?php echo $free_p;?>%">
                <span class="sr-only"><?php echo $server_info['memory']['free_percentage'];?>% Free</span>
              </div>  
            </div>
          </div>
          <div class="col-xs-3">
            <p class="text-right"><?php echo $server_info['memory']['total'];?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="membar-key">
        <span class="membar-key-used">
          <?php echo intval($server_info['memory']['used_percentage']);?>%
        </span>
      </td>
      <td>
        <p>Used</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-buffers">
          <?php echo intval($server_info['memory']['buffers_percentage']);?>%
        </span>
      </td>
      <td>
        <p>Buffers</p>
      </td>
    </tr>

    <tr>
      <td class="membar-key">
        <span class="membar-key-cache">
          <?php echo intval($server_info['memory']['cache_percentage']);?>%
        </span>
      </td>
      <td>
        <p>Cache</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-free">
          <?php echo intval($server_info['memory']['free_percentage']);?>%
        </span>
      </td>
      <td>
        <p>Free</p>
      </td>
    </tr> 
  </tbody>
</table>
