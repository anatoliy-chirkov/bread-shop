<?php

class DB
{

  public function select($table_name, $mod = null, $limit = null)
  {
    global $pdo;
    if ($mod === "limit")
      $res = $pdo->prepare("SELECT * FROM $table_name LIMIT $limit");
    else
      $res = $pdo->prepare("SELECT * FROM $table_name");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function add($table_name, $array)
  {
    global $pdo;
    $params = array_values($array);
    $place_holders = implode(',', array_fill(0, count($params), '?'));
    $res = $pdo->prepare("INSERT INTO $table_name VALUES (null, $place_holders)");
    $res->execute($params);
    if ($res != null)
      return true;
  }

  public function update($table_name, $id, $fileds, $array)
  {
    global $pdo;
    $params = array_values($array);
    $place_holders = implode(' = ?,', $fileds);
    $res = $pdo->prepare("UPDATE product SET $place_holders WHERE id = $id");
    $res->execute($params);
    if ($res != null)
      return true;
  }

  public function delete($table_name, $id)
  {
    global $pdo;
    $res = $pdo->prepare("DELETE FROM $table_name WHERE id = $id");
    $res->execute();
    if ($res != null)
      return true;
  }

}
