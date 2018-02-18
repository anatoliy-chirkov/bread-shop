<?php

/**
 * Соединение с БД
 *
 * @package Classes
 */
class Connection
{
    /**
     * Инициализация подключения к БД
     *
     * @param string $db_name Имя Базы Данных
     * @return object $pdo
     */

    public function create($db_name = "tarusa_bread")
    {
        /* $db = "u0397409_bread";
        $user = "u0397409_default";
        $pass = "H166Mk!g"; */

        $database_name = "tarusa_bread";
        $user = "root";
        $pass = "";

        try {
          $pdo = new \PDO("mysql:dbname=$db_name;host=localhost", $user, $pass);
          $pdo->exec('SET NAMES utf8');
          return $pdo;
        } catch (PDOException $e) {
          echo "Возникла ошибка соединения: ".$e->getMessage();
          exit;
        }
    }
}
