<?php
  include("../../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
?>
<form class="col-sm-8" role="form" action="" method="POST">
  <?php if ($_POST['product_id']): ?>
    <?php $row = $product->selectOne($_POST['product_id']); ?>
    <h4>Редактирование товара</h4>
  <?php else: ?>
    <h4>Добавление товара</h4>
  <?php endif; ?>
  <br>
  <input name="id" type="hidden" value="<?=$_POST['product_id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Категория товара</label>
    <select name="category_id" class="form-control">
      <?php $cats = $category->select(); ?>
      <?php foreach ($cats as $cat): ?>
        <option <?php if ($row['category_id'] === $cat['id']) { echo "selected";}?> value="<?=$cat['id']?>"><?=$cat['title']?></option>
      <?php endforeach; ?>
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Название товара</label>
    <input name="title" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['product_id']) { echo "value=\"".$row['title']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Цена (в рублях)</label>
    <input name="price" type="text" class="form-control" id="exampleInputPassword1" <?php if ($_POST['product_id']) { echo "value=\"".$row['price']."\""; }?> placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputFile">Изображение</label>
    <?php if ($_POST['product_id']): ?>
      <div class="table_image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div>
    <?php endif; ?>
    <input name="filename" type="file" id="exampleInputFile">
    <input name="image_src" type="hidden" value="<?=$row['image_src']?>">
  </div>
  <?php if ($_POST['product_id']): ?>
    <button type="submit" act="update" class="btn btn-primary">Сохранить изменения</button>
  <?php else: ?>
    <button type="submit" act="add" class="btn btn-primary">Добавить товар</button>
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
      var url = "handler.php?element=product&action=add";
    } else {
      var url = "handler.php?element=product&action=update";
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
           $('.content').load('views/admin/products.php');
        },
        error: function(response) {
           $(".inform_log").html("Ошибка ajax");
         }
    });
  });
});
</script>
