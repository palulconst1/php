<?php

namespace app\controllers;

use app\Database;
use app\models\User;
use app\Router;

class UserController
{
    public function create(Router $router)
    {
        $userData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['username'] = $_POST['username'];
            $userData['password'] = sha1($_POST['password']);
            $userData['role'] = $_POST['role'];

            $user = new User();
            $user->load($userData);
            $user->save();
            header('Location: /register_success');
            exit;
        }
        $router->renderView('user/create', [
            'user' => $userData
        ]);
    }

    public function register_success(Router $router)
    {
        $router->renderView('user/register_success', [
        ]);
    }

    public function login_user(Router $router)
    {

        $userData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userData['username'] = $_POST['username'];
            $userData['password'] = $_POST['password'];
            $userData['role'] = $_POST['role'];

            $user = new User();
            $user->load($userData);
            $users = $router->database->validateUser($user->username,sha1($user->password));

            if($users) {
                session_start();
                $_SESSION['valid_user'] = array("username"=>$user->username,"role"=>$users[0]->role);

                header('Location: /login_success');
            }
            else
            {
                var_dump($users);
                header('Location: /user/login');
            }

            header('Location: /register_success');
            exit;
        }
        $router->renderView('user/login', [
            'user' => $userData
        ]);


    }

    public function login_success(Router $router)
    {
        $router->renderView('user/login_success', [
        ]);
    }



}