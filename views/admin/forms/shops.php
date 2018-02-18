<?php
  include("../../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $product = new Product;
  $category = new Category;
?>
<form class="col-sm-8" role="form" action="" method="POST">
  <?php if ($_POST['product_id']): ?>
    <?php $row = $shop->selectOne($_POST['product_id']); ?>
    <h4>Редактирование магазина</h4>
  <?php else: ?>
    <h4>Добавление магазина</h4>
  <?php endif; ?>
  <br>
  <input name="id" type="hidden" value="<?=$_POST['product_id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Название магазина</label>
    <input name="title" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['product_id']) { echo "value=\"".$row['title']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Подробнее</label>
    <input name="description" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['product_id']) { echo "value=\"".$row['description']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Время работы</label>
    <input name="working_hours" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['product_id']) { echo "value=\"".$row['working_hours']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Адрес</label>
    <input name="adress" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['product_id']) { echo "value=\"".$row['adress']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Изображение</label>
    <?php if ($_POST['product_id']): ?>
      <div class="table_image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div>
    <?php endif; ?>
    <input name="filename" type="file" id="exampleInputFile">
    <input name="image_src" type="hidden" value="<?=$row['image_src']?>">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Код карты для вставки <br><a href="https://yandex.ru/map-constructor" target="_blank">Конструктор карт Яндекс</a></label>
    <textarea name="map" class="form-control" rows="3"><?php if ($_POST['product_id']) { echo "".(string)$row['map'];}?></textarea>
    <p class="help-block">Измените значения: width="350" height="300"</p>
  </div>
  <?php if ($_POST['product_id']): ?>
    <button type="submit" act="update" class="btn btn-primary">Сохранить изменения</button>
  <?php else: ?>
    <button type="submit" act="add" class="btn btn-primary">Добавить магазин</button>
  <?php endif; ?>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

  function readImage(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#preview').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#exampleInputFile').change(function(){
    readImage(this);
  });

  $("form").on("submit", function(event) {
    event.preventDefault();
    var data = new FormData(this);
    var action = $("button").attr("act");
    if (action === "add") {
      var url = "handler.php?element=shop&action=add";
    } else {
      var url = "handler.php?element=shop&action=update";
    }
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        cache: false, // В запросах POST отключено по умолчанию, но перестрахуемся
        contentType: false, // Тип кодирования данных мы задали в форме, это отключим
        processData: false,
        success: function(response) {
           $(".inform_log").html(response);
           $('.content').load('views/admin/shops.php');
        },
        error: function(response) {
           $(".inform_log").html("Ошибка ajax");
         }
    });
  });
});
</script>
