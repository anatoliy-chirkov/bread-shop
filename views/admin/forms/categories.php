<?php
  include("../../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
?>
<form class="col-sm-8" action="" method="POST" enctype="multipart/form-data">
  <?php if ($_POST['category_id']): ?>
    <?php $row = $category->selectOne($_POST['category_id']); ?>
    <h4>Редактирование категории</h4>
  <?php else: ?>
    <h4>Добавление товара</h4>
  <?php endif; ?>
  <br>
  <input name="id" type="hidden" value="<?=$_POST['category_id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Название категории</label>
    <input name="title" type="text" class="form-control" id="exampleInputEmail1" <?php if ($_POST['category_id']) { echo "value=\"".$row['title']."\"";}?> placeholder="">
  </div>
  <div class="form-group">
  <?php if ($_POST['category_id']): ?>
    <button type="submit" act="update" class="btn btn-primary">Сохранить изменения</button>
  <?php else: ?>
    <button type="submit" act="add" class="add_form btn btn-primary">Добавить категорию</button>
  <?php endif; ?>
  </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("form").on("submit", function(event) {
    event.preventDefault();
    var data = $(this).serialize();
    var action = $("button").attr("act");
    if (action === "add") {
      var url = "handler.php?element=category&action=add";
    } else {
      var url = "handler.php?element=category&action=update";
    }
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "html",
        success: function(response) {
           $(".inform_log").html(response);
           $('.content').load('views/admin/categories.php');
        },
        error: function(response) {
           $(".inform_log").html("Ошибка ajax");
         }
    });
  });
});
</script>
