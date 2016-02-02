<?php

namespace CurrantPi;

class LoadData implements ServerData
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function prepareData()
    {
        /*
         * The command uptime returns a bunch of information about how long
         * the system has been running and the load on the processor. Read
         * more about this information here
         *   - http://www.computerhope.com/unix/uptime.htm
         */

        $output = shell_exec('uptime');
        $loadavg = explode(' ', substr($output, strpos($output, 'load average:') + 14));

        // data object
        $data = new \stdClass();

        $data->one_min = $loadavg[0];
        $data->five_mins = $loadavg[1];
        $data->fifteen_mins = $loadavg[2];

        return $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
