 <h4><i class="fa fa-area-chart"></i> CPU Load Average</h4>

 <?php
  $output = shell_exec('uptime');
  $loadavg = explode(' ', substr($output, strpos($output,'load average:')+14));
 ?>

<table class="table table-striped table-hover">
  <tbody>
  <tr>
    <td><p>1 min:</p></td>
    <td>
      <div class="progress">
        <div
          class="progress-bar progress-bar-grey" 
          role="progressbar" 
          aria-valuenow="<?php echo percentage_load_average($loadavg[0]); ?>" 
          aria-valuemin="0" 
          aria-valuemax="100" 
          style="width: <?php echo percentage_load_average($loadavg[0]); ?>%;"
        >
          <?php echo percentage_load_average($loadavg[0]) ?>%
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td><p>5 min:</p></td>
    <td>
      <div class="progress">
        <div
          class="progress-bar progress-bar-grey" 
          role="progressbar" 
          aria-valuenow="<?php echo percentage_load_average($loadavg[1]); ?>" 
          aria-valuemin="0" 
          aria-valuemax="100" 
          style="width: <?php echo percentage_load_average($loadavg[1]); ?>%;"
        >
          <?php echo percentage_load_average($loadavg[1]) ?>%
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td><p>15 min:</p></td>
    <td>
      <div class="progress">
        <div
          class="progress-bar progress-bar-grey" 
          role="progressbar" 
          aria-valuenow="<?php echo percentage_load_average($loadavg[2]); ?>" 
          aria-valuemin="0" 
          aria-valuemax="100" 
          style="width: <?php echo percentage_load_average($loadavg[2]); ?>%;"
        >
          <?php echo percentage_load_average($loadavg[2]) ?>%
        </div>
      </div>
    </td>
  </tr>
  </tbody>
</table>
