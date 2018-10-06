<?php
/**
 * User Class
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */

class User  {
    private $id;
    private $username;
    private $pass;
    private $isConnect;

    function __construct($id ,$username, $pass , $isConnect = 0) {
        $this->id = $id;;
        $this->username = $username;;
        $this->pass = $pass;
        $this->isConnect = $isConnect;
    }

    function getId() {
        return $this->id;
    }
    function getUsername() {
        return $this->username;
    }
    function getPass() {
        return $this->pass;
    }
    function setUsername($username) {
        $this->username = $username;
    }

    function setPass($pass) {
        $this->pass = $pass;
    }
    function setIsConnect($isConnect) {
        $this->isConnect = $isConnect;
    }
    function getIsConnect() {
        return $this->isConnect;
    }

}