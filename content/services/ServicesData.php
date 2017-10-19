<?php

namespace CurrantPi;

class ServicesData implements CurrantModule
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function getServiceDetails($service_raw)
    {
        $service = new \stdClass();
        $service->status = substr($service_raw, 0, 6) == " [ + ]" ? "active" : "inactive";
        $service->name = explode('] ', $service_raw)[1];
        return $service;
    }

    private function prepareData()
    {
        $output = shell_exec('service --status-all');

        $services_raw = preg_split ('/$\R?^/m', $output);
        $services = array_map(array($this, 'getServiceDetails'), $services_raw);

        return $services;
    }

    public function getData()
    {
        return $this->data;
    }
}
