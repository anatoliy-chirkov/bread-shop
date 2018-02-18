<?php

class Shop
{
  public $id;
  public $title;
  public $description;
  public $working_hours;
  public $adress;
  public $image_src;
  public $map;

  public function select($type = null)
  {
    global $pdo;
    if ($type === "full")
      $res = $pdo->prepare("SELECT * FROM shop LIMIT 1, 9999");
    elseif ($type === "all")
      $res = $pdo->prepare("SELECT * FROM shop");
    else
      $res = $pdo->prepare("SELECT * FROM shop LIMIT 1");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectOne($id)
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM shop WHERE id = $id");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function set($array)
  {
    $this->id = (int)$array['id'];
    $this->title = (string)$array['title'];
    $this->description = (string)$array['description'];
    $this->working_hours = (string)$array['working_hours'];
    $this->adress = (string)$array['adress'];
    $this->image_src = (string)$array['image_src'];
    $this->map = $array['map'];
    return $this;
  }

  public function add()
  {
    global $pdo;
    $res = $pdo->prepare("INSERT INTO shop VALUES (null, ?, ?, ?, ?, ?, ?)");
    $res->execute(array(
      $this->title,
      $this->description,
      $this->working_hours,
      $this->adress,
      $this->image_src,
      $this->map));
    if ($res != null)
      return true;
  }

  public function update()
  {
    global $pdo;
    $res = $pdo->prepare("UPDATE shop SET
      title = ?,
      description = ?,
      working_hours = ?,
      adress = ? ,
      image_src = ?,
      map = ?
      WHERE id = ?");
    $res->execute(array(
      $this->title,
      $this->description,
      $this->working_hours,
      $this->adress,
      $this->image_src,
      $this->map,
      $this->id));
    if ($res != null)
      return true;
  }

  public function delete()
  {
    global $pdo;
    $res = $pdo->prepare("DELETE FROM shop WHERE id = ?");
    $res->execute(array($this->id));
    if ($res != null)
      return true;
  }

}
