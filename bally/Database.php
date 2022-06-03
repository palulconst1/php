<?php

namespace app;

use app\models\Team;
use app\models\Game;
use app\models\Player;
use app\models\User;
use PDO;
require 'Global.php';

# Prevenire atacuri : Pentru a preveni SQL Injection am folosit PDO ( statementuri cu prepare , parserul nu interpreteaza DOAR data )


class Database
{
    public $pdo = null;
    public static ?Database $db = null;

    public function __construct()
    {
        // $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        // $cleardb_server = $cleardb_url["host"];
        // $cleardb_username = $cleardb_url["user"];
        // $cleardb_password = $cleardb_url["pass"];
        // $cleardb_db = substr($cleardb_url["path"],1);
        // $active_group = 'default';
        // $query_builder = TRUE;

        // $this->pdo = new PDO(sprintf('mysql:host=%s;dbname=%s', $cleardb_server,  $cleardb_db),  $cleardb_username,$cleardb_password);
        $this->pdo = new PDO('mysql:host=localhost;port=3306;dbname=bally', 'root', '');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        self::$db = $this;
    }


    public function  getTeams($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM teams WHERE tname like :keyword ORDER BY id ASC');
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM teams ORDER BY id ASC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeamById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM teams WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteTeam($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM teams WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updateTeam(Team $team)
    {
        $statement = $this->pdo->prepare("UPDATE teams SET tname = :tname, 
                                        country = :country, 
                                        stadium = :stadium,           
                                        abrev = :abrev WHERE id = :id");
        $statement->bindValue(':tname', $team->tname);
        $statement->bindValue(':country', $team->country);
        $statement->bindValue(':stadium', $team->stadium);
        $statement->bindValue(':abrev', $team->abrev);
        $statement->bindValue(':id', $team->id);
        $statement->execute();
    }

    public function createTeam(Team $team)
    {
        $statement = $this->pdo->prepare("INSERT INTO teams (tname, country, stadium, abrev)
                VALUES (:tname, :country, :stadium, :abrev)");
        $statement->bindValue(':tname', $team->tname);
        $statement->bindValue(':country', $team->country);
        $statement->bindValue(':stadium', $team->stadium);
        $statement->bindValue(':abrev', $team->abrev);

        $statement->execute();
    }

    public function getGames($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM games WHERE home_id like :keyword OR away_id like :keyword ORDER BY id ASC');
            $statement->bindValue(":keyword", "%$keyword%");

        } else {
            $statement = $this->pdo->prepare('SELECT * FROM games ORDER BY id ASC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGameById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM games WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteGame($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM games WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updateGame(Game $game)
    {
        $statement = $this->pdo->prepare("UPDATE games SET home_id = :home_id, 
                                        away_id = :away_id, 
                                        game_day = :game_day,
                                        home_score = :home_score,           
                                        away_score = :away_score WHERE id = :id");
        $statement->bindValue(':home_id', $game->home_id);
        $statement->bindValue(':away_id', $game->away_id);
        $statement->bindValue(':game_day', $game->game_day);
        $statement->bindValue(':home_score', $game->home_score);
        $statement->bindValue(':away_score', $game->away_score);
        $statement->bindValue(':id', $game->id);
        $statement->execute();
    }

    public function createGame(Game $game)
    {
        $statement = $this->pdo->prepare("INSERT INTO games (home_id, away_id, game_day, home_score, away_score)
                VALUES (:home_id, :away_id, :game_day, :home_score, :away_score)");
        $statement->bindValue(':home_id', $game->home_id);
        $statement->bindValue(':away_id', $game->away_id);
        $statement->bindValue(':game_day', $game->game_day);
        $statement->bindValue(':home_score', $game->home_score);
        $statement->bindValue(':away_score', $game->away_score);

        $statement->execute();
    }

    public function getPlayers($keyword = '')
    {
        if ($keyword) {
            $statement = $this->pdo->prepare('SELECT * FROM players WHERE pname like :keyword ORDER BY id ASC');
            $statement->bindValue(":keyword", "%$keyword%");
        } else {
            $statement = $this->pdo->prepare('SELECT * FROM players ORDER BY id ASC');
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPlayerById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM players WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function deletePlayer($id)
    {
        $statement = $this->pdo->prepare('DELETE FROM players WHERE id = :id');
        $statement->bindValue(':id', $id);

        return $statement->execute();
    }

    public function updatePlayer(Player $player)
    {
        $statement = $this->pdo->prepare("UPDATE players SET pname = :pname, 
                                        team_id = :team_id, 
                                        goals = :goals,           
                                        position = :position WHERE id = :id");
        $statement->bindValue(':pname', $player->pname);
        $statement->bindValue(':team_id', $player->team_id);
        $statement->bindValue(':goals', $player->goals);
        $statement->bindValue(':position', $player->position);
        $statement->bindValue(':id', $player->id);
        $statement->execute();
    }

    public function createPlayer(Player $player)
    {
        $statement = $this->pdo->prepare("INSERT INTO players (pname, team_id, goals, position)
                VALUES (:pname, :team_id, :goals, :position)");
        $statement->bindValue(':pname', $player->pname);
        $statement->bindValue(':team_id', $player->team_id);
        $statement->bindValue(':goals', $player->goals);
        $statement->bindValue(':position', $player->position);

        $statement->execute();
    }

    public function createUser(User $user)
    {
        $statement = $this->pdo->prepare("INSERT INTO users (username, password, role)
                VALUES (:username, :password, :role)");
        $statement->bindValue(':username', $user->username);
        $statement->bindValue(':password', $user->password);
        $statement->bindValue(':role', $user->role);
        $statement->execute();
    }

    public function validateUser($username = '', $password ='')
    {


        if ($username) {
            $statement = $this->pdo->prepare('SELECT * FROM users WHERE username like :username AND password like :password ORDER BY id ASC');
            $statement->bindValue(":username", "%$username%");
            $statement->bindValue(":password", "%$password%");


        } else {
            return null;
        }
        $statement->execute();

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE id = :id');
        $statement->bindValue(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}

