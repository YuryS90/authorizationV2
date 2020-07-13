<?php

namespace App\Model;

use TexLab\MyDB\Runner;
use App\Core\Config;
use TexLab\MyDB\DB;

class Model
{
    private $runner;

    public function __construct()
    {
        $this->runner = new Runner(DB::Link([
            'host' => Config::MYSQL_HOST,
            'username' => Config::MYSQL_USER_NAME,
            'password' => Config::MYSQL_PASSWORD,
            'dbname' => Config::MYSQL_DATABASE,
        ]));
    }

    public function checkUser($login, $password) 
    {
        return $this->runner->runSQL(
            <<<SQL
SELECT `group`. `kod`, `user` . `username` 
FROM `group`,`user` 
WHERE `group`.`id` = `user`.`group_id` AND `username` = '$login' AND `password` = '$password'
SQL
        );
    }
}
