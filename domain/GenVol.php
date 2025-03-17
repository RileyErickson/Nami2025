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
    private $access_level;


// this is a constructor for building a person based on application
    function __construct(
                    $first_name, $last_name, $phone1, $contact_method, $email, 
                    $street_address, $city, $state, $zip_code, $strengths, 
                    $primary_role, $work_best, $learning_method, $introOrExtro,
                    $family_with_mental_illness, $involvement_in_nami,
                    $interest, $active_paying_nami_affiliate, $if_not_are_willing,
                    $choice_nami_affiliate, $username, $password
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
    }
}