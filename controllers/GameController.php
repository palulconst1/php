<?php

namespace app\controllers;

use app\models\Game;
use app\Router;

class GameController
{
    public static function gamesShort(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $games = $router->database->getGames($keyword);

        $router->renderView('game/gamesShort', [
            'games' => $games,
            'keyword' => $keyword
        ]);
    }

    public static function gamesFull(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $games = $router->database->getGames($keyword);
        $teams1 = [];
        $teams2 = [];
        foreach ($games as $i=>$game)
            {
                $g1 = $router->database->getTeamById($game["home_id"]);
                $g2 = $router->database->getTeamById($game["away_id"]);
                array_push($teams1,$g1);
                array_push($teams2,$g2);
            }
        $router->renderView('game/index', [
            'teams1' => $teams1,
            'teams2' => $teams2,
            'games' => $games,
            'keyword' => $keyword
        ]);
    }

    public static function create(Router $router)
    {
        $gameData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $g1 = $router->database->getTeamById($_POST["home_id"]);
            $g2 = $router->database->getTeamById($_POST["away_id"]);

            if($g1 == null || $g2 == null) {
                header('Location: /games');
                exit;
            }

            $gameData['home_id'] = $_POST['home_id'];
            $gameData['away_id'] = $_POST['away_id'];
            $gameData['game_day'] = $_POST['game_day'];
            $gameData['home_score'] = $_POST['home_score'];
            $gameData['away_score'] = $_POST['away_score'];
            $game = new Game();
            $game->load($gameData);
            $game->save();
            header('Location: /games');
            exit;
        }
        $router->renderView('game/create', [
            'game' => $gameData
        ]);
    }

    public static function update(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /games');
            exit;
        }
        $gameData = $router->database->getGameById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $g1 = $router->database->getTeamById($_POST["home_id"]);
            $g2 = $router->database->getTeamById($_POST["away_id"]);

            if($g1 == null || $g2 == null) {
                header('Location: /games');
                exit;
            }

            $gameData['home_id'] = $_POST['home_id'];
            $gameData['away_id'] = $_POST['away_id'];
            $gameData['game_day'] = $_POST['game_day'];
            $gameData['home_score'] = $_POST['home_score'];
            $gameData['away_score'] = $_POST['away_score'];;

            $game = new Game();
            $game->load($gameData);
            $game->save();
            header('Location: /games');
            exit;
        }

        $router->renderView('game/update', [
            'game' => $gameData
        ]);
    }

    public static function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /games');
            exit;
        }

        if ($router->database->deleteGame($id)) {
            header('Location: /games');
            exit;
        }
    }
}