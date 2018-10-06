<?php
/**
 * ConversationService Class
 * Provides access to the "Conversation" database table.
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */
include_once 'config/Connexion.php';
include_once 'model/User.php';
include_once 'model/Conversation.php';

class ConversationService
{
    private $listConversation;
    private $connexion;
    private $conversation;

    public function __construct()
    {
        $this->connexion = new Connexion();
        $this->conversation = new Conversation("", "", "", "", "");

    }

    public function create($conversation)
    {
        $query = "INSERT INTO conversation VALUES (NULL ,'" . $conversation->getMessage() . "','" . $conversation->getEmetteur() . "','" . $conversation->getRecepteur() . "','" . $conversation->getDate() . "')";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
    }

    public function getAllConvesationsByUser($id)
    {
        $query = "SELECT * from conversation WHERE id in ( SELECT MAX(id) FROM conversation WHERE emetteur_id = $id GROUP BY conversation.recepteur_id )";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        while ($affichage = $req->fetch(PDO::FETCH_OBJ)) {
            $this->listConversation[] = new Conversation($affichage->id, $affichage->message, $affichage->emetteur_id, $affichage->recepteur_id, $affichage->date);
        }
        return $this->listConversation;
    }

    public function getConvesation($emetteurId, $recepteurId)
    {
        $query = "SELECT * from conversation where (conversation.emetteur_id = $emetteurId or conversation.recepteur_id = $emetteurId) and (conversation.emetteur_id = $recepteurId or conversation.recepteur_id = $recepteurId) ORDER by conversation.date ASC";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute();
        while ($affichage = $req->fetch(PDO::FETCH_OBJ)) {
            $this->listConversation[] = new Conversation($affichage->id, $affichage->message, $affichage->emetteur_id, $affichage->recepteur_id, $affichage->date);
        }
        return $this->listConversation;
    }
}

?>