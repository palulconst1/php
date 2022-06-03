<?php

namespace app\models;

use app\Database;

class User
{
    public ?int $id = null;
    public string $username;
    public string $password;
    public int $role;

    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->role = $data['role'];
    }

    public function save()
    {
        $errors = [];


        if (!$this->username) {
            $errors[] = 'Username  is required';
        }

        if (!$this->password) {
            $errors[] = 'Password  is required';
        }

        if (!$this->role) {
            $errors[] = 'Role is required';
        }


        if (empty($errors)) {
            $db = Database::$db;
            $db->createUser($this);
        }
    }


}