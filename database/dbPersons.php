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
include_once(dirname(__FILE__).'/../domain/Person.php');
include_once('email.php');
/*
* add a general volunteer
*/
function add_genVol($genVol){
    if (!$genVol instanceof GenVol){
        die('Error: add_genVol type mismatch');
    }
    $con=connect();
    $query = "SELECT * FROM dbpersons WHERE id = '" . $genVol->get_username() . "'";
    $result = mysqli_query($con, $query);
    if($result == null || mysqli_num_rows($result) == 0){
        mysqli_query($con, 'INSERT INTO dbpersons (
            first_name,
            last_name,
            phone1,
            mayText,
            email,
            street_address, 
            city, 
            state,
            zip_code,
            strengths, 
            primaryRole,
            workBest, 
            preferred_feedback_method,
            learningMethod, 
            introOrExtro, 
            familyWithMentalIllness, 
            involvementInNami, 
            interest,
            activePayingNamiAffiliate, 
            ifNotAreWilling, 
            choiceNamiAffiliate, 
            id, 
            password, 
            type, 
            status, 
            archived,
            birthday,
            emergency_contact_first_name,
            emergency_contact_last_name,
            emergency_contact_relation,
            emergency_contact_phone,
            disability_accomodation_needs,
            professional_experience,
            hobbies,
            how_you_heard_of_stepva
            ) 
             VALUES (
                "'. $genVol->get_first_name() .'", 
                "'. $genVol->get_last_name() .'",
                "'. $genVol->get_phone1() .'",
                "'. $genVol->get_may_text() .'",
                "'. $genVol->get_email() .'",
                "'. $genVol->get_street_address() .'",
                "'. $genVol->get_city() .'",
                "'. $genVol->get_state() .'",
                "'. $genVol->get_zip_code() .'",
                "'. $genVol->get_strengths() .'",
                "'. $genVol->get_primary_role() .'",
                "'. $genVol->get_work_best() .'",
                "'. $genVol->get_contact_method() .'",
                "'. $genVol->get_learning_method() .'",
                "'. $genVol->get_introOrExtro() .'",
                "'. $genVol->get_family_with_mental_illness() .'",
                "'. $genVol->get_involvement_in_nami() .'",
                "'. $genVol->get_interest() .'",
                "'. $genVol->get_active_paying_nami_affiliate() .'",
                "'. $genVol->get_if_not_are_willing() .'",
                "'. $genVol->get_choice_nami_affiliate() .'",
                "'. $genVol->get_username() .'",
                "'. $genVol->get_password() .'",
                "participant",
                "pending",
                "0",
                "'. $genVol->get_birthday() .'",
                "'. $genVol->get_emergency_contact_first_name() .'",
                "'. $genVol->get_emergency_contact_last_name() .'",
                "'. $genVol->get_emergency_contact_relation() .'",
                "'. $genVol->get_emergency_contact_phone() .'",
                "'. $genVol->get_disability_accomodation_needs() .'",
                "'. $genVol->get_professional_experience() .'",
                "'. $genVol->get_hobbies() .'",
                "'. $genVol->get_how_you_heard_of_stepva() .'"
                );');
                mysqli_close($con);
                return true;
    }

}

/*
 * add a person to dbPersons table: if already there, return false
 */


function add_person($person) {
    if (!$person instanceof Person)
        die("Error: add_person type mismatch");
    $con=connect();
    $query = "SELECT * FROM dbpersons WHERE id = '" . $person->get_id() . "'";
    $result = mysqli_query($con,$query);
    //if there's no entry for this id, add it
    if ($result == null || mysqli_num_rows($result) == 0) {
        /*mysqli_query($con,'INSERT INTO dbpersons (id, first_name, last_name, birthday, email, password) VALUES("' .
            $person->get_id() . '","' .
            $person->get_first_name() . '","' .
            $person->get_last_name() . '","' .
            $person->get_birthday() . '","' .
            $person->get_email() . '","' .
            $person->get_password() . '");'
        );*/
        mysqli_query($con, 'INSERT INTO dbpersons VALUES ("' .
            $person->get_id() . '","' .
            $person->get_start_date() . '","' .
            "n/a" . '","' . /* ("venue", we don't use this) */
            $person->get_first_name() . '","' .
            $person->get_last_name() . '","' .
            $person->get_street_address() . '","' .
            $person->get_city() . '","' .
            $person->get_state() . '","' .
            $person->get_zip_code() . '","' .
            $person->get_phone1() . '","' .
            $person->get_phone1type() . '","' .
            $person->get_emergency_contact_phone() . '","' .
            $person->get_birthday() . '","' .
            $person->get_email() . '","' .
            $person->get_emergency_contact_first_name() . '","' .
            'n/a' . '","' . /* ("contact_num", we don't use this) */
            $person->get_emergency_contact_relation() . '","' .
            'n/a' . '","' . /* ("contact_method", we don't use this) */
            $person->get_type() . '","' .
            $person->get_status() . '","' .
            'n/a' . '","' . /* ("notes", we don't use this) */
            $person->get_password() . '","' .
            'n/a' . '","' . /* ("profile_pic", we don't use this) */
            'gender' . '","' .
            $person->get_tshirt_size() . '","' .
            $person->get_how_you_heard_of_stepva() . '","' .
            'sensory_sensitivities' . '","' .
            $person->get_disability_accomodation_needs() . '","' .
            $person->get_school_affiliation() . '","' .
            'race' . '","' .
            $person->get_preferred_feedback_method() . '","' .
            $person->get_hobbies() . '","' .
            $person->get_professional_experience() . '","' .
            $person->get_archived() . '","' .
            $person->get_emergency_contact_last_name() . '","' .
            $person->get_photo_release() . '","' .
            $person->get_photo_release_notes() . '","' .
            $person->get_training_complete() . '","' .
            $person->get_training_date() . '","' .
            $person->get_orientation_complete() . '","' .
            $person->get_orientation_date() . '","' .
            $person->get_background_complete() . '","' .
            $person->get_background_date() . '");'
        );
        mysqli_close($con);
        return true;
    }
    mysqli_close($con);
    return false;
}

/*
 * remove a person from dbPersons table.  If already there, return false
 */

function remove_person($id) {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $query = 'DELETE FROM dbpersons WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return true;
}

#participant
function pendingPerson($id) {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE type = "participant"';
    $result = mysqli_query($con,$query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
    $signups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $signups[] = $row;
    }

    mysqli_close($con);
    return $signups;
}

function fetchCurrentVolunteer() {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE type = "volunteer" OR "v"';
    $result = mysqli_query($con,$query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
    $signups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $signups[] = $row;
    }

    mysqli_close($con);
    return $signups;
}

function fetchCurrentBoardMembers() {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE type = "board" OR "board member"';
    $result = mysqli_query($con,$query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
    $signups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $signups[] = $row;
    }

    mysqli_close($con);
    return $signups;
}

function fetchCurrentAdmins() {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE type = "admin" OR "a"';
    $result = mysqli_query($con,$query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
    $signups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $signups[] = $row;
    }

    mysqli_close($con);
    return $signups;
}

function fetchEveryone() {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE id != "vmsroot"';
    $result = mysqli_query($con,$query);

    if (!$result) {
        die('Query failed: ' . mysqli_error($con));
    }
    $signups = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $signups[] = $row;
    }

    mysqli_close($con);
    return $signups;
}

/*
 * @return a Person from dbPersons table matching a particular id.
 * if not in table, return false
 */

function retrieve_person($id) { // (username! not id)
    $con=connect();
    $query = "SELECT * FROM dbpersons WHERE id = '" . $id . "'";
    $result = mysqli_query($con,$query);
    if (mysqli_num_rows($result) !== 1) {
        mysqli_close($con);
        return false;
    }
    $result_row = mysqli_fetch_assoc($result);
    // var_dump($result_row);
    $thePerson = make_a_person($result_row);
//    mysqli_close($con);
    return $thePerson;
}

// Name is first concat with last name. Example 'James Jones'
// return array of Persons.
function retrieve_persons_by_name ($name) {
	$persons = array();
	if (!isset($name) || $name == "" || $name == null) return $persons;
	$con=connect();
	$name = explode(" ", $name);
	$first_name = $name[0];
	$last_name = $name[1];
    $query = "SELECT * FROM dbpersons WHERE first_name = '" . $first_name . "' AND last_name = '". $last_name ."'";
    $result = mysqli_query($con,$query);
    while ($result_row = mysqli_fetch_assoc($result)) {
        $the_person = make_a_person($result_row);
        $persons[] = $the_person;
    }
    return $persons;	
}

function change_password($id, $newPass) {
    $con=connect();
    $query = 'UPDATE dbpersons SET password = "' . $newPass . '" WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function reset_password($id, $newPass) {
    $con=connect();
    $query = 'UPDATE dbpersons SET password = "' . $newPass . '", force_password_change="1" WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function update_hours($id, $new_hours) {
    $con=connect();
    $query = 'UPDATE dbpersons SET hours = "' . $new_hours . '" WHERE id = "' . $id . '"';
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function update_birthday($id, $new_birthday) {
	$con=connect();
	$query = 'UPDATE dbpersons SET birthday = "' . $new_birthday . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

/* update volunteer hours */ /* $original_start_time, $original_end_time,  */
function update_volunteer_hours($eventname, $username, $new_start_time, $new_end_time) {
    $con=connect();
    $eventid = "SELECT id FROM dbevents WHERE name = " . $eventname . '"';
	$query = 'UPDATE dbpersonhours SET start_time = "' . $new_start_time . '", end_time = "' . $new_end_time . ' WHERE eventID = "' . $eventid . '" AND personID = "' . $username . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

/*@@@ Thomas */

/* Check-in a user by adding a new row and with start_time to dbpersonhours */
function check_in($personID, $eventID, $start_time) {
    $con=connect();
    $query = "INSERT INTO dbpersonhours (personID, eventID, start_time) VALUES ( '" .$personID. "', '" .$eventID. "', '" .$start_time. "')";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

/* Check-out a user by adding their end_time to dbpersonhours */
function check_out($personID, $eventID, $end_time) {
    $con=connect();
    $query = "UPDATE dbpersonhours SET end_time = '" . $end_time . "' WHERE eventID = '" .$eventID. "' AND personID = '" .$personID. "' and end_time IS NULL";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

/* Return true if a given user is currently able to check-in to a given event */
function can_check_in($personID, $event_info) {

    if (!(time() > strtotime($event_info['date']) && time() < strtotime($event_info['date']) + 86400)) {
        // event is not ongoing
        return False;
    }

    if (!(check_if_signed_up($event_info['id'], $personID))) {
        // user is not signed up for this event
        return False;
    }

    if (can_check_out($personID, $event_info)) {
        // user is already checked-in
        return False;
    }

    // validation passed
    return True;

}

/* Return true if a user is able to check out from a given event (they have already checked in) */
function can_check_out($personID, $event_info) {
    $con=connect();
    $query = "SELECT * FROM dbpersonhours WHERE personID = '" .$personID. "' AND eventID = '" .$event_info['id']. "' AND end_time IS NULL";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        // user is checked-in and can now check-out
        return True;
    }
    // user cannot current check-out
    return False;
}

/* Return number of seconds a volunteer worked for a specific event */
function fetch_volunteering_hours($personID, $eventID) {
    $con=connect();
    $query = "SELECT start_time, end_time FROM dbpersonhours WHERE personID = '" .$personID. "' AND eventID = '" .$eventID. "' AND end_time IS NOT NULL";
    $result = mysqli_query($con, $query);
    $total_time = 0;

    if ($result) {
        // for each check-in/check-out pair
        while ($row = mysqli_fetch_assoc($result)) {
            $start_time = strtotime($row['start_time']);
            $end_time = strtotime($row['end_time']);
            $total_time += $end_time - $start_time; // add time to total
        }
        return $total_time;
    }
    return -1; // no check-ins found
}


/* Delete a single check-in/check-out pair as defined by the given parameters */
function delete_check_in($userID, $eventID, $start_time, $end_time) {
    $con=connect();
    $query = "DELETE FROM dbpersonhours WHERE personID = '" .$userID. "' AND eventID = '" .$eventID. "' AND start_time = '" .$start_time. "' AND end_time = '" .$end_time. "' LIMIT 1";
    $result = mysqli_query($con, $query);
    mysqli_close($con);
}

/*@@@ end Thomas */


/*
 * Updates the profile picture link of the corresponding
 * id.
*/

function update_profile_pic($id, $link) {
  $con = connect();
  $query = 'UPDATE dbpersons SET profile_pic = "'.$link.'" WHERE id ="'.$id.'"';
  $result = mysqli_query($con, $query);
  mysqli_close($con);
  return $result;
}

/*
 * Returns the age of the person by subtracting the 
 * person's birthday from the current date
*/

function get_age($birthday) {

  $today = date("Ymd");
  // If month-day is before the person's birthday,
  // subtract 1 from current year - birth year
  $age = date_diff(date_create($birthday), date_create($today))->format('%y');

  return $age;
}

function update_start_date($id, $new_start_date) {
	$con=connect();
	$query = 'UPDATE dbpersons SET start_date = "' . $new_start_date . '" WHERE id = "' . $id . '"';
	$result = mysqli_query($con,$query);
	mysqli_close($con);
	return $result;
}

/*
 * @return all rows from dbPersons table ordered by last name
 * if none there, return false
 */

function getall_dbPersons($name_from, $name_to, $venue) {
    $con=connect();
    $query = "SELECT * FROM dbpersons";
    $query.= " WHERE venue = '" .$venue. "'"; 
    $query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'"; 
    $query.= " ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $thePersons = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $thePerson = make_a_person($result_row);
        $thePersons[] = $thePerson;
    }

    return $thePersons;
}

/*
  @return all rows from dbPersons

*/
function getall_volunteers() {
    $con=connect();
    $query = 'SELECT * FROM dbpersons WHERE id != "vmsroot"';
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $thePersons = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $thePerson = make_a_person($result_row);
        $thePersons[] = $thePerson;
    }

    return $thePersons;
}


function getall_volunteer_names() {
	$con=connect();
    $type = "volunteer";
	$query = "SELECT first_name, last_name FROM dbpersons WHERE type LIKE '%" . $type . "%' ";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    $result = mysqli_query($con,$query);
    $names = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
        $names[] = $result_row['first_name'].' '.$result_row['last_name'];
    }
    mysqli_close($con);
    return $names;   	
}

function make_a_person($result_row) {
	/*
	 ($f, $l, $v, $a, $c, $s, $z, $p1, $p1t, $p2, $p2t, $e, $ts, $comp, $cam, $tran, $cn, $cpn, $rel,
			$ct, $t, $st, $cntm, $pos, $credithours, $comm, $mot, $spe,
			$convictions, $av, $sch, $hrs, $bd, $sd, $hdyh, $notes, $pass)
	 */
    $thePerson = new Person(
        $result_row['id'],
        $result_row['password'],
        $result_row['start_date'],
        $result_row['first_name'],
        $result_row['last_name'],
        $result_row['birthday'],
        $result_row['street_address'],
        $result_row['city'],
        $result_row['state'],
        $result_row['zip_code'],
        $result_row['phone1'],
        $result_row['phone1type'],
        $result_row['email'],
        $result_row['emergency_contact_first_name'],
        $result_row['emergency_contact_last_name'],
        $result_row['emergency_contact_phone'],
        $result_row['emergency_contact_phone_type'],
        $result_row['emergency_contact_relation'],
        $result_row['tshirt_size'],
        $result_row['school_affiliation'],
        $result_row['photo_release'],
        $result_row['photo_release_notes'],
        $result_row['type'],
        $result_row['status'],
        $result_row['archived'],
        $result_row['how_you_heard_of_stepva'],
        $result_row['preferred_feedback_method'],
        $result_row['hobbies'],
        $result_row['professional_experience'],
        $result_row['disability_accomodation_needs'],
        $result_row['training_complete'],
        $result_row['training_date'],
        $result_row['orientation_complete'],
        $result_row['orientation_date'],
        $result_row['background_complete'],
        $result_row['background_date'],

        $result_row['strengths'],                   // 37
        $result_row['primaryRole'],                 // 38
        $result_row['workBest'],                    // 39
        $result_row['learningMethod'],              // 40
        $result_row['introOrExtro'],                // 41
        $result_row['familyWithMentalIllness'],     // 42
        $result_row['involvementInNami'],           // 43
        $result_row['interest'],                    // 44
        $result_row['activePayingNamiAffiliate'],   // 45
        $result_row['ifNotAreWilling'],             // 46
        $result_row['choiceNamiAffiliate'],         // 47
        $result_row['mayText']                      // 48
    );

    return $thePerson;
}

function getall_names($status, $type, $venue) {
    $con=connect();
    $result = mysqli_query($con,"SELECT id,first_name,last_name,type FROM dbPersons " .
            "WHERE venue='".$venue."' AND status = '" . $status . "' AND TYPE LIKE '%" . $type . "%' ORDER BY last_name,first_name");
    mysqli_close($con);
    return $result;
}

/*
 * @return all active people of type $t or subs from dbPersons table ordered by last name
 */

function getall_type($t) {
    $con=connect();
    $query = "SELECT * FROM dbpersons WHERE (type LIKE '%" . $t . "%' OR type LIKE '%sub%') AND status = 'active'  ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    if ($result == null || mysqli_num_rows($result) == 0) {
        mysqli_close($con);
        return false;
    }
    //mysqli_close;
    return $result;
}

/*
 *   get all active volunteers and subs of $type who are available for the given $frequency,$week,$day,and $shift
 */

function getall_available($type, $day, $shift, $venue) {
    $con=connect();
    $query = "SELECT * FROM dbpersons WHERE (type LIKE '%" . $type . "%' OR type LIKE '%sub%')" .
            " AND availability LIKE '%" . $day .":". $shift .
            "%' AND status = 'active' AND venue = '" . $venue . "' ORDER BY last_name,first_name";
    $result = mysqli_query($con,$query);
    mysqli_close($con);
    return $result;
}

function getvolunteers_byevent($id){
	 $con = connect();
	 $query = 'SELECT * FROM dbeventpersons JOIN dbpersons WHERE eventID = "' . $id . '"' .
	 			"AND dbeventpersons.userID = dbpersons.id";
	 $result = mysqli_query($con, $query);
	 $thePersons = array();
    while ($result_row = mysqli_fetch_assoc($result)) {
       $thePerson = make_a_person($result_row);
       $thePersons[] = $thePerson;
   }
   mysqli_close($con);
   return $thePersons;
}


// retrieve only those persons that match the criteria given in the arguments
function getonlythose_dbPersons($type, $status, $name, $day, $shift, $venue) {
   $con=connect();
   $query = "SELECT * FROM dbpersons WHERE type LIKE '%" . $type . "%'" .
           " AND status LIKE '%" . $status . "%'" .
           " AND (first_name LIKE '%" . $name . "%' OR last_name LIKE '%" . $name . "%')" .
           " AND availability LIKE '%" . $day . "%'" . 
           " AND availability LIKE '%" . $shift . "%'" . 
           " AND venue = '" . $venue . "'" . 
           " ORDER BY last_name,first_name";
   $result = mysqli_query($con,$query);
   $thePersons = array();
   while ($result_row = mysqli_fetch_assoc($result)) {
       $thePerson = make_a_person($result_row);
       $thePersons[] = $thePerson;
   }
   mysqli_close($con);
   return $thePersons;
}

function phone_edit($phone) {
    if ($phone!="")
		return substr($phone, 0, 3) . "-" . substr($phone, 3, 3) . "-" . substr($phone, 6);
	else return "";
}

function get_people_for_export($attr, $first_name, $last_name, $type, $status, $start_date, $city, $zip, $phone, $email) {
	$first_name = "'".$first_name."'";
	$last_name = "'".$last_name."'";
	$status = "'".$status."'";
	$start_date = "'".$start_date."'";
	$city = "'".$city."'";
	$zip = "'".$zip."'";
	$phone = "'".$phone."'";
	$email = "'".$email."'";
	$select_all_query = "'.'";
	if ($start_date == $select_all_query) $start_date = $start_date." or start_date=''";
	if ($email == $select_all_query) $email = $email." or email=''";
    
	$type_query = "";
    if (!isset($type) || count($type) == 0) $type_query = "'.'";
    else {
    	$type_query = implode("|", $type);
    	$type_query = "'.*($type_query).*'";
    }
    
    error_log("query for start date is ". $start_date);
    error_log("query for type is ". $type_query);
    
   	$con=connect();
    $query = "SELECT ". $attr ." FROM dbpersons WHERE 
    			first_name REGEXP ". $first_name . 
    			" and last_name REGEXP ". $last_name . 
    			" and (type REGEXP ". $type_query .")". 
    			" and status REGEXP ". $status . 
    			" and (start_date REGEXP ". $start_date . ")" .
    			" and city REGEXP ". $city .
    			" and zip REGEXP ". $zip .
    			" and (phone1 REGEXP ". $phone ." or phone2 REGEXP ". $phone . " )" .
    			" and (email REGEXP ". $email .") ORDER BY last_name, first_name";
	error_log("Querying database for exporting");
	error_log("query = " .$query);
    $result = mysqli_query($con,$query);
    return $result;

}

//return an array of "last_name:first_name:birth_date", and sorted by month and day
/*function get_birthdays($name_from, $name_to, $venue) {
	$con=connect();
   	$query = "SELECT * FROM dbpersons WHERE availability LIKE '%" . $venue . "%'" . 
   	//$query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'";
    //$query.= " ORDER BY birthday";
	//$result = mysqli_query($con,$query);
	$thePersons = array();
	while ($result_row = mysqli_fetch_assoc($result)) {
    	$thePerson = make_a_person($result_row);
        $thePersons[] = $thePerson;
	}
   	mysqli_close($con);
   	return $thePersons;
}*/

//return an array of "last_name;first_name;hours", which is "last_name;first_name;date:start_time-end_time:venue:totalhours"
// and sorted alphabetically
function get_logged_hours($from, $to, $name_from, $name_to, $venue) {
	$con=connect();
   	$query = "SELECT first_name,last_name,hours,venue FROM dbpersons "; 
   	$query.= " WHERE venue = '" .$venue. "'";
   	$query.= " AND last_name BETWEEN '" .$name_from. "' AND '" .$name_to. "'";
   	$query.= " ORDER BY last_name,first_name";
	$result = mysqli_query($con,$query);
	$thePersons = array();
	while ($result_row = mysqli_fetch_assoc($result)) {
		if ($result_row['hours']!="") {
			$shifts = explode(',',$result_row['hours']);
			$goodshifts = array();
			foreach ($shifts as $shift) 
			    if (($from == "" || substr($shift,0,8) >= $from) && ($to =="" || substr($shift,0,8) <= $to))
			    	$goodshifts[] = $shift;
			if (count($goodshifts)>0) {
				$newshifts = implode(",",$goodshifts);
				array_push($thePersons,$result_row['last_name'].";".$result_row['first_name'].";".$newshifts);
			}   // we've just selected those shifts that follow within a date range for the given venue
		}
	}
   	mysqli_close($con);
   	return $thePersons;
}

/*
            $person->get_id() . '","' .
            $person->get_start_date() . '","' .
            "n/a" . '","' . /* ("venue", we don't use this) 
            $person->get_first_name() . '","' .
            $person->get_last_name() . '","' .
            $person->get_street_address() . '","' .
            $person->get_city() . '","' .
            $person->get_state() . '","' .
            $person->get_zip_code() . '","' .
            $person->get_phone1() . '","' .
            $person->get_phone1type() . '","' .
            $person->get_emergency_contact_phone() . '","' .
            $person->get_emergency_contact_phone_type() . '","' .
            $person->get_birthday() . '","' .
            $person->get_email() . '","' .
            $person->get_emergency_contact_first_name() . '","' .
            'n/a' . '","' . /* ("contact_num", we don't use this) 
            $person->get_emergency_contact_relation() . '","' .
            'n/a' . '","' . /* ("contact_method", we don't use this) 
            $person->get_type() . '","' .
            $person->get_status() . '","' .
            'n/a' . '","' . /* ("notes", we don't use this) 
            $person->get_password() . '","' .
            'n/a' . '","' . /* ("profile_pic", we don't use this) 
            'gender' . '","' .
            $person->get_tshirt_size() . '","' .
            'how_you_heard_of_stepva' . '","' .
            'sensory_sensitivities' . '","' .
            'disability_accomodation_needs' . '","' .
            $person->get_school_affiliation() . '","' .
            'race' . '","' .
            'preferred_feedback_method' . '","' .
            'hobbies' . '","' .
            'professional_experience' . '","' .
            $person->get_archived() . '","' .
            $person->get_emergency_contact_last_name() . '","' .
            $person->get_photo_release() . '","' .
            $person->get_photo_release_notes() . '");'
*/
    // updates the required fields of a person's account
    function update_person_required(
        $id, $first_name, $last_name, $birthday, $street_address, $city, $state,
        $notes, $zip_code, $email, $phone1, $emergency_contact_first_name,
        $emergency_contact_last_name, $emergency_contact_phone,
        $emergency_contact_relation,
        $how_you_heard_of_stepva,
        $preferred_feedback_method, $hobbies, $professional_experience,
        $disability_accomodation_needs, $training_complete, $training_date, $orientation_complete,
        $orientation_date, $background_complete, $background_date
    ) {
        $query = "update dbpersons set 
            first_name='$first_name', last_name='$last_name', birthday='$birthday',
            street_address='$street_address', city='$city', state='$state', notes='$notes',
            zip_code='$zip_code', email='$email', phone1='$phone1',
            emergency_contact_first_name='$emergency_contact_first_name', 
            emergency_contact_last_name='$emergency_contact_last_name', 
            emergency_contact_phone='$emergency_contact_phone',  
            emergency_contact_relation='$emergency_contact_relation',
            how_you_heard_of_stepva='$how_you_heard_of_stepva', preferred_feedback_method='$preferred_feedback_method',
            hobbies='$hobbies', professional_experience='$professional_experience',
            disability_accomodation_needs='$disability_accomodation_needs',
            training_complete='$training_complete', training_date='$training_date', orientation_complete='$orientation_complete',
            orientation_date='$orientation_date', background_complete='$background_complete', background_date='$background_date'
            WHERE id='$id'";
        $connection = connect();
        $result = mysqli_query($connection, $query);
        mysqli_commit($connection);
        mysqli_close($connection);
        return $result;
    }

    /**
     * Searches the database and returns an array of all volunteers
     * that are eligible to attend the given event that have not yet
     * signed up/been assigned to the event.
     * 
     * Eligibility criteria: availability falls within event start/end time
     * and start date falls before or on the volunteer's start date.
     */
    function get_unassigned_available_volunteers($eventID) {
        $connection = connect();
        $query = "select * from dbEvents where id='$eventID'";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            mysqli_close($connection);
            return null;
        }
        $event = mysqli_fetch_assoc($result);
        $event_start = $event['startTime'];
        $event_end = $event['startTime'];
        $date = $event['date'];
        $dateInt = strtotime($date);
        $dayofweek = strtolower(date('l', $dateInt));
        $dayname_start = $dayofweek . 's_start';
        $dayname_end = $dayofweek . 's_end';
        $query = "select * from dbpersons
            where 
            $dayname_start<='$event_start' and $dayname_end>='$event_end'
            and start_date<='$date'
            and id != 'vmsroot' 
            and status='Active'
            and id not in (select userID from dbEventVolunteers where eventID='$eventID')
            order by last_name, first_name";
        $result = mysqli_query($connection, $query);
        if ($result == null || mysqli_num_rows($result) == 0) {
            mysqli_close($connection);
            return null;
        }
        $thePersons = array();
        while ($result_row = mysqli_fetch_assoc($result)) {
            $thePerson = make_a_person($result_row);
            $thePersons[] = $thePerson;
        }
        mysqli_close($connection);
        return $thePersons;
    }

    function find_users($name, $id, $phone, $zip, $type, $status, $photo_release) {
        $where = 'where ';
        if (!($name || $id || $phone || $zip || $type || $status || $photo_release)) {
            return [];
        }
        $first = true;
        if ($name) {
            if (strpos($name, ' ')) {
                $name = explode(' ', $name, 2);
                $first = $name[0];
                $last = $name[1];
                $where .= "first_name like '%$first%' and last_name like '%$last%'";
            } else {
                $where .= "(first_name like '%$name%' or last_name like '%$name%')";
            }
            $first = false;
        }
        if ($id) {
            if (!$first) {
                $where .= ' and ';
            }
            $where .= "id like '%$id%'";
            $first = false;
        }
        if ($phone) {
            if (!$first) {
                $where .= ' and ';
            }
            $where .= "phone1 like '%$phone%'";
            $first = false;
        }
		if ($zip) {
			if (!$first) {
                $where .= ' and ';
            }
            $where .= "zip like '%$zip%'";
            $first = false;
		}
        if ($type) {
            if (!$first) {
                $where .= ' and ';
            }
            $where .= "type='$type'";
            $first = false;
        }
        if ($status) {
            if (!$first) {
                $where .= ' and ';
            }
            $where .= "status='$status'";
            $first = false;
        }
        if ($photo_release) {
            if (!$first) {
                $where .= ' and ';
            }
            $where .= "photo_release='$photo_release'";
            $first = false;
        }
        $query = "select * from dbpersons $where order by last_name, first_name";
        // echo $query;
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            mysqli_close($connection);
            return [];
        }
        $raw = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $persons = [];
        foreach ($raw as $row) {
            if ($row['id'] == 'vmsroot') {
                continue;
            }
            $persons []= make_a_person($row);
        }
        mysqli_close($connection);
        return $persons;
    }

	function find_user_names($name) {
        $where = 'where ';
        if (!($name)) {
            return [];
        }
        $first = true;
        if ($name) {
            if (strpos($name, ' ')) {
                $name = explode(' ', $name, 2);
                $first = $name[0];
                $last = $name[1];
                $where .= "first_name like '%$first%' and last_name like '%$last%'";
            } else {
                $where .= "(first_name like '%$name%' or last_name like '%$name%')";
            }
            $first = false;
        }
	$query = "select * from dbpersons $where order by last_name, first_name";
        // echo $query;
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            mysqli_close($connection);
            return [];
	}
        $raw = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $persons = [];
        foreach ($raw as $row) {
            if ($row['id'] == 'vmsroot') {
                continue;
            }
            $persons []= make_a_person($row);
        }
        mysqli_close($connection);
        return $persons;
    }

    function update_type($id, $role) {
        $con=connect();
        $query = 'UPDATE dbpersons SET type = "' . $role . '" WHERE id = "' . $id . '"';
        $result = mysqli_query($con,$query);
        mysqli_close($con);
        return $result;
    }
    
    function update_status($id, $new_status){
        $con=connect();
        $query = 'UPDATE dbpersons SET status = "' . $new_status . '" WHERE id = "' . $id . '"';
        $result = mysqli_query($con,$query);
        mysqli_close($con);
        return $result;
    }
    function update_notes($id, $new_notes){
        $con=connect();
        $query = 'UPDATE dbpersons SET notes = "' . $new_notes . '" WHERE id = "' . $id . '"';
        $result = mysqli_query($con,$query);
        mysqli_close($con);
        return $result;
    }

    function get_notes($id){
        $connection = connect();
        $query = 'SELECT notes FROM dbpersons WHERE id="'.$id.'"';
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        return $result;
    }
    
    function get_dbtype($id) {
        $con=connect();
        $query = "SELECT type FROM dbpersons";
        $query.= " WHERE id = '" .$id. "'"; 
        $result = mysqli_query($con,$query);
        mysqli_close($con);
        return $result;
    }
    date_default_timezone_set("America/New_York");

    function get_events_attended_by($personID) {
        $today = date("Y-m-d");
        $query = "select * from dbeventpersons, dbevents
                  where userID='$personID' and eventID=id
                  and date<='$today'
                  order by date asc";
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if ($result) {
            require_once('include/time.php');
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_close($connection);
            foreach ($rows as &$row) {
                $row['duration'] = calculateHourDuration($row['startTime'], $row['endTime']);
            }
            unset($row); // suggested for security
            return $rows;
        } else {
            mysqli_close($connection);
            return [];
        }
    }

    function get_event_from_id($eventID) {
        // Connect to the database
        $connection = connect();
    
        // Escape the eventID to prevent SQL injection
        $eventID = mysqli_real_escape_string($connection, $eventID);
    
        // Prepare the SQL query with the eventID directly
        $query = "SELECT name FROM dbevents WHERE id = '$eventID'";
    
        // Execute the query
        $result = mysqli_query($connection, $query);
    
        // Check if there are results
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            mysqli_close($connection);
    
            return $row['name'];  // Return only the name as a string
        } else {
            mysqli_close($connection);
            return null;  // Return null if there is no result
        }
    }
    

    /* @@@ Thomas
     * 
     * This funcion returns a list of eventIDs that a given user has attended.
     */
    function get_attended_event_ids($personID) {
        $con=connect();
        $query = "SELECT DISTINCT eventID FROM dbpersonhours WHERE personID = '" .$personID. "' ORDER BY eventID DESC";            
        $result = mysqli_query($con, $query);


        if ($result) {
            $rows = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row['eventID']; // Collect only the event IDs
            }
            mysqli_free_result($result);
            mysqli_close($con);
            return $rows;  // Return an array of event IDs
        } else {
            mysqli_close($con);
            return []; // Return an empty array if no results are found
        }
    }

    function get_check_in_outs($personID, $event) {
        $con=connect();
        $query = "SELECT start_time, end_time FROM dbpersonhours WHERE personID = '" .$personID. "' and eventID = '" .$event. "' AND end_time IS NOT NULL";            
        $result = mysqli_query($con, $query);


        if ($result) {
            $row = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row; // Collect only the event IDs
            }
            mysqli_free_result($result);
            mysqli_close($con);
            return $rows;  // Return an array of event IDs
        } else {
            mysqli_close($con);
            return []; // Return an empty array if no results are found
        }
    }
    /*@@@ end Thomas */

    
    function get_events_attended_by_2($personID) {
        // Prepare the SQL query to select rows where personID matches
        $query = "SELECT personID, eventID, start_time, end_time FROM dbpersonhours WHERE personID = ?";
        
        // Connect to the database
        $connection = connect();
        
        // Prepare the statement to prevent SQL injection
        $stmt = mysqli_prepare($connection, $query);
        mysqli_stmt_bind_param($stmt, "s", $personID);
        
        // Execute the query
        mysqli_stmt_execute($stmt);
        
        // Get the result
        $result = mysqli_stmt_get_result($stmt);
        
        // Check if there are results
        if ($result) {
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_close($connection);
    
            return $rows;  // Return the rows as they are from the database
        } else {
            mysqli_close($connection);
            return [];
        }
    }
    
    

    function get_events_attended_by_and_date($personID,$fromDate,$toDate) {
        $today = date("Y-m-d");
        $query = "select * from dbEventVolunteers, dbEvents
                  where userID='$personID' and eventID=id
                  and date<='$toDate' and date >= '$fromDate'
                  order by date desc";
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if ($result) {
            require_once('include/time.php');
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_close($connection);
            foreach ($rows as &$row) {
                $row['duration'] = calculateHourDuration($row['startTime'], $row['endTime']);
            }
            unset($row); // suggested for security
            return $rows;
        } else {
            mysqli_close($connection);
            return [];
        }
    }

    function get_events_attended_by_desc($personID) {
        $today = date("Y-m-d");
        $query = "select * from dbEventVolunteers, dbEvents
                  where userID='$personID' and eventID=id
                  and date<='$today'
                  order by date desc";
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if ($result) {
            require_once('include/time.php');
            $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
            mysqli_close($connection);
            foreach ($rows as &$row) {
                $row['duration'] = calculateHourDuration($row['startTime'], $row['endTime']);
            }
            unset($row); // suggested for security
            return $rows;
        } else {
            mysqli_close($connection);
            return [];
        }
    }

    function get_hours_volunteered_by($personID) {
        $events = get_events_attended_by($personID);
        $hours = 0;
        foreach ($events as $event) {
            $duration = $event['duration'];
            if ($duration > 0) {
                $hours += $duration;
            }
        }
        return $hours;
    }

    function get_hours_volunteered_by_and_date($personID,$fromDate,$toDate) {
        $events = get_events_attended_by_and_date($personID,$fromDate,$toDate);
        $hours = 0;
        foreach ($events as $event) {
            $duration = $event['duration'];
            if ($duration > 0) {
                $hours += $duration;
            }
        }
        return $hours;
    }

    function get_tot_vol_hours($type,$stats,$dateFrom,$dateTo,$lastFrom,$lastTo){
        $con = connect();
        $type1 = "volunteer";
        //$stats = "Active";
        if(($type=="general_volunteer_report" || $type == "total_vol_hours") && ($dateFrom == NULL && $dateTo == NULL && $lastFrom == NULL && $lastTo == NULL)){
	    if ($stats == 'Active' || $stats == 'Inactive') 
            	$query = $query = "SELECT * FROM dbpersons WHERE type='$type1' AND status='$stats'";
            else
            	$query = $query = "SELECT * FROM dbpersons WHERE type='$type1'";
	    $result = mysqli_query($con,$query);
            $totHours = array();
            while($row = mysqli_fetch_assoc($result)){
                $hours = get_hours_volunteered_by($row['id']);
                $totHours[] = $hours;
            }
            $sum = 0;
            foreach($totHours as $hrs){
                $sum += $hrs;
            }
            return $sum;
        }
        elseif(($type=="general_volunteer_report" || $type == "total_vol_hours") && ($dateFrom && $dateTo && $lastFrom && $lastTo)){
            $today = date("Y-m-d");
	    if ($stats == 'Active' || $stats == 'Inactive') 
		$query = "SELECT dbPersons.id,dbPersons.first_name,dbPersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbPersons JOIN dbEventVolunteers ON dbPersons.id = dbEventVolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
                WHERE date >= '$dateFrom' AND date<='$dateTo' AND dbPersons.status='$stats' GROUP BY dbPersons.first_name,dbPersons.last_name
                ORDER BY Dur";            
	    else
                $query = "SELECT dbPersons.id,dbPersons.first_name,dbPersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbPersons JOIN dbEventVolunteers ON dbPersons.id = dbEventVolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
		WHERE date >= '$dateFrom' AND date<='$dateTo'
		GROUP BY dbPersons.first_name,dbPersons.last_name
                ORDER BY Dur";
                $result = mysqli_query($con,$query);
                try {
                    // Code that might throw an exception or error goes here
                    $dd = getBetweenDates($dateFrom, $dateTo);
                    $nameRange = range($lastFrom,$lastTo);
                    $bothRange = array_merge($dd,$nameRange);
                    $dateRange = @fetch_events_in_date_range_as_array($dateFrom, $dateTo)[0];
                    $totHours = array();
                    while($row = mysqli_fetch_assoc($result)){
                        foreach ($bothRange as $both){
                            if(in_array($both,$dateRange) && in_array($row['last_name'][0],$nameRange)){
                                $hours = $row['Dur'];   
                                $totHours[] = $hours;
                            }
                        }
                    }
                    $sum = 0;
                    foreach($totHours as $hrs){
                        $sum += $hrs;
                    }
                } catch (TypeError $e) {
                    // Code to handle the exception or error goes here
                    echo "No Results found!"; 
                }
                return $sum; 
            }
            elseif(($type == "general_volunteer_report" ||$type == "total_vol_hours") && ($dateFrom && $dateTo && $lastFrom == NULL  && $lastTo == NULL)){
	    if ($stats == 'Active' || $stats == 'Inactive') 
                $query = $query = "SELECT dbPersons.id,dbPersons.first_name,dbPersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbPersons JOIN dbEventVolunteers ON dbPersons.id = dbEventVolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
		WHERE date >= '$dateFrom' AND date<='$dateTo' AND dbPersons.status='$stats' GROUP BY dbPersons.first_name,dbPersons.last_name
                ORDER BY Dur";
	    else
		$query = $query = "SELECT dbPersons.id,dbPersons.first_name,dbPersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbPersons JOIN dbEventVolunteers ON dbPersons.id = dbEventVolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
                WHERE date >= '$dateFrom' AND date<='$dateTo'
		GROUP BY dbPersons.first_name,dbPersons.last_name
                ORDER BY Dur";
                $result = mysqli_query($con,$query);
                try {
                    // Code that might throw an exception or error goes here
                    $dd = getBetweenDates($dateFrom, $dateTo);
                    $dateRange = @fetch_events_in_date_range_as_array($dateFrom, $dateTo)[0];
                    $totHours = array();
                    while($row = mysqli_fetch_assoc($result)){
                        foreach ($dd as $date){
                            if(in_array($date,$dateRange)){
                                $hours = $row['Dur'];   
                                $totHours[] = $hours;
                            }
                        }
                    }
                    $sum = 0;
                    foreach($totHours as $hrs){
                        $sum += $hrs;
                    }
                }catch (TypeError $e) {
                    // Code to handle the exception or error goes here
                    echo "No Results found!"; 
                }
                return $sum;
            }
            elseif(($type == "general_volunteer_report" ||$type == "total_vol_hours") && ($dateFrom == NULL && $dateTo ==NULL && $lastFrom && $lastTo)){
	    if ($stats == 'Active' || $stats == 'Inactive') 
		$query = "SELECT dbpersons.id,dbPersons.first_name,dbPersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbpersons JOIN dbEventVolunteers ON dbPersons.id = dbEventVolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
                WHERE dbpersons.status='$stats'
		GROUP BY dbpersons.first_name,dbpersons.last_name
                ORDER BY Dur";
	    else
		$query = "SELECT dbpersons.id,dbpersons.first_name,dbpersons.last_name, SUM(HOUR(TIMEDIFF(dbEvents.endTime, dbEvents.startTime))) as Dur
                FROM dbpersons JOIN dbeventvolunteers ON dbpersons.id = dbeventvolunteers.userID
                JOIN dbEvents ON dbEventVolunteers.eventID = dbEvents.id
                GROUP BY dbpersons.first_name,dbpersons.last_name
                ORDER BY Dur";
                //$query = "SELECT * FROM dbpersons WHERE dbpersons.status='$stats'";
                $result = mysqli_query($con,$query);
                $nameRange = range($lastFrom,$lastTo);
                $totHours = array();
                while($row = mysqli_fetch_assoc($result)){
                    foreach ($nameRange as $a){
                        if($row['last_name'][0] == $a){
                            $hours = get_hours_volunteered_by($row['id']);   
                            $totHours[] = $hours;
                        }
                    }
                }
                $sum = 0;
                foreach($totHours as $hrs){
                    $sum += $hrs;
                }
                return $sum;
            }
    }

    function remove_profile_picture($id) {
        $con=connect();
        $query = 'UPDATE dbpersons SET profile_pic="" WHERE id="'.$id.'"';
        $result = mysqli_query($con,$query);
        mysqli_close($con);
        return True;
    }

    function get_name_from_id($id) {
        if ($id == 'vmsroot') {
            return 'System';
        }
        $query = "select first_name, last_name from dbpersons
            where id='$id'";
        $connection = connect();
        $result = mysqli_query($connection, $query);
        if (!$result) {
            return null;
        }

        $row = mysqli_fetch_assoc($result);
        mysqli_close($connection);
        return $row['first_name'] . ' ' . $row['last_name'];
    }



    function get_email($where) {
        $con=connect();
        $query = "SELECT email FROM dbpersons WHERE ". $where;            
        $result = mysqli_query($con, $query);

        if ($result) {
            $row = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $rows[] = $row; // Collect only the event IDs
            }
            if (isset($rows)){
                mysqli_free_result($result);
                mysqli_close($con);
                return $rows;  
            }
            return null;
// Return an array of event IDs
        } else {
            mysqli_close($con);
            return []; // Return an empty array if no results are found
        }
    }
	
	
	function get_application_id($id, $application) {
        $con=connect();
        $query = "SELECT " . $application . "ID FROM dbpersons WHERE id='" . $id . "';";            
        $result = mysqli_query($con, $query);
		
		$result = $result->fetch_array();
		$appID = $result[0];
		
		mysqli_close($con);
		
		return $appID;
		
	}

    function approved_volunteer_application($id){
        $connection = connect();
        //$query = 'UPDATE dbpersons SET type="volunteer" WHERE id="'.$id.'"';
        //modify account does not like status not being set already 
        //should be safe to assume a new account is active
        //$query = 'UPDATE dbpersons SET type="volunteer", status="Active" WHERE id="' . $id . '"';
        $query = 'UPDATE dbpersons 
                SET type="volunteer", 
                status="Active", 
                start_date=CURDATE() 
                WHERE id="' . $id . '"';
        $result = mysqli_query($connection, $query);
        $result = boolval($result);
        $query  = 'SELECT email FROM dbpersons WHERE id="' . $id . '"';
        $emailresult = mysqli_query($connection, $query);       

        $data   = mysqli_fetch_assoc($emailresult);
        $email  = $data['email'];
        if($result){
            if(!sendApproval($email,$id)){
                $result = false;
            }
        }
        mysqli_close($connection);
        return $result;
    }

    function denied_volunteer_application($id){
        $connection = connect();

        $query = 'DELETE FROM dbpersons WHERE id="'.$id.'"';
        $result = mysqli_query($connection, $query);
        $result = boolval($result);
        mysqli_close($connection);
        return $result;

    }