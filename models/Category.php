<?php

class Category
{
  public $table_name = "category";
  public $values = array();
  public $id;
  public $title;

  public function select()
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM category");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectOne($id)
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM category WHERE id = $id");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectName($id)
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM category WHERE id = $id LIMIT 1");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      $row = $rows['title'];
      return $row;
    }
  }

  public function set($array)
  {
    $this->id = (int)$array['id'];
    $this->title = (string)$array['title'];
    return $this;
  }

  public function add()
  {
    global $pdo;
    $res = $pdo->prepare("INSERT INTO category VALUES (null, ?)");
    $res->execute(array($this->title));
    if ($res != null)
      return true;
  }

  public function update()
  {
    global $pdo;
    $res = $pdo->prepare("UPDATE category SET title = ? WHERE id = ?");
    $res->execute(array($this->title, $this->id));
    if ($res != null)
      return true;
  }

  public function delete()
  {
    global $pdo;
    $res = $pdo->prepare("DELETE FROM category WHERE id = ?");
    $res->execute(array($this->id));
    if ($res != null)
      return true;
  }

  /*public function select()
  {
    $res = DB::select($table_name);
    return $res;
  }
  public function set($_POST)
  {
    // последовательность полей как в БД
    $this->values = array((int)$_POST['id'], (string)$_POST['title']);
    return $this;
  }
  public function add()
  {
    $res = DB::add($table_name, $this->values);
    return $res;
  }
  public function update()
  {

  }
  public function delete()
  {

  }*/
}
