<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Таруса Хлеб</title>

  <!-- Bootstrap -->
  <link href="vendor/twitter/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="content/css/style.css" rel="stylesheet">

</head>
<body>
<!-- Navbar ================================================== -->
  <div class="row">
  <div class="navbar-wrapper">
    <nav class="navbar navbar-static-top" role="navigation">
      <div class="navbar_content">
        <div class="navbar_content-logo"></div>
        <div class="navbar_content-title">Таруса_хлеб</div>
      </div>
    </nav>
  </div>
  </div>
  <!-- Carousel ================================================== -->
  <?php $slider = $slider->select(); ?>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php $count = 0 ?>
    <?php foreach ($slider as $row): ?>
      <li data-target="#myCarousel" data-slide-to="<?=$count?>" <?php if ($count === 0) { echo "class=\"active\""; }?>></li>
      <?php $count++ ?>
    <?php endforeach; ?>
    </ol>
    <div class="carousel-inner">
    <?php $count = 0 ?>
    <?php foreach ($slider as $row): ?>
      <?php $count++ ?>
      <div class="item <?php if ($count === 1) { echo "active"; }?>">
        <img src="content/images/<?=$row['image_src']?>" alt="slide">
        <div class="container carousel_container">
          <div class="carousel-caption">
            <h1><?=$row['title']?></h1>
            <p><?=$row['subtitle']?></p>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
    </div>
    <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
  </div><!-- /.carousel -->

  <div class="page_content row">
    <div class="site_menu">
      <div class="site_menu-item">Магазины</div>
      <div class="site_menu-item">Хлеб</div>
      <div class="site_menu-item">Контакты</div>
    </div>
    <div class="shops">
      <?php $shops = $shop->select("all"); ?>
      <?php $shops_rows = count($shops); ?>
      <?php if ($shops_rows > 0): ?>
        <h2>Магазины</h2>
      <?php endif; ?>
      <?php $count = 0 ?>
      <?php foreach ($shops as $row): ?>
        <?php $count++ ?>
        <div class="shops_case">
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3 hidden-sm">
            <div class="back-item" style="background-image: url(content/images/img_bread.jpg);">
            </div>
          </div>
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3" style="background-image: url(content/images/<?=$row['image_src']?>);">
          </div>
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3">
            <?=$row['map']?>
          </div>
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3 hidden-sm">
            <div class="back-item" style="background-image: url(content/images/img_wood.jpg);">
            </div>
          </div>

          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3 hidden-sm">
            <div class="back-item" style="background-image: url(content/images/img_grains.jpg);  background-position: right;">
            </div>
          </div>
          <div class="shops_case-item shop-description col-xs-12 col-sm-4 col-md-3">
            <div class="shops_case-description">
              <div class="shops_description-title"><?=$row['title']?></div>
              <?=$row['description']?><br>
              Адрес: <?=$row['adress']?><br>
              Время работы: <?=$row['working_hours']?>
            </div>
          </div>
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3 hidden-sm">
            <div class="back-item" style="background-image: url(content/images/img_flour.jpg);">
            </div>
          </div>
          <div class="shops_case-item col-xs-12 col-sm-4 col-md-3 hidden-sm">
            <div class="back-item" style="background-image: url(content/images/img_dough.jpg); background-position: left;">
            </div>
          </div>
        </div>
        <?php if ($count === 1) {break;} ?>
      <?php endforeach; ?>
      <div class="shops_load"></div>
      <div class="shops_button">
        <?php if ($shops_rows > 1): ?>
          <div class="btn_style shop_btn">Смотреть все</div>
        <?php endif; ?>
      </div>
    </div>
    <div class="products col-sm-12">
      <h2 class="container">Продукция</h2>
      <?php $cats = $product->selectCategory(); ?>
      <?php foreach ($cats as $cat): ?>
        <?php $products = $product->select($cat, "all"); ?>
        <?php $products_rows = count($products); ?>
        <?php if ($products): ?>
      <div class="products_case col-sm-9">
        <div class="products_case-title col-sm-12">
          <div class="products_case-tittle_block col-sm-3">
            <?=$category->selectName($cat)?>
          </div>
        </div>
        <?php $count = 0 ?>
        <?php foreach ($products as $row): ?>
          <?php $count++ ?>
          <div class="products_item col-sm-4">
            <div class="products_item-image" style="background-image: url(content/images/<?=$row['image_src']?>);">
            </div>
            <div class="item-description products_item-title"><?=$row['title']?></div>
            <?php if ($row['price']): ?>
            <div class="item-description products_item-price"><?=$row['price']?> руб.</div>
            <?php endif; ?>
          </div>
          <?php if ($count === 3) {break;} ?>
        <?php endforeach; ?>
        <div class="products_load products_load<?=$cat?> col-sm-12"></div>
        <div class="products_case-button col-sm-12">
        <?php if ($products_rows > 3): ?>
          <div category_id="<?=$cat?>" class="product_btn btn_style">Смотреть все</div>
        <?php endif; ?>
        </div>
      </div>
      <?php endif; ?>
      <?php endforeach; ?>

    </div>
    <div class="contacts col-sm-12">
      <h2>Контакты</h2>
        Телефон для заказа продукции: +7 915 168 4578 <br>
        Адрес производства: г.Таруса, Серпуховское шоссе 54 <br>
        Все права защищены <br>
    </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="content/js/script.js"></script>
  <script type="text/javascript" src="vendor/twitter/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
