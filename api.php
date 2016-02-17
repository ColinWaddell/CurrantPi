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
include('lib/ServerData.php');
include('lib/StringHelpers.php');

/*
 * List of content sources
 */
$sources = [
// Directory Name => Name of Class   
  'footer'        => 'FooterData',
  'hardware'      => 'HardwareData',
  'load_average'  => 'LoadAverageData',
  'memory'        => 'MemoryData',
  'network'       => 'NetworkData',
  'storage'       => 'StorageData',
];

function getModule($dir, $class){

  // Load a module as defined in $sources
  include 'content/'.$dir.'/'.$class.'.php';
  $class_name = 'CurrantPi\\'.$class;

  // Instantiate a version of the
  // module, grab its data then
  // append it to $server_info
  $data_class = new $class_name;
  return $data_class->getData();
}

$request_uri = null;
if (filter_has_var(INPUT_SERVER, "REQUEST_URI")) {
  $request_uri = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE);
} else if (isset($_SERVER["REQUEST_URI"])){
  $request_uri = filter_var($_SERVER["REQUEST_URI"], FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE);
}

// non-existing uri's always will load everything
$request_uri  = explode('/', $request_uri);
$sourceKey = $request_uri[2];

/*
 * Use $server_info to accumulate
 * information about the server
 */
$server_info = new \stdClass();

// Get all the variables or only specific; less loading time
if($sourceKey === null || !isset($sources[$sourceKey])){
  foreach ($sources as $dir => $class) {
    $data = getModule($dir, $class);
    $server_info->$dir = $data;
  }
} else {
  $data = getModule($sourceKey, $sources[$sourceKey]);
  $server_info->$sourceKey = $data;
}

/*
 * Return a json formatted copy
 * of the server information.
 */
header('Content-Type: application/json;');
echo json_encode(['server_info' => $server_info]);
