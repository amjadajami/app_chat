<?php
/**
 * UserService Class
 * Provides access to the "User" database table.
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */
include_once 'config/Connexion.php';
include_once 'model/User.php';
include_once 'model/Conversation.php';

class UserService
{
    private $listuser;
    private $connexion;
    private $user;

    public function __construct()
    {
        $this->connexion = new Connexion();
        $this->user = new User("", "", "", "");

    }

    public function create($user)
    {
        $query = "INSERT INTO user VALUES (NULL ,'" . $user->getUsername() . "','" . $user->getIsConnect() . "','" . $user->getPass() . "')";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        return $this->connexion->getConnextion()->lastInsertId();
    }

    public function authentification($username, $mdp)
    {
        $query = "SELECT * FROM `user` WHERE `username` like '$username' and pass like '$mdp'";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        while ($affichage = $req->fetch(PDO::FETCH_OBJ)) {
            $this->user = new User($affichage->id, $affichage->username, $affichage->pass, $affichage->isConnect);
        }
        return $this->user;
    }

    public function getAll($id)
    {
        $query = "select * from user where id <> $id";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        while ($affichage = $req->fetch(PDO::FETCH_OBJ)) {
            $this->listuser[] = new User($affichage->id, $affichage->username, $affichage->pass, $affichage->isConnect);
        }
        return $this->listuser;
    }

    public function enligne($id)
    {
        $query = "UPDATE user SET isConnect = 1  WHERE id = " . $id;
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
    }

    public function horsligne($id)
    {
        $query = "UPDATE user SET isConnect = 0  WHERE id = " . $id;
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
    }

    public function getByid($id)
    {
        $query = "select * from user where id = $id";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        while ($affichage = $req->fetch(PDO::FETCH_OBJ)) {
            $this->user = new User($affichage->id, $affichage->username, $affichage->pass, $affichage->isConnect);
        }
        return $this->user;
    }
}

?>