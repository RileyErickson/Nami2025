<?php
/*
 * Copyright 2013 by Allen Tucker. 
 * This program is part of RMHC-Homebase, which is free software.  It comes with 
 * absolutely no warranty. You can redistribute and/or modify it under the terms 
 * of the GNU General Public License as published by the Free Software Foundation
 * (see <http://www.gnu.org/licenses/ for more information).
 * 
 */

/*
 * Created on Mar 28, 2008
 * @author Oliver Radwan <oradwan@bowdoin.edu>, Sam Roberts, Allen Tucker
 * @version 3/28/2008, revised 7/1/2015
 */
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
// ONLY REQUIRED FIELDS HAVE BEEN ADDED SO FAR.
class Person {

	private $access_level; // normal user = 1, admin = 2, superadmin = 3
	
	// REQUIRED FIELDS
	private $id; // (username)
	private $password;
	private $start_date; // (dete of account creation)
	private $first_name;
	private $last_name;
	private $birthday;
	private $street_address;
	private $city;
	private $state;
    private $notes;
	private $zip_code;
	private $phone1;
	private $phone1type;
	private $email;
	private $emergency_contact_first_name;
	private $emergency_contact_last_name;
	private $emergency_contact_phone;
	private $emergency_contact_phone_type;
	private $emergency_contact_relation;
	private $tshirt_size;
	private $school_affiliation;
	private $photo_release;
	private $photo_release_notes;
	private $type; // admin or volunteer or participant...
	private $status;
	private $archived;

	// TRAINING REQS
	private $training_complete;
	private $training_date;
	private $orientation_complete;
	private $orientation_date;
	private $background_complete;
	private $background_date;

	// OPTIONAL FIELDS
	private $how_you_heard_of_stepva;
    private $preferred_feedback_method;
    private $hobbies;
    private $professional_experience;
    private $disability_accomodation_needs;

    private $strengths;
    private $primary_role;
    private $work_best;
    private $learning_method;
    private $introOrExtro;
    private $family_with_mental_illness;
    private $involvement_in_nami;
    private $interest;
    private $active_paying_nami_affiliate;
    private $if_not_are_willing;
    private $choice_nami_affiliate;
    private $may_text;

	

	/*
	 * This is a temporary mini constructor for testing purposes. It will be expanded later.
	 */
	function __construct(
						$id, $password, $start_date, $first_name, $last_name, $birthday, $street_address, $city,
						$state, $zip_code, $phone1, $phone1type, $email, $emergency_contact_first_name,
						$emergency_contact_last_name, $emergency_contact_phone, $emergency_contact_phone_type,
						$emergency_contact_relation, $tshirt_size, $school_affiliation, $photo_release, $photo_release_notes, $type, $status, $archived,
						$how_you_heard_of_stepva, $preferred_feedback_method, $hobbies, $professional_experience, $disability_accomodation_needs, 
						$training_complete, $training_date, $orientation_complete,
						$orientation_date, $background_complete, $background_date, $strengths,
                        $primary_role, $work_best, $learning_method, $introOrExtro, $family_with_mental_illness, $involvement_in_nami,
                        $interest, $active_paying_nami_affiliate, $if_not_are_willing, $choice_nami_affiliate, $may_text
						) {
		$this->id = $id; // (username)
		$this->password = $password;
		$this->start_date = $start_date; // (dete of account creation)
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->birthday = $birthday;
		$this->street_address = $street_address;
		$this->city = $city;
		$this->state = $state;
		$this->zip_code = $zip_code;
		$this->phone1 = $phone1;
		$this->phone1type = $phone1type;
		$this->email = $email;
		$this->emergency_contact_first_name = $emergency_contact_first_name;
		$this->emergency_contact_last_name = $emergency_contact_last_name;
		$this->emergency_contact_phone = $emergency_contact_phone;
		$this->emergency_contact_phone_type = $emergency_contact_phone_type;
		$this->emergency_contact_relation = $emergency_contact_relation;
		$this->tshirt_size = $tshirt_size;
		$this->school_affiliation = $school_affiliation;
		$this->photo_release = $photo_release;
		$this->photo_release_notes = $photo_release_notes;
		$this->type = $type; // volunteer or participant...
		$this->status = $status;
		$this->archived = $archived;
		$this->how_you_heard_of_stepva = $how_you_heard_of_stepva;
		$this->preferred_feedback_method = $preferred_feedback_method;
		$this->hobbies = $hobbies;
		$this->professional_experience = $professional_experience;
		$this->disability_accomodation_needs = $disability_accomodation_needs;
		$this->training_complete = $training_complete;
        $this->training_date = $training_date;
		$this->orientation_complete = $orientation_complete;
        $this->orientation_date = $orientation_date;
		$this->background_complete = $background_complete;
        $this->background_date = $background_date;
        $this->strengths = $strengths;
        $this->primary_role = $primary_role;
        $this->work_best = $work_best;
        $this->learning_method = $learning_method;
        $this->introOrExtro = $introOrExtro;
        $this->family_with_mental_illness = $family_with_mental_illness;
        $this->involvement_in_nami = $involvement_in_nami;
        $this->interest = $interest;
        $this->active_paying_nami_affiliate = $active_paying_nami_affiliate;
        $this->if_not_are_willing = $if_not_are_willing;
        $this->choice_nami_affiliate = $choice_nami_affiliate;
        $this->may_text = $may_text;
        $this->start_date = $start_date;

		// access_level = 1 for users, and = 3 for admin
		if ($type == 'admin' ) {
			$this->access_level = 3;
            //debug_to_console('admin test');
		}

        elseif ($type == 'board'){
            $this->access_level = 2;
			//needed to change to 4 for index.php to render correctly since admin is 3+ and boardmembers are admin 
            //debug_to_console('board test');
        }

        elseif ($type == 'volunteer' || $type == 'v'){
            $this->access_level = 1;
            //debug_to_console('vol test');
        }


        else {
			$this->access_level = 0;
            //debug_to_console('else test');
		}
	}



	function get_id() {
		return $this->id;
	}

	function get_password() {
		return $this->password;
	}

	function get_start_date() {
		return $this->start_date;
	}

	function get_first_name() {
		return $this->first_name;
	}

	function get_last_name() {
		return $this->last_name;
	}

	function get_birthday() {
		return $this->birthday;
	}

	function get_street_address() {
		return $this->street_address;
	}

	function get_city() {
		return $this->city;
	}

	function get_state() {
		return $this->state;
	}

	function get_zip_code() {
		return $this->zip_code;
	}

	function get_phone1() {
		return $this->phone1;
	}

	function get_phone1type() {
		return $this->phone1type;
	}

	function get_email() {
		return $this->email;
	}

	function get_emergency_contact_first_name() {
		return $this->emergency_contact_first_name;
	}

	function get_emergency_contact_last_name() {
		return $this->emergency_contact_last_name;
	}

	function get_emergency_contact_phone() {
		return $this->emergency_contact_phone;
	}

	function get_emergency_contact_phone_type() {
		return $this->emergency_contact_phone_type;
	}

	function get_emergency_contact_relation() {
		return $this->emergency_contact_relation;
	}

	function get_tshirt_size() {
		return $this->tshirt_size;
	}

	function get_school_affiliation() {
		return $this->school_affiliation;
	}

	function get_photo_release() {
		return $this->photo_release;
	}

	function get_photo_release_notes() {
		return $this->photo_release_notes;
	}

    function get_notes() {
        return $this->notes;
    }

	function get_type() {
		return $this->type;
	}

	function get_status() {
		return $this->status;
	}

	function get_archived() {
		return $this->archived;
	}

	function get_access_level() {
		return $this->access_level;
	}

	function get_how_you_heard_of_stepva() {
		return $this->how_you_heard_of_stepva;
	}

	function get_preferred_feedback_method() {
		return $this->preferred_feedback_method;
	}

	function get_hobbies() {
		return $this->hobbies;
	}

	function get_professional_experience() {
		return $this->professional_experience;
	}

	function get_disability_accomodation_needs() {
		return $this->disability_accomodation_needs;
	}

	function get_training_complete() {
        return $this->training_complete;
    }

    function get_training_date() {
        return $this->training_date;
    }

	function get_orientation_complete() {
		return $this->orientation_complete;
	}
	
	function get_orientation_date() {
		return $this->orientation_date;
	}
	
	function get_background_complete() {
		return $this->background_complete;
	}
	
	function get_background_date() {
		return $this->background_date;
	}

    function get_strengths() {
        return $this->strengths;
    }

    function get_primary_role(){
        return $this->primary_role;
    }

    function get_work_best(){
        return $this->work_best;
    }

    function get_learning_method(){
        return $this->learning_method;
    }

    function get_introOrExtro(){
        return $this->introOrExtro;
    }

    function get_family_with_mental_illness(){
        return $this->family_with_mental_illness;
    }

    function get_involvement_in_nami(){
        return $this->involvement_in_nami;
    }

    function get_interest(){
        return $this->interest;
    }

    function get_active_paying_nami_affiliate(){
        return $this->active_paying_nami_affiliate;
    }

    function get_if_not_are_willing(){
        return $this->if_not_are_willing;
    }

    function get_choice_nami_affiliate(){
        return $this->choice_nami_affiliate;
    }

    function get_may_text(){
        return $this->may_text;
    }

}