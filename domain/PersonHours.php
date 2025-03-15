<?php
// dbPersonHours entry

class PersonHours{
    private $id;
    private $eventID;
    private $startEnd;
    private $totalHours;

    private $personHours;

    function __construct($id, $eventID, $startEnd, $totalHours){
        $this->id=$id;
        $this->eventID=$eventID;
        $this->startEnd=$startEnd;
        $this->totalHours=$totalHours;
        $this->personHours = [];
    }

    function getPersonHours(){
        return $this->personHours;
    }
    /*
    function getId(){
        return $this->id;
    }

    function getEventID(){
        return $this->eventID;
    }

    function getStartEnd(){
        return $this->startEnd;
    }

    function getTotalHours(){
        return $this->totalHours;
    }
        */
}