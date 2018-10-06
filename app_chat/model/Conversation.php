<?php
/**
 * Conversation Class
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */

class Conversation  {
    private $id;
    private $message;
    private $emetteur ;
    private $recepteur;
    private $date;

    function __construct($id ,$message , $emetteur ,$recepteur ,$date) {
        $this->id = $id;;
        $this->message = $message;;
        $this->emetteur = $emetteur;;
        $this->recepteur = $recepteur;
        $this->date = $date;

    }

    function getId() {
        return $this->id;
    }
    function getMessage() {
        return $this->message;
    }
    function setMessage($message) {
        $this->message = $message;
    }
    function getEmetteur() {
        return $this->emetteur;
    }
    function setEmetteur($emetteur) {
        $this->emetteur = $emetteur;
    }
    function getRecepteur() {
        return $this->recepteur;
    }
    function setRecepteur($recepteur) {
        $this->recepteur = $recepteur;
    }
    function getDate() {
        return $this->date;
    }
    function setDate($date) {
        $this->date = $date;
    }
}