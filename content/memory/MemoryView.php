<?php
namespace CurrantPi;

include 'content/memory/MemoryData.php';
$memory = new MemoryData();
$memory_data = $memory->getData();

?>

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
                aria-valuenow="<?php echo $memory_data->used_percentage;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $memory_data->total;?>" 
                style="width: <?php echo $memory_data->used_percentage;?>%">
                <span class="sr-only"><?php echo $memory_data->used_percentage;?>% Used</span>
              </div>  
              <div class="progress-bar progress-bar-buffers" 
                role="progressbar" 
                aria-valuenow="<?php echo $memory_data->buffers;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $memory_data->total_act;?>" 
                style="width: <?php echo $memory_data->buffers_p;?>%">
                <span class="sr-only"><?php echo $memory_data->buffers_percentage;?>% Buffers</span>
              </div>
              <div class="progress-bar progress-bar-cache" 
                role="progressbar" 
                aria-valuenow="<?php echo $memory_data->cache;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $memory_data->total_act;?>" 
                style="width: <?php echo $memory_data->cache_p;?>%">
                <span class="sr-only"><?php echo $memory_data->cache_percentage;?>% Cache</span>
              </div>  
              <div class="progress-bar progress-bar-free" 
                role="progressbar" 
                aria-valuenow="<?php echo $memory_data->free;?>" 
                aria-valuemin="0" 
                aria-valuemax="<?php echo $memory_data->total_act;?>" 
                style="width: <?php echo $memory_data->free_p;?>%">
                <span class="sr-only"><?php echo $memory_data->free_percentage;?>% Free</span>
              </div>  
            </div>
          </div>
          <div class="col-xs-3">
            <p class="text-right"><?php echo $memory_data->total;?></p>
          </div>
        </div>
      </td>
    </tr>
    <tr>
      <td class="membar-key">
        <span class="membar-key-used">
            <?php echo intval($memory_data->used_percentage);?>%
        </span>
      </td>
      <td>
        <p>Used</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-buffers">
            <?php echo intval($memory_data->buffers_percentage);?>%
        </span>
      </td>
      <td>
        <p>Buffers</p>
      </td>
    </tr>

    <tr>
      <td class="membar-key">
        <span class="membar-key-cache">
            <?php echo intval($memory_data->cache_percentage);?>%
        </span>
      </td>
      <td>
        <p>Cache</p>
      </td>
      <td class="membar-key">
        <span class="membar-key-free">
            <?php echo intval($memory_data->free_percentage);?>%
        </span>
      </td>
      <td>
        <p>Free</p>
      </td>
    </tr> 
  </tbody>
</table>
