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
// $application MUST be formatted like "P2PApplication", "FSGApplication", "F2FApplication", "HFApplication", "IOOVApplication", and "CSGApplication"
function create_application($application, $personID, $reasontobecome, $whyisnowrighttime, $statusinrecoveryjourney, $screenername, $screeningdate) {
	
    $con=connect();
	
	switch ($application) { //necessary to query the reasontobecome variable
		case "F2FApplication":
			$formattedName = "F2F";
			$tableName = "dbf2fapplication";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			$tableName = "dbp2papplication";
			break;
		case "IOOVApplication":
			$formattedName = "IOOV";
			$tableName = "dbioovapplication";
			break;
		case "CSGApplication":
			$formattedName = "CSG";
			$tableName = "dbcsgapplication";
			break;
		case "FSGApplication":
			$formattedName = "FSG";
			$tableName = "dbfsgapplication";
			break;
		case "HFApplication":
			$formattedName = "HF";
			$tableName = "dbhfapplication";
			break;
	}
	
	if ($statusinrecoveryjourney != NULL) {
		$query = "INSERT INTO db" . $application . "(reasonToBecome" . $formattedName . ", whyIsNowRightTime, statusInRecoveryJourney, screenerName, screeningDate, id) VALUES ('"
			. $reasontobecome . "', '"
			. $whyisnowrighttime . "', '"
			. $statusinrecoveryjourney . "', '"
			. $screenername . "', '"
			. $screeningdate . "', '"
			. $personID . "');";
	} else {
		$query = "INSERT INTO db" . $application . "(reasonToBecome" . $formattedName . ", whyIsNowRightTime, screenerName, screeningDate, id)  VALUES ('"
			. $reasontobecome . "', '"
			. $whyisnowrighttime . "', '"
			. $screenername . "', '"
			. $screeningdate . "', '"
			. $personID . "');";
	}
	
    $result = mysqli_query($con,$query);
	
    mysqli_close($con);
}

// returns a user's reason from the corresponding form
function get_reasontobecome($appID, $application) {
	
	if ($appID == "") {
		return "";
	}
	
	switch ($application) { //necessary to query the reasontobecome variable
		case "F2FApplication":
			$formattedName = "F2F";
			$tableName = "dbf2fapplication";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			$tableName = "dbp2papplication";
			break;
		case "IOOVApplication":
			$formattedName = "IOOV";
			$tableName = "dbioovapplication";
			break;
		case "CSGApplication":
			$formattedName = "CSG";
			$tableName = "dbcsgapplication";
			break;
		case "FSGApplication":
			$formattedName = "FSG";
			$tableName = "dbfsgapplication";
			break;
		case "HFApplication":
			$formattedName = "HF";
			$tableName = "dbhfapplication";
			break;
	}
	
	$con=connect();
	$query="SELECT reasonToBecome" . $formattedName . " FROM " . $tableName . " WHERE ". $application . "ID='" . $appID . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$reason = $result[0];
	} else {
		$reason = null;
	}
	
	mysqli_close($con);
	
	return $reason;
}

// returns a user's application ID from the corresponding form
function get_appID($pid, $application) {
	
	$con=connect();
	$query="SELECT " . $application . "ID FROM db" . $application . " WHERE id='" . $pid . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$appid = $result[0];
	} else {
		$appid = 0;
	}
	
	mysqli_close($con);
	
	return $appid;
}

// returns a user's time reason from the corresponding form
function get_whyisnowrighttime($id, $application) {
	
	if ($id == "") {
		return "";
	}
	
	$con=connect();
	$query="SELECT whyIsNowRightTime FROM db" . $application . " WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$why = $result[0];
	} else {
		$why = "";
	}
	
	mysqli_close($con);
	
	return $why;
}

// returns a user's recovery status from the corresponding form
function get_statusinrecoveryjourney($id, $application) {
	
	if ($id == "") {
		return "";
	}
	
	$con=connect();
	$query="SELECT statusInRecoveryJourney FROM db" . $application . " WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$status = $result[0];
	} else {
		$status = "";
	}
	
	mysqli_close($con);
	
	return $status;
}

// returns a user's screener name from the corresponding form
function get_screenername($id, $application) {
	
	if ($id == "") {
		return "";
	}
	
	$con=connect();
	$query="SELECT screenerName FROM db" . $application . " WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$name = $result[0];
	} else {
		$name = "";
	}
	
	mysqli_close($con);
	
	return $name;
}

// returns a user's screening date from the corresponding form
function get_screeningdate($id, $application) {
	
	if ($id == "") {
		return " ";
	}
	
	$con=connect();
	$query="SELECT screeningDate FROM db" . $application . " WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$date = $result[0];
	} else {
		$date = "";
	}
	
	mysqli_close($con);
	
	return $date;
}

// returns the userID of the person who filled out the corresponding application
function get_personID($appID, $application) {
	
	$con=connect();
	$query="SELECT id FROM db" . $application . " WHERE ". $application . "ID='" . $appID . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$pid = $result[0];
	} else {
		$pid = "";
	}
	
	mysqli_close($con);
	
	return $pid;
	
}

// updates a user's reason in the corresponding form, returns the reason 
function update_reasontobecome($id, $application, $reason) {
	
	switch ($application) {
		case "F2FApplication":
			$formattedName = "F2F";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			break;
		case "IOOVApplication":
			$formattedName = "IOOV";
			break;
		case "CSGApplication":
			$formattedName = "CSG";
			break;
		case "FSGApplication":
			$formattedName = "FSG";
			break;
		case "HFApplication":
			$formattedName = "HF";
			break;
	}
	
	$con=connect();
	$query="UPDATE db" . $application . " SET reasonToBecome" . $formattedName . "= '" . $reason . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $reason;
}

// updates a user's time reason in the corresponding form, returns the time reason 
function update_whyisnowrighttime($id, $application, $time) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET whyIsNowRightTime = '" . $time . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $time;
}

// updates a user's recovery status in the corresponding form, returns the recovery status 
function update_statusinrecoveryjourney($id, $application, $status) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET statusInRecoveryJourney = '" . $status . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $status;
}

// updates a user's screener name in the corresponding form, returns the screener name 
function update_screenername($id, $application, $name) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screenerName = '" . $name . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $name;
}

// updates a user's screening date in the corresponding form, returns the screening date 
function update_screeningdate($id, $application, $date) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screeningDate = '" . $date . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $date;
}

?>