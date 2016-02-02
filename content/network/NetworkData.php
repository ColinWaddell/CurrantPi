<?php

namespace CurrantPi;

class NetworkData implements ServerData
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function prepareData()
    {
        /*
         * There is a custom script alongside this project called 'uptime'
         * which figures out the amount of data going through the network
         * in the past second. This script takes one second to execute so
         * will delay the loading of the page accordingly.
         *
         * Also using one of the scripts in lib/string_helpers.php to
         * print the network speed in either b/s, Kb/s or Gb/s.
         */

        $output = shell_exec('sh ./lib/transfer_rate.sh');
        $rates = explode(' ', $output);

        // data object
        $data = new \stdClass();

        $data->down = pretty_baud($rates[0]);
        $data->up = pretty_baud($rates[1]);

        return $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
