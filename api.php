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

$parts = [
  'footer'  =>  'FooterData',
  'hardware'  =>  'HardwareData',
  'load_average'  =>  'LoadData',
  'memory'  =>  'MemoryData',
  'network'  =>  'NetworkData',
  'storage'  =>  'StorageData',
];

$server_info = new \stdClass();

foreach ($parts as $dir => $class) {
    include 'content/'.$dir.'/'.$class.'.php';
    $class_name = 'CurrantPi\\'.$class;
    $data_class = new $class_name;
    $data = $data_class->getData();
    $server_info->$dir = $data;
}

echo json_encode(['server_info' => $server_info]);
