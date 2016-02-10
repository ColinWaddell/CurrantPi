<?php

namespace CurrantPi;

class MemoryData implements ServerData
{
  private $data;

  public function __construct()
  {
    $this->data = $this->prepareData();
  }

  private function prepareData()
  {
    /*
     * Check out this page to find out how to understand 
     * the output of the free command:
     *   - http://www.linuxnix.com/find-ram-size-in-linuxunix/
     * 
     * The code below pulls the relevant parts out of 'free'
     * and figures out the percentage used of each.
     *
     * $total_act is a little less than $mem_total as there's
     * some used up by the bootloader that's not available
     * to the system.
     */

    $mem_free = intval(shell_exec("free -m | awk '/buffers\/cache/ {print $3}'"));
    $mem_total = intval(shell_exec("free -m | awk '/Mem/ {print $2}'"));

    $used_act = intval(shell_exec("free | awk '/buffers\/cache/ {print $3}'"));
    $free = intval(shell_exec("free | awk '/Mem/ {print $4}'"));
    $buffers = intval(shell_exec("free | awk '/Mem/ {print $6}'"));
    $cache = intval(shell_exec("free | awk '/Mem/ {print $7}'"));
    $total_act = $used_act + $free + $buffers + $cache;

    $free_p = 100 * ($free / $total_act);
    $buffers_p = 100 * ($buffers / $total_act);
    $cache_p = 100 * ($cache / $total_act);
    $used_act_p = 100 * ($used_act / $total_act);

    // data object
    $data = new \stdClass();

    $data->total = StringHelpers::prettyMemory($mem_total);
    $data->used_percentage = strval(round($used_act_p, 2));
    $data->buffers_percentage = strval(round($buffers_p, 2));
    $data->cache_percentage = strval(round($cache_p, 2));
    $data->free_percentage = strval(round($free_p, 2));

    $data->buffers = $buffers;
    $data->total_act = $total_act;
    $data->buffers_p = $buffers_p;

    $data->cache = $cache;
    $data->cache_p = $cache_p;

    $data->free = $free;
    $data->free_p = $free_p;

    return $data;
  }

  public function getData()
  {
    return $this->data;
  }
}
