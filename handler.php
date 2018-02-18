<?php
  include("autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $product = new Product;
  $category = new Category;
  $slider = new Slider;
  $auth = new Auth;

  /* User */
  if ($_GET['element'] === "user") {
    if ($_GET['action'] === "update") {
      $res = $auth->set($_POST)->update();
      if ($res)
        echo "Информация обновлена";
    }
  }

  /* Category */
  if ($_GET['element'] === "category") {
    if ($_GET['action'] === "add") {
      $res = $category->set($_POST)->add();
      if ($res)
        echo "Категория добавлена";
    }
    elseif ($_GET['action'] === "update") {
      $res = $category->set($_POST)->update();
      if ($res)
        echo "Категория обновлена";
    }
    elseif ($_GET['action'] === "delete") {
      $res = $category->set($_POST)->delete();
      if ($res)
        echo "Категория удалена";
    }
  }

  /* Product */
  if ($_GET['element'] === "product") {
    if ($_GET['action'] === "add") {
      if($_FILES["filename"]["size"] > 1024*10*1024)
      {
        echo ("Размер файла превышает 10 мегабайт");
        exit;
      }
      $path = 'content/images/'; // директория для загрузки
      $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
      $new_name = time().'.'.$ext; // новое имя с расширением
      $full_path = $path.$new_name; // полный путь с новым именем и расширением
      if ($_FILES['filename']['error'] == 0) {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
          $_POST['image_src'] = $new_name;
          $res = $product->set($_POST)->add();
          if ($res)
            echo "Продукт добавлен";
        }
      }
    }
    elseif ($_GET['action'] === "update") {
      if ($_FILES["filename"]['tmp_name']) {
        if($_FILES["filename"]["size"] > 1024*10*1024)
        {
          echo ("Размер файла превышает 10 мегабайт");
          exit;
        }
        $path = 'content/images/'; // директория для загрузки
        $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        if ($_FILES['filename']['error'] == 0) {
          if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
            $_POST['image_src'] = $new_name;
            $res = $product->set($_POST)->update();
          }
        }
      } else {
        $res = $product->set($_POST)->update();
      }
      if ($res)
          echo "Продукт обновлен";
    }
    elseif ($_GET['action'] === "delete") {
      $res = $product->set($_POST)->delete();
      if ($res)
        echo "Продукт удален";
    }
  }

  /* Shop */
  if ($_GET['element'] === "shop") {
    if ($_GET['action'] === "add") {
      if($_FILES["filename"]["size"] > 1024*10*1024)
      {
        echo ("Размер файла превышает 10 мегабайт");
        exit;
      }
      $path = 'content/images/'; // директория для загрузки
      $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
      $new_name = time().'.'.$ext; // новое имя с расширением
      $full_path = $path.$new_name; // полный путь с новым именем и расширением
      if ($_FILES['filename']['error'] == 0) {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
          $_POST['image_src'] = $new_name;
          $res = $shop->set($_POST)->add();
          if ($res)
            echo "Магазин добавлен";
        }
      }
    }
    elseif ($_GET['action'] === "update") {
      if ($_FILES["filename"]['tmp_name']) {
        if($_FILES["filename"]["size"] > 1024*10*1024)
        {
          echo ("Размер файла превышает 10 мегабайт");
          exit;
        }
        $path = 'content/images/'; // директория для загрузки
        $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        if ($_FILES['filename']['error'] == 0) {
          if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
            $_POST['image_src'] = $new_name;
            $res = $shop->set($_POST)->update();
          }
        }
      } else {
        $res = $shop->set($_POST)->update();
      }
      if ($res)
          echo "Магазин обновлен";
    }
    elseif ($_GET['action'] === "delete") {
      $res = $shop->set($_POST)->delete();
      if ($res)
        echo "Магазин удален";
    }
  }

  /* Slider */
  if ($_GET['element'] === "slider") {
    if ($_GET['action'] === "add") {
      if($_FILES["filename"]["size"] > 1024*10*1024)
      {
        echo ("Размер файла превышает 10 мегабайт");
        exit;
      }
      $path = 'content/images/'; // директория для загрузки
      $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
      $new_name = time().'.'.$ext; // новое имя с расширением
      $full_path = $path.$new_name; // полный путь с новым именем и расширением
      if ($_FILES['filename']['error'] == 0) {
        if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
          $_POST['image_src'] = $new_name;
          $res = $slider->set($_POST)->add();
          if ($res)
            echo "Слайд добавлен";
        }
      }
    }
    elseif ($_GET['action'] === "update") {
      if ($_FILES["filename"]['tmp_name']) {
        if($_FILES["filename"]["size"] > 1024*10*1024)
        {
          echo ("Размер файла превышает 10 мегабайт");
          exit;
        }
        $path = 'content/images/'; // директория для загрузки
        $ext = array_pop(explode('.',$_FILES['filename']['name'])); // расширение
        $new_name = time().'.'.$ext; // новое имя с расширением
        $full_path = $path.$new_name; // полный путь с новым именем и расширением
        if ($_FILES['filename']['error'] == 0) {
          if (move_uploaded_file($_FILES['filename']['tmp_name'], $full_path)) {
            $_POST['image_src'] = $new_name;
            $res = $slider->set($_POST)->update();
          }
        }
      } else {
        $res = $slider->set($_POST)->update();
      }
      if ($res)
          echo "Слайд обновлен";
    }
    elseif ($_GET['action'] === "delete") {
      $res = $slider->set($_POST)->delete();
      if ($res)
        echo "Слайд удален";
    }
  }