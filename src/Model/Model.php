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

    /**
     * Проверка, есть ли такой пользователь в БД
     */
    public function checkUser($login, $password)
    {
        return $this->runner->runSQL(
            <<<SQL
-- SELECT `group`. `kod`, `user` . `username`
SELECT `group`. `kod`, `group`.  `name` as  `group_name` , `user` . `username`
FROM `group`,`user` 
WHERE `group`.`id` = `user`.`group_id` AND `username` = '$login' AND `password` = '$password'
SQL
        )[0];
    }

    /**
     * Считаем количество строк в таблице user
     */
    public function registeredUsers()
    {
        return $this->runner->runSQL(
            "SELECT COUNT(*) 
            FROM `user`"
        )[0]['COUNT(*)'];
    }

    // при помощи print_r($count) распечатывает ( [0] => Array ( [COUNT()] => 4 ) )
    // ЧТобы достать 4, тогда использвуем такую запись [0]['COUNT(*)']
}
