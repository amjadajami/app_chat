<?php
/**
 * This is the Front Controller.
 * The Front Controller decides which action to run.
 *
 * This particular Front Controller defines a route table, which says
 * which defines which URLs map to which actions.
 *
 * @author Amjad Ajami <amjad.ajami@gmail.com>
 */
require_once 'Controller/SecurityController.php';
require_once 'Controller/UserController.php';


// Define the routes table
$routes = array(
    '/\blogin\b/' => array('SecurityController', 'loginAction'),
    '/\bauthentification\b/' => array('SecurityController', 'authentificationAction'),
    '/\bdashboard\b/' => array('UserController', 'dashboardAction'),
    '/\blogout\b/' => array('SecurityController', 'logoutAction'),
    '/\bchat\b/' => array('UserController', 'chatAction'),
    '/\baddmessage\b/' => array('UserController', 'addmessageAction'),
    '/\brefreshconversation\b/' => array('UserController', 'refreshconversationAction')
);

// Decide which route to run
foreach ($routes as $url => $action) {

    // See if the route matches the current request
    $matches = preg_match($url, $_SERVER['REQUEST_URI'], $params);
    // If it matches...
    if ($matches > 0) {
        // Run this action, passing the parameters.
        $controller = new $action[0];
        $controller->{$action[1]}();
        break;
    }

}


