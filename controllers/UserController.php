<?php

namespace app\controllers;

use app\Database;
use app\models\User;
use app\Router;

class UserController
{
    public static function create(Router $router)
    {
        $userData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $user = $router->database->getUserByUsername($_POST['username']);

            if($user) {
                header('Location: /register_fail');
                exit;
            }
            
            $userData['username'] = $_POST['username'];
            $userData['password'] = sha1($_POST['password']);
            $userData['role'] = 1;

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

    public static function register_success(Router $router)
    {
        $router->renderView('user/register_success', [
        ]);
    }

    public static function register_fail(Router $router)
    {
        $router->renderView('user/register_fail', [
        ]);
    }

    public static function login_user(Router $router)
    {

        $userData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $role = $router->database->getUserByUsername($_POST['username']);

            if(!$role) {
                header('Location: /user/login');
                exit;
            }

            $userData['username'] = $_POST['username'];
            $userData['password'] = $_POST['password'];
            $userData['role'] = $role['role'];

            $user = new User();
            $user->load($userData);
            $logged = $router->database->validateUser($user->username,sha1($user->password));

            if($logged) {
                session_start();
                $_SESSION['valid_user'] = array("username"=>$user->username,"role"=>$user->role);

                header('Location: /login_success');
            }
            else
            {
                var_dump($logged);
                header('Location: /user/login');
            }

            header('Location: /login_success');
            exit;
        }
        $router->renderView('user/login', [
            'user' => $userData
        ]);


    }

    public static function login_success(Router $router)
    {
        $router->renderView('user/login_success', [
        ]);
    }



}