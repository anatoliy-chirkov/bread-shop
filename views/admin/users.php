<?php
  include("../../autoload.php");
  $pdo = Connection::create();
  $shop = new Shop;
  $shops = $shop->select("all");
  $product = new Product;
  $category = new Category;
  $user = new User;
?>
<?php $user = $user->select(); ?>
<form class="col-sm-8" action="" method="POST" enctype="multipart/form-data">
  <h4>Настройки администратора</h4>
  <br>
  <input name="id" type="hidden" value="<?=$user['id']?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Имя администратора</label>
    <input name="name" type="text" class="form-control" id="exampleInputEmail1" value="<?=$user['name']?>" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Новый пароль</label>
    <input name="password" type="password" class="form-control" id="exampleInputEmail1" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Повторите новый пароль</label>
    <input name="password2" type="password" class="form-control" id="exampleInputEmail1" placeholder="">
  </div>
  <div class="form-group">
  <button type="submit" act="update" class="btn btn-primary">Сохранить изменения</button>
  </div>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("form").on("submit", function(event) {
    event.preventDefault();
    var data = $(this).serialize();
    var action = $("button").attr("act");
    var url = "handler.php?element=user&action=update";
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        dataType: "html",
        success: function(response) {
           $(".inform_log").html(response);
           $('.content').load('views/admin/users.php');
        },
        error: function(response) {
           $(".inform_log").html("Ошибка ajax");
         }
    });
  });
});
</script>
