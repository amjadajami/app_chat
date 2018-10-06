<?php
/**
 * SecurityController
 *
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */
require_once 'model/User.php';
require_once 'service/UserService.php';

class SecurityController
{
    public function __construct()
    {
        session_start();
    }

    public function loginAction()
    {
        if (!isset($_SESSION['token'])) {
            $token = md5(uniqid(rand(), TRUE));
            $_SESSION['token'] = $token;
            $_SESSION['token_time'] = time();
        } else {
            $token = $_SESSION['token'];
        }
        include 'View/loginView.php';

    }

    public function authentificationAction()
    {
        if (!empty($_POST['token'])) {
            if (hash_equals($_SESSION['token'], $_POST['token'])) {
                $username = $_POST['username'];
                $Password = $_POST['mdp'];
                $userService = new UserService();
                $user = new User("", "", "", "");
                $Password = sha1($Password);
                $user = $userService->authentification($username, $Password);
                if ($user->getId() != "") {
                    $_SESSION['user'] = $user;
                    $userService->enligne($user->getId());
                    header('Location: http://localhost/testmvc/index.php/dashboard');
                } else {
                    $userid = $userService->create(new User('', $username, $Password, 1));
                    $_SESSION['user'] = $userService->getByid($userid);
                    header('Location: http://localhost/testmvc/index.php/dashboard?cnx=1');
                }

            } else {
                header('Location: http://localhost/testmvc/index.php/login');
            }
        } else {
            header('Location: http://localhost/testmvc/index.php/login');
        }
    }

    public function logoutAction()
    {
        if (!empty($_SESSION['user'])) {
            $userService = new UserService();
            $userService->horsligne($_SESSION['user']->getId());
        }
        session_destroy();
        header('Location: http://localhost/testmvc/index.php/login');

    }


}

