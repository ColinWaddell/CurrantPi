<?php

namespace CurrantPi;

class StorageData implements ServerData
{
  private $data;

  public function __construct()
  {
    $this->data = $this->prepareData();
  }

  private function prepareData()
  {
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

    // data object
    $data = new \stdClass();

    $data->storage = array_map(array($this, 'prepareColumns'), $table_rows);

    return $data;
  }

  private function prepareColumns($row)
  {
    return array_values(array_filter(explode(' ', $row), 'strlen'));
  }

  public function getData()
  {
    return $this->data;
  }
}
