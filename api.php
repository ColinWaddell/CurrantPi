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
include('lib/CurrantModule.php');
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

function getModule($dir, $class)
{
    // Load a module as defined in $sources
    include 'content/'.$dir.'/'.$class.'.php';
    $class_name = 'CurrantPi\\'.$class;

    // Instantiate a version of the
    // module, grab its data then
    // append it to $server_info
    $data_class = new $class_name;
    return $data_class->getData();
}

/*
 * Find out the URI which was given
 * in order to access this page.
 * non-existing uri's always will
 * load everything
 */
$request_uri = null;
if (filter_has_var(INPUT_SERVER, "REQUEST_URI")) {
    $request_uri = filter_input(INPUT_SERVER, "REQUEST_URI", FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE);
} elseif (isset($_SERVER["REQUEST_URI"])) {
    $request_uri = filter_var($_SERVER["REQUEST_URI"], FILTER_UNSAFE_RAW, FILTER_NULL_ON_FAILURE);
}

$request_uri  = explode('/', $request_uri);
$sourceRequest = $request_uri[2];

if (empty($sourceRequest)) {
    $modules = array_keys($sources);
} else {
    $modules = explode(',', $sourceRequest);
}

/*
 * Use $server_info to accumulate
 * information about the server
 * Always give an error if one of the modules
 * isn't found for reliance
 */
$server_info = new \stdClass();
$error = null;
// Get all the variables or only specific; less loading time
foreach ($modules as $module) {
    if (!isset($sources[$module])) {
        $error = 'Module \'' . $module . '\' not available';
        break;
    }
    $data = getModule($module, $sources[$module]);
    $server_info->$module = $data;
}

/*
 * Return a json formatted copy
 * of the server information.
 */
header('Content-Type: application/json;');
if ($error) {
    header("HTTP/1.0 400 Error");
    $response = ['error' => $error];
} else {
    $response = ['server_info' => $server_info];
    header("HTTP/1.0 200 OK");
}

echo json_encode($response);
