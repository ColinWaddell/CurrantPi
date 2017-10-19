<?php

namespace CurrantPi;

class ServicesData implements CurrantModule
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function prepareData()
    {
        $output = shell_exec('service --status-all');
        return $output;
    }

    public function getData()
    {
        return $this->data;
    }
}
