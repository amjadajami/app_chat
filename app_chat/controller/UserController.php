<?php
/**
 * UserController*
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */
require_once 'model/User.php';
require_once 'model/Conversation.php';
require_once 'service/UserService.php';
require_once 'service/ConversationService.php';

class UserController
{
    public function __construct()
    {
        session_start();
    }

    public function dashboardAction()
    {
        $userConnect = $_SESSION['user'];
        $userService = new UserService();
        $conversationService = new ConversationService();
        $users = $userService->getAll($userConnect->getId());
        $conversations = $conversationService->getAllConvesationsByUser($userConnect->getId());
        $cnx = 0;
        if (isset($_GET['cnx']) && !empty($_GET['cnx'])) {
            $cnx = $_GET['cnx'];
        }
        include 'View/dashboardView.php';
    }

    public function chatAction()
    {
        $userService = new UserService();
        $conversationService = new ConversationService();
        $userConnect = $_SESSION['user'];
        $recepteur_id = $_GET['recepteur'];
        $recepteur = $userService->getByid($recepteur_id);
        $users = $userService->getAll($userConnect->getId());
        $conversation = $conversationService->getConvesation($userConnect->getId(), $recepteur->getId());

        include 'View/chat.php';
    }

    public function addmessageAction()
    {
        $conversationService = new ConversationService();
        $userService = new UserService();
        $recepteur_id = $_POST['recepteur'];
        $emetteur_id = $_POST['emetteur'];
        $message = $_POST['message'];
        $dt = new DateTime();
        $dateMessage = $dt->format('Y-m-d H:i:s');
        $conversationService->create(new Conversation('', $message, $emetteur_id, $recepteur_id, $dateMessage));
        $userConnect = $_SESSION['user'];
        $recepteur = $userService->getByid($recepteur_id);
        $conversation = $conversationService->getConvesation($userConnect->getId(), $recepteur->getId());
        $arr = array();
        foreach ($conversation as $conv) {
            $arr[] = ['id' => $conv->getId(), 'message' => $conv->getMessage(), 'emetteur' => $userService->getByid($conv->getEmetteur())->getUsername(), 'recepteur' => $userService->getByid($conv->getRecepteur())->getUsername(), 'date' => $conv->getDate()];
        }
        echo json_encode($arr);
    }

    public function refreshconversationAction()
    {
        $conversationService = new ConversationService();
        $userService = new UserService();
        $recepteur_id = $_POST['recepteur'];
        $emetteur_id = $_POST['emetteur'];

        $conversation = $conversationService->getConvesation($emetteur_id, $recepteur_id);
        $arr = array();
        foreach ($conversation as $conv) {
            $arr[] = ['id' => $conv->getId(), 'message' => $conv->getMessage(), 'emetteur' => $userService->getByid($conv->getEmetteur())->getUsername(), 'recepteur' => $userService->getByid($conv->getRecepteur())->getUsername(), 'date' => $conv->getDate()];
        }
        echo json_encode($arr);
    }

}

