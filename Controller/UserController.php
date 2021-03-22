<?php
declare(strict_types = 1);

class UserController
{
    private Connection $db;

    public function __construct() {
        $this->db = new Connection;
    }

    public function overview(array $GET, array $POST) {
        $users = UserLoader::getAllUsers($this->db);
        require 'View/User/overview.php';
    }

    public function detail(array $GET, array $POST) {
        $user = UserLoader::getUser($this->db, (int)$GET['id']);
        require 'View/User/detail.php';
    }

    public function save(array $GET, array $POST) {
        if(empty($GET['id'])) {
            //@todo: fix default values
            $user = new EmptyUser();
            $message = 'Your user is created';
            $title = 'Create new user';
        } else {
            $user = UserLoader::getUser($this->db, (int)$GET['id']);
            $message = 'User '. $user->getId() .' is saved';
            $title = 'Edit user '. $user->getName();
        }

        if(!empty($POST['name']) && !empty($POST['email']) && !empty($POST['age'])) {
            if(!empty($GET['id'])) {
                $user->setName($POST['name']);
                $user->setEmail($POST['email']);
                $user->setAge((int)$POST['age']);
            }
            else {
                $user = new User($POST['name'], $POST['email'], (int)$POST['age']);
            }

            $user->save($this->db);

            $_SESSION['message'] = $message;

            header('location: index.php?page=detail&id=' . $user->getId());
            exit;
        }

        require 'View/User/save.php';
    }

    public function delete(array $GET, array $POST) {
        $user = UserLoader::getUser($this->db, (int)$GET['id']);
        $user->delete($this->db);

        $_SESSION['message'] = 'User '. $user->getName() . ' was deleted';

        $this->overview($GET, $POST);

        header('location: index.php');
        exit;
    }
}

/*
 * Create / Edit
 * Detail
 * Overview
 * Delete (redirect to Overview)
 * */