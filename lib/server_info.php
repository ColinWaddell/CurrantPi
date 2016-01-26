<?php

$server_info = [];

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

$server_info = [
    'webserver' => $_SERVER['SERVER_NAME'].' ('.$_SERVER['SERVER_ADDR'].') - '.$_SERVER['SERVER_SOFTWARE'],
    'cpu' => $name[1],
];

/*
 * Using the onboard temperature sensor and the command 'uptime'
 * to pull in information about how hot the Raspberry Pi is and
 * how long it's been switched on for.
 */

$output = shell_exec('cat /sys/class/thermal/thermal_zone0/temp');
$temp = round(($output) / 1000, 1);

$output = shell_exec('echo "$(</proc/uptime awk \'{print $1}\')"');
$time_alive = seconds_to_time(intval($output));

$server_info['temperature'] = $temp;
$server_info['uptime'] = $time_alive;

/*
 * The command uptime returns a bunch of information about how long
 * the system has been running and the load on the processor. Read
 * more about this information here
 *   - http://www.computerhope.com/unix/uptime.htm
 */

$output = shell_exec('uptime');
$loadavg = explode(' ', substr($output, strpos($output, 'load average:') + 14));

$server_info['load_average'] = [
    '1 min' => $loadavg[0],
    '5 min' => $loadavg[1],
    '15 min' => $loadavg[2],
];

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

$server_info['memory'] = [
    'total' => pretty_memory($mem_total),
    'used_percentage' => strval(round($used_act_p, 2)),
    'buffers_percentage' => strval(round($buffers_p, 2)),
    'cache_percentage' => strval(round($cache_p, 2)),
    'free_percentage' => strval(round($free_p, 2)),
];

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

$server_info['network'] = [
    'down'  => pretty_baud($rates[0]),
    'up'    => pretty_baud($rates[1]),
];

/*
 * The commands df -H returns a bunch of useful information
 * about how your connected storage is utilised. The following
 * loops through the output of this data and does different
 * things depending on which column of the table it's on.
 */

$output = shell_exec('df -H');
$table_rows = preg_split('/$\R?^/m', $output);
$table_header = explode(' ', $table_rows[0]);
$table_rows = array_splice($table_rows, 1);
$table_header = array_splice($table_header, 0, count($table_header) - 1);

function prepare_columns($row)
{
    return array_values(array_filter(explode(' ', $row), 'strlen'));
}

$server_info['storage'] = array_map('prepare_columns', $table_rows);
