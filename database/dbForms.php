<?php
/*
*
*	Form helper for StepVA 2025
*	Percy Miltier
*	
*/

include_once('dbinfo.php');
include_once('dbPersons.php');

function create_application($application, $personID, $reasontobecome, $whyisnowrighttime, $statusinrecoveryjourney, $screenername, $screeningdate) {
	
    $con=connect();
	
	/* temp */
	$query = "SELECT " . $application . "ID FROM db" . $application . " ORDER BY " . $application . "ID LIMIT 1;";
    $result = mysqli_query($con,$query);
	$result = $result->fetch_array();
	if (isset($result[0])) {
		$appID = 1;
	} else {
		$appID = $result[0];
		$appID++;
	}
	
	
	if ($statusinrecoveryjourney != NULL) {
		$query = "INSERT INTO db" . $application . " VALUES ('"
			. $appID . "', '"
			. $reasontobecome . "', '"
			. $whyisnowrighttime . "', '"
			. $statusinrecoveryjourney . "', '"
			. $screenername . "', '"
			. $screeningdate . "');";
	} else {
		$query = "INSERT INTO db" . $application . " VALUES ('"
			. $appID . "', '"
			. $reasontobecome . "', '"
			. $whyisnowrighttime . "', '"
			. $screenername . "', '"
			. $screeningdate . "');";
	}
	
    $result = mysqli_query($con,$query);
	
	update_application_id($personID, $application, $appID);
	
    mysqli_close($con);
}

function get_reasontobecome($id, $application) {
	
	if ($id == 0) {
		return "";
	}
	
	switch ($application) {
		case "F2FApplication":
			$formattedName = "F2F";
			$tableName = "dbf2fapplication";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			$tableName = "dbp2papplication";
			break;
		case "IOOApplication":
			$formattedName = "IOOV";
			$tableName = "dbiooapplication";
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
	$query="SELECT reasonToBecome" . $formattedName . " FROM " . $tableName . " WHERE id='" . $id . "';";
	
	$result = $result->fetch_array();
	
	if (isset($result[0])) {
		$reason = $result[0];
	} else {
		$reason = null;
	}
	
	mysqli_close($con);
	
	return $reason;
}

function get_whyisnowrighttime($id, $application) {
	
	if ($id == 0) {
		return "";
	}
	
	$con=connect();
	$query="SELECT whyIsNowRightTime FROM db" . $application . " WHERE id='" . $id . "';";
	
	$result = $result->fetch_array();
	
	if (isset($result[0])) {
		$why = $result[0];
	} else {
		$why = "";
	}
	
	mysqli_close($con);
	
	return $why;
}

function get_statusinrecoveryjourney($id, $application) {
	
	if ($id == 0) {
		return "";
	}
	
	$con=connect();
	$query="SELECT statusInRecoveryJourney FROM db" . $application . " WHERE id='" . $id . "';";
	
	$result = $result->fetch_array();
	
	if (isset($result[0])) {
		$status = $result[0];
	} else {
		$status = "";
	}
	
	mysqli_close($con);
	
	return $status;
}

function get_screenername($id, $application) {
	
	if ($id == 0) {
		return "";
	}
	
	$con=connect();
	$query="SELECT screenerName FROM db" . $application . " WHERE id='" . $id . "';";
	
	$result = $result->fetch_array();
	
	if (isset($result[0])) {
		$name = $result[0];
	} else {
		$name = "";
	}
	
	mysqli_close($con);
	
	return $name;
}

function get_screeningdate($id, $application) {
	
	if ($id == 0) {
		return " ";
	}
	
	$con=connect();
	$query="SELECT screeningDate FROM db" . $application . " WHERE id='" . $id . "';";
	
	$result = $result->fetch_array();
	
	if (isset($result[0])) {
		$date = $result[0];
	} else {
		$date = "";
	}
	
	mysqli_close($con);
	
	return $date;
}

function update_reasontobecome($id, $application, $reason) {
	
	switch ($application) {
		case "F2FApplication":
			$formattedName = "F2F";
			break;
		case "P2PApplication":
			$formattedName = "P2P";
			break;
		case "IOOApplication":
			$formattedName = "IOO";
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
	$query="UPDATE db" . $application . " SET reasonToBecome" . $formattedName . "= '" . $reason . "' WHERE id='" . $id . "';";
	
	mysqli_close($con);
	
	return $reason;
}

function update_whyisnowrighttime($id, $application, $time) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET whyIsNowRightTime = '" . $time . "' WHERE id='" . $id . "';";
	
	mysqli_close($con);
	
	return $time;
}

function update_statusinrecoveryjourney($id, $application, $status) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET statusInRecoveryJourney = '" . $status . "' WHERE id='" . $id . "';";
	
	mysqli_close($con);
	
	return $status;
}

function update_screenername($id, $application, $name) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screenerName = '" . $name . "' WHERE id='" . $id . "';";
	
	mysqli_close($con);
	
	return $name;
}

function update_screeningdate($id, $application, $date) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screeningDate = '" . $date . "' WHERE id='" . $id . "';";
	
	mysqli_close($con);
	
	return $date;
}

?>