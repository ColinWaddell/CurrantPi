<?php
namespace CurrantPi;

/*
 * Footer area. Using a bunch of inline echos to find out
 * information about this system.
 */
include 'content/footer/FooterData.php';
$footer = new FooterData();
$footer_data = $footer->getData();

?>

<p><?php echo $footer_data->webserver; ?> - <?php echo $footer_data->php_version; ?></p>
<p><?php echo $footer_data->cpu; ?></p>

<p>
  <a href="https://github.com/ColinWaddell/CurrantPi"><i class="demo-icon icon-github"></i></a>
  <a href="https://github.com/ColinWaddell/CurrantPi">Source</a>
</p>
<hr />
<p>
  &copy; <?php echo date("Y") ?> <a href="http://colinwaddell.com/">Colin Waddell</a> under the terms of the <a href="https://opensource.org/licenses/MIT" target="_blank">MIT License</a>
</p>
