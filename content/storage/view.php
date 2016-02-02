<?php
namespace CurrantPi;

include 'content/storage/StorageData.php';
$storage = new StorageData();
$storage_data = $storage->getData();

?>

<h4><i class="demo-icon icon-database"></i> Storage</h4>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th><p>Filesystem</p></th>
      <th><p class='text-center'>Size</p></th>
      <th><p class='text-center'>Available</p></th>
      <th><p id='storage_pct_bars' class='text-center'>%&nbsp;Used</p></th>
      <th><p class='text-right'>Mounted</p></th>
    </tr>
  </thead>
  <tbody>
     <?php
      foreach ($storage_data->storage as $row) {
          echo '<tr>';
          $col_count = 0;
          foreach ($row as $item) {
              switch ($col_count) {
              // First Column - The file system. Should be left aligned. 
              case 0:
                echo "<td><p>$item</p></td>";
                break;

              // Hide this column 
              case 2:
                break;

              // Column 4 is where we use the % bar to show storage used
              case 4:
                $percentage = intval($item);
                ?>
                  <td>
                    <div class="progress">
                      <div
                        class="progress-bar progress-bar-custom" 
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

              // Column 5 - Right align the mount point
              case 5:
                echo "<td><p class='text-right'>$item</p></td>";
                break;

              // Everything else, make sure it;s center aligned.
              default:
                  echo "<td><p class='text-center'>$item</p></td>";
            }
              ++$col_count;
          }
          echo '</tr>';
      }
    ?>           
 </tbody>
</table>
