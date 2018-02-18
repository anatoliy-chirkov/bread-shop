<?php
  include("../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
?>

<button type="button" class="add_button btn btn-primary">Добавить магазин</button>
<table class="table table-striped table-hover">
  <tr>
    <th>Фото</th>
    <th>Название</th>
    <th>Описание</th>
    <th>Часы работы</th>
    <th>Адрес</th>
    <th>Действия</th>
  </tr>
  <?php if ($shops): ?>
    <?php foreach ($shops as $row): ?>
      <tr>
        <td><div class="table_image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div></td>
        <td><?=$row['title']?></td>
        <td><?=$row['description']?></td>
        <td><?=$row['working_hours']?></td>
        <td><?=$row['adress']?></td>
        <td><a href="#" class="add_button" product="<?=$row['id']?>">Редактировать</a><br><a class="del_button" href="#" product="<?=$row['id']?>">Удалить</a></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
      $(".add_button").click(function() {
        var product_id = $(this).attr("product");
        $.ajax({
            type: "POST",
            url: "views/admin/forms/shops.php",
            data: {
              product_id,
            },
            dataType: "html",
            success: function(response) {
               $(".content").html(response);
            },
            error: function(response) {
               $(".content").html("Ошибка ajax");
             }
        });
      });
      $(".del_button").click(function() {
        var id = $(this).attr("product");
        $.ajax({
            type: "POST",
            url: "handler.php?element=shop&action=delete",
            data: {
              id,
            },
            dataType: "html",
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
