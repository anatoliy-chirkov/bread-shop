<?php
  include("../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
?>

<button type="button" class="add_button btn btn-primary">Добавить категорию</button>
<table class="table table-striped table-hover">
  <tr>
    <th>Название</th>
    <th>Действия</th>
  </tr>
  <?php $cats = $category->select(); ?>
  <?php if ($cats): ?>
    <?php foreach ($cats as $cat): ?>
      <tr>
        <td><?=$cat['title']?></td>
        <td><a href="#" class="add_button" category="<?=$cat['id']?>">Редактировать</a><br><a href="#" class="del_button" category="<?=$cat['id']?>">Удалить</a></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
      $(".add_button").click(function() {
        var category_id = $(this).attr("category");
        $.ajax({
            type: "POST",
            url: "views/admin/forms/categories.php",
            data: {
              category_id,
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
        var id = $(this).attr("category");
        $.ajax({
            type: "POST",
            url: "handler.php?element=category&action=delete",
            data: {
              id,
            },
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
