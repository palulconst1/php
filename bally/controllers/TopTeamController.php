<?php

namespace app\controllers;

use app\Router;

class TopTeamController
{
    public static function topTeam(Router $router)
    {
        $homepage = file_get_contents('https://www.frf.ro/recomandate/topul-anului-2021-cele-mai-bune-echipe-din-liga-1/');
        $team = explode('<td>', $homepage );
        $team = explode("</td>",$team[1]);


        $router->renderView('topTeam', [
            'team' => $team[0]

        ]);
    }
}