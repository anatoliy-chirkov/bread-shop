<?php

  include("autoload.php");

  $pdo = Connection::create();

  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;

  $auth = new Auth;
  if ($_GET['logout'] === "yes") {
    $auth->logout();
    header("location: admin.php");
  } else {
    if ($verify = $auth->verify($_POST['name'], $_POST['password']))
      include("views/admin/index.php");
    else
      include("views/admin/auth.php");
  }