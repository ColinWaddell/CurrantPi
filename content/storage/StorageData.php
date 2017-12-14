<?php

namespace CurrantPi;

class StorageData implements CurrantModule
{
    private $data;

    public function __construct()
    {
        $this->data = $this->prepareData();
    }

    private function getStorageArray()
    {
        /*
         * The commands df -H returns a bunch of useful information
         * about how your connected storage is utilised. The following
         * loops through the output of this data and does different
         * things depending on which column of the table it's on.
         *
         * It's going to be performed twice. First to get everything
         * except the temp storage, and then a second time which
         * only includes the temp storage.
         */

        $df_output = array(2);
        $df_output[0] = shell_exec('df -H -x tmpfs -x devtmpfs');
        $df_output[1] = shell_exec('df -H | grep \'tmpfs\|devtmpfs\|Filesystem\'');

        $df_array = array(2);

        for ($i=0; $i<2; $i++)
        {
            $table_rows = preg_split('/$\R?^/m', $df_output[$i]);
            $table_header = explode(' ', $table_rows[0]);
            $table_rows = array_splice($table_rows, 1);
            $table_header = array_splice($table_header, 0, count($table_header) - 1);

            sort($table_rows);

            $df_array[$i] = array_map(array($this, 'prepareColumns'), $table_rows);
        }

        return $df_array;
    }

    private function prepareData()
    {
        // data object
        $data = new \stdClass();
        $data->storage = $this->getStorageArray();

        return $data;
    }

    private function prepareColumns($row)
    {
        // If names of disks contain spaces (and then lower case char.), still match them as one string
        return array_values(array_filter(preg_split('/(\s+)(?=[^a-zA-Z])/', $row), 'strlen'));
    }

    public function getData()
    {
        return $this->data;
    }
}
