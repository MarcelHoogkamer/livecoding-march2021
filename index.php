<?php
declare(strict_types=1);

session_start();

//include all your model files here
require 'Model/Connection.php';
require 'Model/User.php';
require 'Model/EmptyUser.php';
require 'Model/UserLoader.php';
require 'Controller/UserController.php';
require 'config.php';

//you could write a simple IF here based on some $_GET or $_POST vars, to choose your controller
//this file should never be more than 20 lines of code!

$controller = new UserController();

if(isset($_GET['page']) && $_GET['page'] === 'detail') {
    $controller->detail($_GET, $_POST);
}
elseif(isset($_GET['page']) && $_GET['page'] === 'delete') {
    $controller->delete($_GET, $_POST);
}
elseif(isset($_GET['page']) && $_GET['page'] === 'save') {
    $controller->save($_GET, $_POST);
}
else {
    $controller->overview($_GET, $_POST);
}
// index.php?page=detail&id=5
// index.php?page=delete&id=5
// index.php?page=save&id=5
// index.php?page=save
// index.php



/*
 * User
     * Name
     * Email
     * Age
 */