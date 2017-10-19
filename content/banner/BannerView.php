<?php
  /*
   * Title area. Check out custom.css for how this is tweaked. 
   */

  $hostname = shell_exec('hostname');
?>

<div class="col-xs-8 title-text">
  <h1>Currant Pi</h1>
  <h3>Raspberry Pi Status</h3>
</div>
<div class="col-xs-4 title-logo">
  <a href="#" class="title-image">
    <?php echo $hostname; ?>
  </a>

</div>
