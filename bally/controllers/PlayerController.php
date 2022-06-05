<?php

namespace app\controllers;

use app\models\Player;
use app\Router;

class PlayerController
{
    public static function playersShort(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $players = $router->database->getPlayers($keyword);
        $router->renderView('player/playerShort', [
            'players' => $players,
            'keyword' => $keyword
        ]);
    }

    public static function playersFull(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $players = $router->database->getPlayers($keyword);
        $teams = [];
        foreach ($players as $i=>$player)
            {
                $t = $router->database->getTeamById($player["team_id"]);
                array_push($teams,$t);
            }
        $router->renderView('player/index', [
            'teams' => $teams,
            'players' => $players,
            'keyword' => $keyword
        ]);
    }

    public static function create(Router $router)
    {
        $playerData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $playerData['pname'] = $_POST['pname'];
            $playerData['team_id'] = $_POST['team_id'];
            $playerData['goals'] = $_POST['goals'];
            $playerData['position'] = $_POST['position'];

            $player = new Player();
            $player->load($playerData);
            $player->save();
            header('Location: /players');
            exit;
        }
        $router->renderView('player/create', [
            'player' => $playerData
        ]);
    }

    public static function update(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /players');
            exit;
        }
        $playerData = $router->database->getPlayerById($id);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $p = $router->database->getTeamById($_POST["team_id"]);

            if($p == null) {
                header('Location: /players');
                exit;
            }

            $playerData['pname'] = $_POST['pname'];
            $playerData['team_id'] = $_POST['team_id'];
            $playerData['goals'] = $_POST['goals'];
            $playerData['position'] = $_POST['position'];

            $player = new Player();
            $player->load($playerData);
            $player->save();
            header('Location: /players');
            exit;
        }

        $router->renderView('player/update', [
            'player' => $playerData
        ]);
    }

    public static function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /players');
            exit;
        }

        if ($router->database->deletePlayer($id)) {
            header('Location: /players');
            exit;
        }
    }
}