<?php
namespace CurrantPi;

/**
 * api.php.
 *
 * Currant Pi - Raspberry Pi Status
 *
 * @author     Colin Waddell
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 *
 * @link       https://github.com/ColinWaddell/CurrantPi
 */

 /*
  * Libraries and helper function
  */
include('lib/StringHelpers.php');
include('lib/ServerData.php');

/*
 * List of content sources
 */
$sources = [
  'footer'        =>  'FooterData',
  'hardware'      =>  'HardwareData',
  'load_average'  =>  'LoadData',
  'memory'        =>  'MemoryData',
  'network'       =>  'NetworkData',
  'storage'       =>  'StorageData',
];

/*
 * Use $server_info to accumulate
 * information about the server
 */
$server_info = new \stdClass();

foreach ($sources as $dir => $class) {
  // Load a module as defined in $sources
  include 'content/'.$dir.'/'.$class.'.php';
  $class_name = 'CurrantPi\\'.$class;
  
  // Instantiate a version of the
  // module, grab its data then
  // append it to $server_info
  $data_class = new $class_name;
  $data = $data_class->getData();
  $server_info->$dir = $data;
}

/*
 * Return a json formatted copy
 * of the server information.
 */
echo json_encode(['server_info' => $server_info]);
