<?php

  include("autoload.php");

  $pdo = Connection::create();

  $shop = new Shop;
  $product = new Product;
  $category = new Category;
  $slider = new Slider;
  include("views/index/allPage.php");

  /**
   * Проверка типа запроса и вывод соответсв. контента
   * (Ajax запрос или обычный)
   */
  /*if (empty($_POST['query'])) {
      $category = new Category;
      $tree = $category->getCategory()->buildTree();
      $product = new Product;
      $products = $product->getProducts();
      include("views/index/all.php");
  } else {
      $category_id = $_POST['cat_id'];
      $product = new Product;
      $products = $product->set($category_id)->getProducts();
      include("views/index/products.php");
  }
*/
