<?php
namespace CurrantPi;

class FooterData implements ServerData
{
  private $data;

  public function __construct()
  {
    $this->data = $this->prepareData();
  }

  private function prepareData()
  {
    /*
     * The array $_SERVER[] contains a bunch of server and execution
     * environment information.
     *
     * Reading /proc/cpuinfo to find out the type of processor this
     * is running on.
     */

    // preparing cpu info
    $name_full = shell_exec('cat /proc/cpuinfo | grep name | head -1');
    $name = explode(': ', $name_full);

    // data object
    $data = new \stdClass();

    $data->webserver = $_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].') - '.$_SERVER['SERVER_SOFTWARE'];
    $data->cpu = $name[1];

    return $data;
  }

  public function getData()
  {
    return $this->data;
  }
}
