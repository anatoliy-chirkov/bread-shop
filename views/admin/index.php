<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Таруса Хлеб</title>

  <!-- Bootstrap -->
  <link href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="content/css/admin.css" rel="stylesheet">

</head>
<body>
  <div class="navbar-wrapper">
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="container navbar_content">
        <a class="navbar_content-link" href="admin.php">
          <div class="navbar_content-logo"></div>
          <div class="navbar_content-title">Таруса_хлеб</div>
        </a>
      </div>
    </nav>
  </div>

<div class="container container_content">
  <div class="container_inner">
    <div class="inform_log"></div>
    <div class="main_menu col-sm-3 panel panel-default">
      <ul>
        <li><a class="menu_button-toggle" value="products.php" href="#">Продукция</a></li>
        <ul class="menu_button-childs">
          <li><a class="menu_button" value="products.php" href="#">Товары</a></li>
          <li><a class="menu_button" value="categories.php" href="#">Категории</a></li>
        </ul>
        <li><a class="menu_button" value="shops.php" href="#">Магазины</a></li>
        <li><a class="menu_button" value="slider.php" href="#">Слайдшоу</a></li>
        <li><a class="menu_button" value="users.php" href="#">Настройки</a></li>
        <hr>
        <li><a href="/">На главную</a></li>
        <li><a href="../../admin.php?logout=yes">Выйти</a></li>
      </ul>
    </div>

    <div class="content col-sm-8">
      Выберите пункт меню
    </div>
  </div>
</div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="content/js/script.js"></script>
  <script type="text/javascript" src="vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>
  <script>
    $(document).ready(function(){
        $(".menu_button").click(function() {
          var page = $(this).attr("value");
          $.ajax({
              type: "POST",
              url: "views/admin/" + page,
              dataType: "html",
              success: function(response) {
                 $(".content").html(response);
              },
              error: function(response) {
                 $(".content").html("Ошибка ajax");
               }
          });
        });
        $(".menu_button-toggle").click(function() {
          $(".menu_button-childs").slideToggle();
        });
    });
  </script>
</body>
</html>
