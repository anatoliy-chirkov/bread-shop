<?php

class Product
{
  public $id;
  public $title;
  public $category_id;
  public $price;
  public $image_src;

  public function select($category_id, $type = null)
  {
    global $pdo;
    if ($type === "full")
      $res = $pdo->prepare("SELECT * FROM product WHERE category_id = $category_id LIMIT 3, 9999");
    elseif ($type === "all")
      $res = $pdo->prepare("SELECT * FROM product WHERE category_id = $category_id");
      elseif ($type === "all_cat")
        $res = $pdo->prepare("SELECT * FROM product");
    else
      $res = $pdo->prepare("SELECT * FROM product WHERE category_id = $category_id LIMIT 3");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectOne($id)
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM product WHERE id = $id");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetch(PDO::FETCH_ASSOC);
      return $rows;
    }
  }

  public function selectCategory()
  {
    global $pdo;
    $res = $pdo->prepare("SELECT * FROM product");
    $res->execute();
    if ($res != null) {
      $rows = $res->fetchAll(PDO::FETCH_ASSOC);
      $uniq = array();
      foreach($rows as $row)
      {
       if (!in_array($row['category_id'], $uniq)) {
         $uniq[] = $row['category_id'];
       }
      }
      return $uniq;
    }
  }

  public function set($array)
  {
    $this->id = (int)$array['id'];
    $this->category_id = (int)$array['category_id'];
    $this->title = (string)$array['title'];
    $this->price = (int)$array['price'];
    $this->image_src = (string)$array['image_src'];
    return $this;
  }

  public function add()
  {
    global $pdo;
    $res = $pdo->prepare("INSERT INTO product VALUES (null, ?, ?, ?, ?)");
    $res->execute(array($this->title, $this->category_id, $this->price, $this->image_src));
    if ($res != null)
      return true;
  }

  public function update()
  {
    global $pdo;
    $res = $pdo->prepare("UPDATE product SET title = ?, price = ?, category_id = ?, image_src = ? WHERE id = ?");
    $res->execute(array($this->title, $this->price, $this->category_id, $this->image_src, $this->id));
    if ($res != null)
      return true;
  }

  public function delete()
  {
    global $pdo;
    $res = $pdo->prepare("DELETE FROM product WHERE id = ?");
    $res->execute(array($this->id));
    if ($res != null)
      return true;
  }

}
