<?php

namespace app\models;

use app\Database;

class Game
{
    public ?int $id = null;
    public int $home_id;
    public int $away_id;
    public string $game_day;
    public int $home_score;
    public int $away_score;

    public function load($data)
    {
        $this->id = $data['id'] ?? null;
        $this->home_id = $data['home_id'];
        $this->away_id = $data['away_id'];
        $this->game_day = $data['game_day'];
        $this->home_score = $data['home_score'];
        $this->away_score = $data['away_score'];

    }

    public function save()
    {
        $errors = [];

        if (!$this->home_id) {
            $errors[] = 'Home team is required';
        }

        if (!$this->away_id) {
            $errors[] = 'Away team is required';
        }

        if (!$this->game_day) {
            $errors[] = 'Game day is required';
        }

        if (!$this->home_score) {
            $errors[] = 'Home score is required';
        }

        if (!$this->away_score) {
            $errors[] = 'Away score is required';
        }

        if (empty($errors)) {


            $db = Database::$db;
            if ($this->id) {
                $db->updateGame($this);
            } else {
                $db->createGame($this);
            }

        }
    }
}