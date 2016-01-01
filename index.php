<?php
  function secondsToTime($seconds) {
      $dtF = new DateTime("@0");
      $dtT = new DateTime("@$seconds");
      return $dtF->diff($dtT)->format('%ad %hh %im %ss');
  }

  function pretty_baud($baud) {
    $baud = intval($baud);
    $ret = "unknown";

    if ($baud > 1000){
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

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">
      <div class="header clearfix">
        <h3 class="text-muted title_logo_text">Raspberry Pi - Board Details</h3>
        <img src="img/Raspberry_Pi_Logo.svg" class="title_logo">
      </div>

      <div class="row">
        <div class="col-lg-6">
          <h4>Network</h4>

           <?php
            $output = shell_exec('./transfer_rate.sh');
            $rates = explode(' ', $output);
           ?>

          <table class="table table-striped">
            <tbody>
            <tr>
              <td>Down:</td>
              <td><?php echo pretty_baud($rates[0]);?></td>
            </tr>
            <tr>
              <td>Up:</td>
              <td><?php echo pretty_baud($rates[1]);?></td>
            </tr>
            </tbody>
          </table>
        </div>

        <div class="col-lg-6">
          <h4>Hardware</h4>

          <?php
            $output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
            $temp = intval($output)/1000;

            $output = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
            $time_alive = secondsToTime(intval($output));
          ?>

          <table class="table table-striped">
            <tbody>
            <tr>
              <td>Time Alive: </td>
              <td><?php echo "$time_alive";?></td>
            </tr>
            <tr>
              <td>Board Temperature: </td>
              <td><?php echo "$temp&deg;C";?></td>
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

          <table class="table table-striped">
            <thead>
              <tr>
                <?php
                  foreach($table_header as $header) {
                    if ($header!==""){
                      echo "<th>$header</th>";
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
                  foreach($items as $item){
                    if ($item!==""){
                      echo "<td>$item</td>";
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
          <?php echo $_SERVER[SERVER_NAME]; ?>
           - 
          <?php echo $_SERVER[SERVER_SOFTWARE]; ?>
        </p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
