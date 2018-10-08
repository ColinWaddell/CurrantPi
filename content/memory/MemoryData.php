<?php

namespace CurrantPi;

class MemoryData implements CurrantModule
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

        $used_act = intval(shell_exec("free | awk '/Mem/ {print $3}'"));
        $free = intval(shell_exec("free | awk '/Mem/ {print $4}'"));
        $buffers = intval(shell_exec("free | awk '/Mem/ {print $6}'"));
        $cache = intval(shell_exec("free | awk '/Mem/ {print $7}'"));
        $total_act = $used_act + $free + $buffers + $cache;

        $free_p = 100 * ($free / $total_act);
        $buffers_p = 100 * ($buffers / $total_act);
        $cache_p = 100 * ($cache / $total_act);
        $used_act_p = 100 * ($used_act / $total_act);

        // data object
        $data = (object) [
            'total' => (object)[
                'pretty' => StringHelpers::prettyMemory($mem_total),
                'actual'=> $total_act,
            ],
            'used' => (object)[
                'pretty' => strval(round($used_act_p, 2)),
                'percentage' => $used_act_p,
                'actual'=> $used_act,
            ],
            'buffers' => (object)[
                'pretty' => strval(round($buffers_p, 2)),
                'percentage' => $buffers_p,
                'actual'=> $buffers,
            ],
            'cache' => (object)[
                'pretty' => strval(round($cache_p, 2)),
                'percentage' => $cache_p,
                'actual'=> $cache,
            ],
            'free' => (object)[
                'pretty' => strval(round($free_p, 2)),
                'percentage' => $free_p,
                'actual'=> $free,
            ]
        ];

        return $data;
    }

    public function getData()
    {
        return $this->data;
    }
}
