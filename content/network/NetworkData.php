<?php

namespace CurrantPi;

class NetworkData implements CurrantModule
{
    /* If you have a wireless adaptor on your Pi
       that you'd prefer to monitor replace the
       interface below with 'wlan0'             */
    public $interface = 'eth0';

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

        $output = shell_exec('sh ./lib/transfer_rate.sh ' . $this->interface);
        $rates = explode(' ', $output);

        $ip_address = shell_exec("ip addr show " . $this->interface . " | grep 'inet\b' | awk '{print $2}' | cut -d/ -f1");
        $subnet_mask = shell_exec("ip addr show " . $this->interface . " | grep 'inet\b' | awk '{print $2}' | cut -d/ -f2");

        // data object
        $data = new \stdClass();

        $data->down = StringHelpers::prettyBaud($rates[0]);
        $data->up = StringHelpers::prettyBaud($rates[1]);

        $data->ip_address = trim($ip_address);
        $data->subnet_mask = $subnet_mask;

        return $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
