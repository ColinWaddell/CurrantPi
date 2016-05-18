<?php
  /*
   * Title area. Check out custom.css for how this is tweaked. 
   */

  $hostname = shell_exec('hostname');
?>

<div class="col-sm-8 title-text">
  <h1>Currant Pi</h1>
  <h3><span id="hostname"><?php echo $hostname; ?></span> Status</h3>
</div>
<div class="col-sm-4 title-logo">
  <img src="img/Raspberry_Pi_Logo.svg" alt="Currant Pi Logo" class="title_logo">
</div>
