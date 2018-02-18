<?php
  include("../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
?>

<select class="my_select form-control">
  <option class="my_option">Выберите категорию товаров</option>
  <?php $cats = $category->select(); ?>
  <?php foreach ($cats as $cat): ?>
    <option class="my_option"
      <?php
      if ($cat['id'] === $_POST['category_id'])
        echo "selected";
      ?>
      value="<?=$cat['id']?>"><?=$cat['title']?></option>
  <?php endforeach; ?>
</select>
<?php if ($cat['id']): ?>
  <button type="button" class="add_button btn btn-primary">Добавить товар</button>
<?php endif; ?>
<table class="table table-striped table-hover">
  <?php if ($_POST['category_id'] > 0): ?>
    <?php $products = $product->select($_POST['category_id'], "all"); ?>
  <?php else: ?>
    <?php $products = $product->select(999, "all_cat");?>
  <?php endif; ?>
  <?php if ($products): ?>
    <tr>
      <th>Фото</th>
      <th>Название</th>
      <th>Цена</th>
      <th>Действия</th>
    </tr>
    <?php foreach ($products as $row): ?>
      <tr>
        <td><div class="table_image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div></td>
        <td><?=$row['title']?></td>
        <td><?=$row['price']?> руб.</td>
        <td><a href="#" class="add_button" product="<?=$row['id']?>">Редактировать</a><br><a class="del_button" href="#" product="<?=$row['id']?>">Удалить</a></td>
      </tr>
    <?php endforeach; ?>
  <?php endif; ?>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
  $(document).ready(function(){
      $(".my_option").click(function() {
        var category_id = $(this).val();
        $.ajax({
            type: "POST",
            url: "views/admin/products.php",
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
      $(".add_button").click(function() {
        var product_id = $(this).attr("product");
        $.ajax({
            type: "POST",
            url: "views/admin/forms/products.php",
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
            url: "handler.php?element=product&action=delete",
            data: {
              id,
            },
            dataType: "html",
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
