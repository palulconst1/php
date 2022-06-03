<?php

namespace app\models;

use app\Database;

class Player
{
    public ?int $id = null;
    public int $team_id;
    public string $pname;
    public int $goals;
    public string $position;

    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->team_id = $data['team_id'];
        $this->pname = $data['pname'];
        $this->goals = $data['goals'];
        $this->position = $data['position'];

    }

    public function save()
    {
        $errors = [];

        if (!$this->team_id) {
            $errors[] = 'Team is required';
        }

        if (!$this->pname) {
            $errors[] = 'Name is required';
        }

        if (!$this->goals) {
            $errors[] = 'Goals is required';
        }

        if (!$this->position) {
            $errors[] = 'Position is required';
        }

        if (empty($errors)) {


            $db = Database::$db;
            if ($this->id) {
                $db->updatePlayer($this);
            } else {
                $db->createPlayer($this);
            }

        }
    }
}