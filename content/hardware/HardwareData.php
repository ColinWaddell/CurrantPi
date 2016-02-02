<?php

namespace CurrantPi;

class HardwareData implements ServerData
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function prepareData()
    {
        /*
         * Using the onboard temperature sensor and the command 'uptime'
         * to pull in information about how hot the Raspberry Pi is and
         * how long it's been switched on for.
         */

        $output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
        $temp = round(($output) / 1000, 1);

        $output = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
        $time_alive = seconds_to_time(intval($output));

        // data object
        $data = new \stdClass();

        $data->temperature = $temp;
        $data->uptime = $time_alive;

        return $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
