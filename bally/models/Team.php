<?php

namespace app\models;

use app\Database;

class Team
{
    public ?int $id = null;
    public string $tname;
    public string $country;
    public string $stadium;
    public string $abrev;


    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->tname = $data['tname'];
        $this->country = $data['country'];
        $this->stadium = $data['stadium'];
        $this->abrev = $data['abrev'];
    }

    public function save()
    {
        $errors = [];

        if (!$this->tname) {
            $errors[] = 'Team name is required';
        }

        if (!$this->country) {
            $errors[] = 'Homeland is required';
        }

        if (!$this->stadium) {
            $errors[] = 'Home training ground is required';
        }

        if (!$this->abrev) {
            $errors[] = 'Abreviation price is required';
        }

        if (empty($errors)) {


            $db = Database::$db;
            if ($this->id) {
                $db->updateTeam($this);
            } else {
                $db->createTeam($this);
            }
        }
    }
}
