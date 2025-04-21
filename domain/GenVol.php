<?php
/*
*   Basic builder for a general volunteer application
*/
class GenVol{
    private $first_name;
    private $last_name;
    private $phone1;
    private $contact_method;
    private $email;
    private $street_address;
    private $city;
    private $state;
    private $zip_code;
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
    private $username;
    private $password;
    private $may_text;
    private $access_level;

    private $start_date;


// this is a constructor for building a person based on application
    function __construct(
                    $first_name, $last_name, $phone1, $contact_method, $email, 
                    $street_address, $city, $state, $zip_code, $strengths, 
                    $primary_role, $work_best, $learning_method, $introOrExtro,
                    $family_with_mental_illness, $involvement_in_nami,
                    $interest, $active_paying_nami_affiliate, $if_not_are_willing,
                    $choice_nami_affiliate, $username, $password, $may_text, $start_date
                    ){
        $this->access_level = 0;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone1 = $phone1;
        $this->contact_method = $contact_method;
        $this->email = $email;
        $this->street_address = $street_address;
        $this->city = $city;
        $this->state = $state;
        $this->zip_code = $zip_code;
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
        $this->username = $username;
        $this->password = $password;
        $this->may_text = $may_text;
        $this->start_date = $start_date;
    }

    // the getters for the general volunteer
    function get_first_name(){
        return $this->first_name;
    }
    
    function get_last_name(){
        return $this->last_name;
    }
    function get_phone1(){
        return $this->phone1;
    }
    function get_contact_method(){
        return $this->contact_method;
    }
    
    function get_email(){
        return $this->email;
    }
    
    function get_street_address(){
        return $this->street_address;
    }
    
    function get_city(){
        return $this->city;
    }

    function get_state(){
        return $this->state;
    }
    
    function get_zip_code(){
        return $this->zip_code;
    }
    
    function get_strengths(){
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
    function get_username(){
        return $this->username;
    }

    function get_password(){
        return $this->password;
    }

    function get_may_text(){
        return $this->may_text;
    }

    function get_start_date(){
        return $this->start_date;
    }

}