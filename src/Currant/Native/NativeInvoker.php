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

    /**
     * Gets the hardware information
     * @return array
     */
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

    /**
     * Gets the network information
     * @return array
     */
    public function getNetworkInformation()
    {
        // The array with the hardware information
        $information = array();

        $networkOutput = shell_exec('sh .'.$this->scriptsPath.'/transfer_rate.sh');
        $rates = explode(' ', $networkOutput);

        if(is_array($rates))
        {
            if(isset($rates[0]))
                $information['download'] = StringHelper::pretty_baud($rates[0]);
            if(isset($rates[1]))
                $information['upload'] = StringHelper::pretty_baud($rates[1]);
        }


        return $information;
    }

    /**
     * Gets the loading information
     */
    public function getLoadInformation()
    {
        // The array with the hardware information
        $information = array();

        $loadOutput = shell_exec('uptime');
        $loadAverage = explode(' ', substr($loadOutput, strpos($loadOutput,'load average:')+14));

        if(is_array($loadAverage))
        {
            if(isset($loadAverage[0]))
                $information['oneMinute'] = StringHelper::pretty_load_average($loadAverage[0]);
            if(isset($loadAverage[1]))
                $information['fiveMinutes'] = StringHelper::pretty_load_average($loadAverage[1]);
            if(isset($loadAverage[2]))
                $information['fifteenMinutes'] = StringHelper::pretty_load_average($loadAverage[2]);
        }

        return $information;

    }

    /**
     * Gets the memory information
     */
    public function getMemoryInformation()
    {
        // The array with the hardware information
        $information = array();

        $information['mem_free'] = intval(shell_exec("free -m | awk '/buffers\/cache/ {print $3}'"));
        $information['mem_total'] = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));

        $information['used_act'] = intval(shell_exec("free | awk '/buffers\/cache/ {print $3}'"));
        $information['free'] = intval(shell_exec("free | awk '/Mem/ {print $4}'"));
        $information['buffers'] = intval(shell_exec("free | awk '/Mem/ {print $6}'"));
        $information['cache'] = intval(shell_exec("free | awk '/Mem/ {print $7}'"));
        $information['total_act'] = $information['used_act'] + $information['free']
                                    + $information['buffers'] + $information['cache'];

        $information['free_p'] = (100*($information['free']/$information['total_act']));
        $information['buffers_p'] = (100*($information['buffers']/$information['total_act']));
        $information['cache_p'] = (100*($information['cache']/$information['total_act']));
        $information['used_act_p'] = (100*($information['used_act']/$information['total_act']));

        return $information;
    }
}