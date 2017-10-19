<?php
  /*
   * Title area. Check out custom.css for how this is tweaked. 
   */

  $hostname = shell_exec('hostname');
?>

<div class="col-sm-8 title-text">
  <h1>Currant Pi</h1>
  <h3>Raspberry Pi Status</h3>
</div>
<div class="col-sm-4 title-brand">
  <a class="title-logo">
    <div class="title-image">
      <?php echo $hostname; ?>
    </div>
  </a>
</div>
