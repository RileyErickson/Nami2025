<?php
/*
 * Copyright 2013 by Jerrick Hoang, Ivy Xing, Sam Roberts, James Cook, 
 * Johnny Coster, Judy Yang, Jackson Moniaga, Oliver Radwan, 
 * Maxwell Palmer, Nolan McNair, Taylor Talmage, and Allen Tucker. 
 * This program is part of RMH Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/**
 * @version March 1, 2012
 * @author Oliver Radwan and Allen Tucker
 */
include_once('dbinfo.php');
include_once(dirname(__FILE__).'/../domain/PersonHours.php');

/*
* searches through the dbPersonHours table for generating reports
*/

function getPersonHours($id){
    $personHours = array();
    $con=connect();
    $query= "SELECT * FROM dbPersonHours WHERE personID = '" . $id ."'";
    $result = mysqli_query($con, $query);
    if(mysqli_num_rows($result) < 1){
        mysqli_close($con);
        return [];
    }
    while($row = mysqli_fetch_assoc($result)){
        $personHours[] = $row;
    }
    mysqli_close($con);
    return $personHours;
}