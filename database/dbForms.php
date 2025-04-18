<?php
/*
*
*	Form helper for StepVA 2025
*	Percy Miltier
*	
*/

include_once('dbinfo.php');
include_once('dbPersons.php');


// Pulls all created forms in numerical array format
function getForms() {
	
    $con=connect();
	
	$query = "SELECT formname FROM formmanager;";
	
    $result = mysqli_query($con,$query);
	if (!(mysqli_num_rows($result) === 0)) {
		return mysqli_fetch_array($result, MYSQLI_NUM);
	} else {
		return 0;
	}
	
	mysqli_close($con);
	
	return $reason;
}

// Adds an empty form to the database that can be populated with questions
function addForm($formname) {
	
    $con=connect();
	
	$query = "
		CREATE TABLE `" . $formname . "` (
		  `originalID` int NOT NULL,
		  `formname` varchar(50),
		  
		  PRIMARY KEY (originalID)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	";
	
	if (!mysqli_query($con,$query)) {
		return "error";
	} else {
		return "happy";
	}
}

// Adds questions to a Form
function addQuestion($formname, $question) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE `" . $formname . "` (
		  ADD `" . $question . "` varchar(350);
		)
	";
	
	if (!mysqli_query($con,$query)) {
		return "error";
	} else {
		return "happy";
	}
}

// Drops a question from a form
function dropQuestion($formname, $question) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE `" . $formname . "` (
		  DROP COLUMN `" . $question . "`;
		)
	";
	
	if (!mysqli_query($con,$query)) {
		return "error";
	} else {
		return "happy";
	}
}

// Edits a question in a form
function editQuestion($formname, $oldquestion, $newquestion) {
	
    $con=connect();
	
	$query = "
		ALTER TABLE `" . $formname . "` (
		  RENAME COLUMN `" . $oldquestion . "` TO `" . $newquestion . "`;
		)
	";
	
	if (!mysqli_query($con,$query)) {
		return "error";
	} else {
		return "happy";
	}
}

// Deletes a form from the database, this action cannot be reversed
function dropForm($formname) {
	
    $con=connect();
	
	$query = "
		DROP TABLE `" . $formname . "`;
	";
	
	if (!mysqli_query($con,$query)) {
		return "error";
	} else {
		return "happy";
	}
}

?>