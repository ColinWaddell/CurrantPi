<?php
/**
 * IndexController.php
 *
 * @author     Iago Oliveira da Silva
 * @author     Colin Waddell
 * @license    https://opensource.org/licenses/MIT  The MIT License (MIT)
 */

namespace Currant\Native;

use Currant\Helper\StringHelper;



class NativeInvoker
{

    /**
     * The path to the sh scripts
     * @var string
     */
    protected $scriptsPath;

    /**
     * @param $scriptsPath string
     */
    public function __construct($scriptsPath)
    {
        $this->scriptsPath = $scriptsPath;
    }

    public function getHardwareInformation()
    {
        // The array with the hardware information
        $information = array();

        // Temperature Information
        $temperatureShellOutput = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
        $information['temperature'] = intval($temperatureShellOutput)/1000;

        $uptimeOutput = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
        $information['uptime'] = StringHelper::seconds_to_time(intval($uptimeOutput));

        return $information;
    }

}