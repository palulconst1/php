<?php

namespace app\controllers;

use app\models\Team;
use app\Router;

class TeamController
{
    public static function index(Router $router)
    {
        $keyword = $_GET['search'] ?? '';
        $teams = $router->database->getTeams($keyword);
        $router->renderView('team/index', [
            'teams' => $teams,
            'keyword' => $keyword
        ]);
    }

    public static function create(Router $router)
    {
        $teamData = [

        ];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teamData['tname'] = $_POST['tname'];
            $teamData['country'] = $_POST['country'];
            $teamData['stadium'] = $_POST['stadium'];
            $teamData['abrev'] = $_POST['abrev'];

            $team = new Team();
            $team->load($teamData);
            $team->save();
            header('Location: /teams');
            exit;
        }
        $router->renderView('team/create', [
            'team' => $teamData
        ]);
    }

    public static function update(Router $router)
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /teams');
            exit;
        }
        $teamData = $router->database->getTeamById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $teamData['tname'] = $_POST['tname'];
            $teamData['country'] = $_POST['country'];
            $teamData['stadium'] = $_POST['stadium'];
            $teamData['abrev'] = $_POST['abrev'];

            $team = new Team();
            $team->load($teamData);
            $team->save();
            header('Location: /teams');
            exit;
        }

        $router->renderView('team/update', [
            'team' => $teamData
        ]);
    }

    public static function delete(Router $router)
    {
        $id = $_POST['id'] ?? null;
        if (!$id) {
            header('Location: /teams');
            exit;
        }

        if ($router->database->deleteTeam($id)) {
            header('Location: /teams');
            exit;
        }
    }
}