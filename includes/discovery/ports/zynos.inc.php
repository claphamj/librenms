<?php
/*
 * This program is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by the
 * Free Software Foundation, either version 3 of the License, or (at your
 * option) any later version.  Please see LICENSE.txt at the top level of
 * the source code distribution for details.
 * @author     LukeKelsall <l.kelsall@b4rn.org.uk>
 */

//Logically convert swp ports to human readable
function swpConvert($port) {
    //only convert swp ports
    if (substr( $port, 0, 3 ) === "swp") {
        $portNum = preg_replace('/[a-z]+/', '', $port);
        if ( $portNum < 50 ) { 
            $portNum++;
            //Leading 0 for single digits
            if ($portNum < 10) {
                $newNum = "1/0" . $portNum;
            } else {
                $newNum = "1/" . $portNum;
            }
        }   
        if ( $portNum > 63 && $portNum < 128) {
            $portNum = $portNum - 63;
            //Leading 0 for single digits
            if ($portNum < 10) {
                $newNum = "2/0" . $portNum;
            } else {
                $newNum = "2/" . $portNum;
            }
        }   
        if ( $portNum > 127 && $portNum < 192) {
            $portNum = $portNum - 127;
            //Leading 0 for single digits
            if ($portNum < 10) {
                $newNum = "3/0" . $portNum;
            } else {
                $newNum = "3/" . $portNum;
            }
        }   
        if ($portNum > 191) {
            $portNum = $portNum - 191;
            //Leading 0 for single digits
            if ($portNum < 10) {
                $newNum = "4/0" . $portNum;
            } else {
                $newNum = "4/" . $portNum;
            }
        }   
        return $newNum;
    }
}

//loop through ports
foreach ($port_stats as $index => $port) {
    // Make ifDescr match zyxel port using swpConvert function

    //current port name:
    $portIfName = $port['ifName'];

    //new varible with new port name
    $ifDescr = swpConvert($portIfName);

    //set the libre ifDescr value to new port name
    $port_stats[$index]['ifDescr'] = $ifDescr;
    $port_stats[$index]['ifName'] = $ifDescr;
}
