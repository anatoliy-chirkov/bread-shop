<?php

class User
{
  public $id;
  public $name;
  public $password;
  public $hash;

  public function select()
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM user LIMIT 1");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function verify()
  {

  }

  public function add()
  {

  }

  public function updatePassword()
  {
    $fields = "password";
    //$action = DB::update($tableName, $fields); // вычисляет кол-во полей, создает строку с "?", делает все короче
  }

  public function delete()
  {

  }

}
