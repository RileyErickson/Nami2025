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
function create_application($application, $personID, $reasontobecome, $whyisnowrighttime, $statusinrecoveryjourney, $screenername, $screeningdate) {
	
    $con=connect();
	
	switch ($application) { //necessary to query the reasontobecome variable
		case "f2fapplication":
			$formattedName = "f2f";
			$tableName = "dbf2fapplication";
			break;
		case "p2papplication":
			$formattedName = "p2p";
			$tableName = "dbp2papplication";
			break;
		case "ioovapplication":
			$formattedName = "ioov";
			$tableName = "dbioovapplication";
			break;
		case "csgapplication":
			$formattedName = "csg";
			$tableName = "dbcsgapplication";
			break;
		case "fsgapplication":
			$formattedName = "fsg";
			$tableName = "dbfsgapplication";
			break;
		case "hfapplication":
			$formattedName = "hf";
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
		case "f2fapplication":
			$formattedName = "f2f";
			$tableName = "dbf2fapplication";
			break;
		case "p2papplication":
			$formattedName = "p2p";
			$tableName = "dbp2papplication";
			break;
		case "ioovapplication":
			$formattedName = "ioov";
			$tableName = "dbioovapplication";
			break;
		case "csgapplication":
			$formattedName = "csg";
			$tableName = "dbcsgapplication";
			break;
		case "fsgapplication":
			$formattedName = "fsg";
			$tableName = "dbfsgapplication";
			break;
		case "hfapplication":
			$formattedName = "hf";
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

function get_all($type){
	if ($type == "F2F"){
		$database = "dbf2fapplication";
	}
	if ($type == "P2P"){
		$database = "dbp2papplication";
	}
	if ($type == "IOOV"){
		$database = "dbioovapplication";
	}
	if ($type == "CSG"){
		$database = "dbcsgapplication";
	}
	if ($type == "FSG"){
		$database = "dbfsgapplication";
	}
	if ($type == "HF"){
		$database = "dbhfapplication";
	}
	$query="SELECT * FROM ". $database;
	$con=connect();
	$result = mysqli_query($con,$query);
	return $result;
}

function approve_form($id, $type){
	if ($type == "F2F" || $type == "f2f"){
		$database = "dbf2fapplication";
		$application="f2fapplication";
	}
	if ($type == "P2P"|| $type == "p2p"){
		$database = "dbp2papplication";
		$application="p2pApplication";
	}
	if ($type == "IOOV"|| $type == "ioov"){
		$database = "dbioovapplication";
		$application="ioovapplication";
	}
	if ($type == "CSG" || $type == "csg"){
		$database = "dbcsgapplication";
		$application="csgapplication";
	}
	if ($type == "FSG" || $type == "fsg" ){
		$database = "dbfsgapplication";
		$application="fsgapplication";
	}
	if ($type == "HF" || $type == "hf"){
		$database = "dbhfapplication";
		$application="hfapplication";
	}
//	$query="UPDATE db" . $database . " SET reasonToBecome" . $formattedName . "= '" . $reason . "' WHERE ". $application . "ID='" . $id . "';";
$query = "UPDATE ".$database." SET approved='TRUE' WHERE ".$application."ID=". $id.";";
	$con=connect();
	mysqli_query($con,$query);
	mysqli_close($con);
	return;
}
function unapprove_form($id, $type){
	if ($type == "F2F" || $type == "f2f"){
		$database = "dbf2fapplication";
		$application="f2fapplication";
	}
	if ($type == "P2P"|| $type == "p2p"){
		$database = "dbp2papplication";
		$application="p2papplication";
	}
	if ($type == "IOOV"|| $type == "ioov"){
		$database = "dbioovapplication";
		$application="ioovapplication";
	}
	if ($type == "CSG" || $type == "csg"){
		$database = "dbcsgapplication";
		$application="csgapplication";
	}
	if ($type == "FSG" || $type == "fsg" ){
		$database = "dbfsgapplication";
		$application="fsgapplication";
	}
	if ($type == "HF" || $type == "hf"){
		$database = "dbhfapplication";
		$application="hfapplication";
	}
//	$query="UPDATE db" . $database . " SET reasonToBecome" . $formattedName . "= '" . $reason . "' WHERE ". $application . "ID='" . $id . "';";
	$query = "UPDATE ". $database ." SET approved='R' WHERE ".$application."id=".$id.";";
	$con=connect();
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return;
}


function get_forms_id($type,$status){
	//We should be passed the abbreviation of one of the forms. If it is one of them, add it to the Database variable. All of the databases have their own
	//name for the id variable, so save that to Select.
	if ($type == "f2f"){
		$database = "dbf2fapplication";
		$select = "f2fapplicationID";
	}
	if ($type == "p2p"){
		$database = "dbp2papplication";
		$select = "p2papplicationID";
	}
	if ($type == "ioov"){
		$database = "dbioovapplication";
		$select = "ioovapplicationID";
	}
	if ($type == "csg"){
		$database = "dbcsgapplication";
		$select = "csgapplicationID";
	}
	if ($type == "fsg"){
		$database = "dbfsgapplication";
		$select = "fsgapplicationID";
	}
	if ($type == "hf"){
		$database = "dbhfapplication";
		$select = "hfapplicationID";
	}
	if ($status == "approved"|| $status == "Approved"){
		$statusFormatted="TRUE";
	}
	else if ($status == "pending"|| $status == "Pending"){
		$statusFormatted="0";
	}
	else if ($status == "denied" || $status == "Denied"){
		$statusFormatted="R";
	}

	//Pull from the database using connect() and mysqli_query(). Should be all ints.
	if (isset($statusFormatted)){
		$query="SELECT * FROM ". $database." WHERE approved=\"".$statusFormatted."\"";
	}
	else{
		$query="SELECT * FROM ". $database;
	}
	$con=connect();
	$result = mysqli_query($con,$query);
	//Make the results a list. If there is a size of 0, return null.

	if (!$result) {
		mysqli_close($connection);
		return [];
	}
	$raw = mysqli_fetch_all($result, MYSQLI_ASSOC);
	$count = mysqli_query($con, "SELECT COUNT(*) FROM ".$database);
	$forms = [$count];
	$x = 0;
	foreach ($raw as $row) {
				$forms []= $row;
		$x = $x+1;
	}
	mysqli_close($con);
	
	return $raw;
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
		case "f2fapplication":
			$formattedName = "f2f";
			break;
		case "p2papplication":
			$formattedName = "p2p";
			break;
		case "ioovapplication":
			$formattedName = "ioov";
			break;
		case "csgapplication":
			$formattedName = "csg";
			break;
		case "fsgapplication":
			$formattedName = "fsg";
			break;
		case "hfapplication":
			$formattedName = "hf";
			break;
	}
	
	$con=connect();
	$query="UPDATE db" . $application . " SET reasonToBecome" . $formattedName . "= '" . $reason . "', APPROVED=0 WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $reason;
}

// updates a user's time reason in the corresponding form, returns the time reason 
function update_whyisnowrighttime($id, $application, $time) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET whyIsNowRightTime = '" . $time . "', APPROVED=0 WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $time;
}

// updates a user's recovery status in the corresponding form, returns the recovery status 
function update_statusinrecoveryjourney($id, $application, $status) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET statusInRecoveryJourney = '" . $status . "', APPROVED=0 WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $status;
}

// updates a user's screener name in the corresponding form, returns the screener name 
function update_screenername($id, $application, $name) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screenerName = '" . $name . "', APPROVED=0 WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $name;
}

// updates a user's screening date in the corresponding form, returns the screening date 
function update_screeningdate($id, $application, $date) {
	
	$con=connect();
	$query="UPDATE db" . $application . " SET screeningDate = '" . $date . "', APPROVED=0 WHERE ". $application . "ID='" . $id . "';";
	
    $result = mysqli_query($con,$query);
	
	mysqli_close($con);
	
	return $date;
}

// updates a user's screening date in the corresponding form, returns the screening date 
function isFormOpen($application) {
	
	switch ($application) {
		case "f2fapplication":
			$formattedName = "f2f";
			break;
		case "p2papplication":
			$formattedName = "p2p";
			break;
		case "ioovapplication":
			$formattedName = "ioov";
			break;
		case "csgapplication":
			$formattedName = "csg";
			break;
		case "fsgapplication":
			$formattedName = "fsg";
			break;
		case "hfapplication":
			$formattedName = "hf";
			break;
	}
	
	$con=connect();
	$query="SELECT isopen FROM dbformmanagement WHERE application='" . $formattedName . "';";
	
    $result = mysqli_query($con,$query);
	
	if (!(mysqli_num_rows($result) === 0)) {
		$result = $result->fetch_array();
		$open = $result[0];
	} else {
		$open = 0;
	}
	
	mysqli_close($con);
	
	return $open;
}

?>