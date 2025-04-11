<?php
/*
*
*	Form helper for StepVA 2025
*	Percy Miltier
*	
*/

include_once('dbinfo.php');
include_once('dbPersons.php');


// Creates a new application for any of the 6 form tables.
// $application MUST be formatted like "p2papplication", "fsgapplication", "f2fapplication", "hfapplication", "ioovapplication", and "csgapplication"

function getForms() {
	
    $con=connect();
	
	$query = "SELECT formname FROM formmanager;";
	
    $result = mysqli_query($con,$query);
	if (!(mysqli_num_rows($result) === 0)) {
		return mysqli_fetch_array($result, MYSQLI_NUM);
	} else {
		return 0;
	}
}

?>