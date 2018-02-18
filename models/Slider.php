<?php

class Slider
{
  public $id;
  public $image_src;
  public $title;
  public $subtitle;

  public function select()
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM slider");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectOne($id)
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM slider WHERE id = $id");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function set($array)
  {
    $this->id = (int)$array['id'];
    $this->image_src = (string)$array['image_src'];
    $this->title = (string)$array['title'];
    $this->subtitle = (string)$array['subtitle'];
    return $this;
  }

  public function add()
  {
    global $pdo;
    $res = $pdo->prepare("INSERT INTO slider VALUES (null, ?, ?, ?)");
    $res->execute(array($this->image_src, $this->title, $this->subtitle));
    if ($res != null)
      return true;
  }

  public function update()
  {
    global $pdo;
    $res = $pdo->prepare("UPDATE slider SET image_src = ?, title = ?, subtitle = ? WHERE id = ?");
    $res->execute(array($this->image_src, $this->title, $this->subtitle, $this->id));
    if ($res != null)
      return true;
  }

  public function delete()
  {
    global $pdo;
    $res = $pdo->prepare("DELETE FROM slider WHERE id = ?");
    $res->execute(array($this->id));
    if ($res != null)
      return true;
  }

}
