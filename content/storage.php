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
      <th><p>Filesystem</p></th>
      <th><p class='text-center'>Size</p></th>
      <th><p class='text-center'>Available</p></th>
      <th><p id='storage_pct_bars' class='text-center'>% Used</p></th>
      <th><p class='text-right'>Mounted</p></th>
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
            switch ($col_count) {
              case 0:
                echo "<td><p>$item</p></td>";
                break;
                
              case 2:
                /* Hide this column */
                break;
                
              case 4:
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
                <?php
                break;
                
              case 5:
                echo "<td><p class='text-right'>$item</p></td>";
                break;
                
              default:
                  echo "<td><p class='text-center'>$item</p></td>";
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
