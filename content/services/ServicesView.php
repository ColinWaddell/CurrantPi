<?php namespace CurrantPi; ?>

<h4><i class="demo-icon icon-sliders"></i> Services</h4>

<?php
include 'content/services/ServicesData.php';
$services = new ServicesData();

foreach ($services->getData() as $service){
  if($service->status=="active"){
    echo '<span class="label label-success">'.$service->name.'</span> ';
  }
  else {
    echo '<span class="label label-danger">'.$service->name.'</span> ';
  }
}
?>

