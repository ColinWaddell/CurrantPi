<h4><i class="fa fa-database"></i> Storage</h4>

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
                    class="progress-bar progress-bar-grey" 
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
