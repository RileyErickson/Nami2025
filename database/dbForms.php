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

function get_reasontobecome($appID, $application) {
	
	if ($appID == "") {
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
	$query="UPDATE db" . $application . " SET reasonToBecome" . $formattedName . "= '" . $reason . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $reason;
}

function update_whyisnowrighttime($id, $application, $time) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET whyIsNowRightTime = '" . $time . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $time;
}

function update_statusinrecoveryjourney($id, $application, $status) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET statusInRecoveryJourney = '" . $status . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $status;
}

function update_screenername($id, $application, $name) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screenerName = '" . $name . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $name;
}

function update_screeningdate($id, $application, $date) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screeningDate = '" . $date . "' WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $date;
}

?>