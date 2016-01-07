<?php
  function seconds_to_time($seconds) {
      $dtF = new DateTime("@0");
      $dtT = new DateTime("@$seconds");
      return $dtF->diff($dtT)->format('%ad %hh %im');
  }

  function pretty_baud($baud) {
    $baud = intval($baud);
    $ret = "unknown";

    if ($baud > 1000000){
      $baud = $baud/1000000;
      $ret = "$baud Mb/s";
    }
    else if ($baud > 1000){
      $baud = $baud/1000;
      $ret = "$baud Kb/s";
    }
    else{
      $ret = "$baud b/s";
    }


    return $ret;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Raspberry Pi - Board Details</title>

    <link href="favicon.ico" type="image/x-icon" rel="icon" />

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="row">
        <div class="col-lg-12 title_area">
          <h2>Raspberry Pi</h2>
          <h3 class="text-muted">Board Details</h3>
          <img src="img/Raspberry_Pi_Logo.svg" class="title_logo">
        </div>

        <div class="col-lg-6">
             <h4>Load average</h4>

             <?php
              $output = shell_exec('uptime');
              $loadavg = explode(' ', substr($output2, strpos($output2,'load average:')+14);)
             ?>

            <table class="table table-striped table-hover">
              <tbody>
              <tr>
                <td><p>1min:</p></td>
                <td><p class="text-right"><?php echo $loadavg[0];?></p></td>
              </tr>
              <tr>
                <td><p>5min:</p></td>
                <td><p class="text-right"><?php echo $loadavg[1];?></p></td>
              </tr>
              <tr>
                <td><p>15min:</p></td>
                <td><p class="text-right"><?php echo $loadavg[2];?></p></td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-lg-6">
         <h4>Memory</h4>

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
        </div>
      </div>


      <div class="row">
        <div class="col-lg-6">
          <h4>Hardware</h4>

          <?php
            $output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
            $temp = intval($output)/1000;

            $output = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
            $time_alive = seconds_to_time(intval($output));
          ?>

          <table class="table table-striped table-hover">
            <tbody>
            <tr>
              <td><p>Time Alive: </p></td>
              <td><p class="text-right"><?php echo "$time_alive";?></p></td>
            </tr>
            <tr>
              <td><p>Board Temperature: </p></td>
              <td><p class="text-right"><?php echo "$temp&deg;C";?></p></td>
            </tr>
           </tbody>
          </table>
        </div>

        <div class="col-lg-6">
           <h4>Network</h4>

           <?php
            $output = shell_exec('sh ./transfer_rate.sh');
            $rates = explode(' ', $output);
           ?>

          <table class="table table-striped table-hover">
            <tbody>
            <tr>
              <td><p>Down:</p></td>
              <td><p class="text-right"><?php echo pretty_baud($rates[0]);?></p></td>
            </tr>
            <tr>
              <td><p>Up:</p></td>
              <td><p class="text-right"><?php echo pretty_baud($rates[1]);?></p></td>
            </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12">
         <h4>Storage</h4>

          <?php
            $output = shell_exec('df -H');
            $table_rows = preg_split ('/$\R?^/m', $output);
            $table_header = explode(' ', $table_rows[0]);
            $table_rows = array_splice($table_rows, 1);
            $table_header = array_splice($table_header, 0, count($table_header)-1);
          ?>

          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <?php
                  $col_count = 0;
                  foreach($table_header as $header) {
                    if ($header!==""){
                      if($col_count==4){
                        echo "<th><p id='storage_pct_bars' class='text-center'>$header</p></th>";
                      }
                      else if($col_count==5){
                        echo "<th><p class='text-right'>$header</p></th>";
                      }
                      else if($col_count>0){
                        echo "<th><p class='text-center'>$header</p></th>";
                      }
                      else{
                        echo "<th><p>$header</p></th>";
                      }
                      $col_count++;
                    }
                  }
                ?>
              </tr>
            </thead>
            <tbody>
            <tr>
               <?php
                foreach($table_rows as $row) {
                  echo "<tr>";
                  $items = explode(' ', $row);
                  $col_count = 0;
                  foreach($items as $item){
                    if ($item!==""){
                      if($col_count==4){ 
                        $percentage = intval($item);
                        ?>

                        <td>
                          <div class="progress">
                            <div
                              class="progress-bar" 
                              role="progressbar" 
                              aria-valuenow="<?php echo $percentage; ?>" 
                              aria-valuemin="0" 
                              aria-valuemax="100" 
                              style="width: <?php echo $percentage; ?>%;"
                            >
                              <?php echo $percentage; ?>%
                            </div>
                          </div>
                        </td>
                      <?php }
                      else if($col_count==5){
                        echo "<td><p class='text-right'>$item</p></td>";
                      }
                      else if($col_count>0){
                        echo "<td><p class='text-center'>$item</p></td>";
                      }
                      else{
                        echo "<td><p>$item</p></td>";
                      }
                      $col_count++;
                    }
                  }
                  echo "</tr>";
                }
              ?>           
            </tr>
           </tbody>
          </table>
        </div>
      </div>

      <hr />

      <footer class="footer">
        <p>
          <?php echo $_SERVER['SERVER_NAME']; ?>
           - 
          <?php echo $_SERVER['SERVER_SOFTWARE']; ?>
        </p>
        <p>
         <?php
            $name_full = shell_exec('cat /proc/cpuinfo | grep name | head -1');
            $name = explode (': ', $name_full);
            echo $name[1];
          ?>
        </p>
        <p><a href="https://github.com/ColinWaddell/RPi-Board-Info">Source</a></p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
