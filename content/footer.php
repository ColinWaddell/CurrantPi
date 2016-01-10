<p>
  <?php echo $_SERVER['SERVER_NAME'] . " (" . $_SERVER['SERVER_ADDR'] . ")"; ?> 
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
<p><a href="https://github.com/ColinWaddell/CurrantPi"><i class="fa fa-github-alt"></i> Source</a></p>
<hr />
<p>&copy; 2016 <a href="http://colinwaddell.com/">Colin Waddell</a> under the terms of the<a href="LICENSE.txt"> MIT License.</a>
