#!/bin/bash

INTERFACE=eth0

P1_rx=`cat /sys/class/net/${INTERFACE}/statistics/rx_bytes`
P1_tx=`cat /sys/class/net/${INTERFACE}/statistics/tx_bytes`
sleep 1;
P2_rx=`cat /sys/class/net/${INTERFACE}/statistics/rx_bytes`
P2_tx=`cat /sys/class/net/${INTERFACE}/statistics/tx_bytes`
echo `expr  $P2_rx - $P1_rx` `expr  $P2_tx - $P1_tx` 
