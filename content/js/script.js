$(document).ready(function(){
    $(".product_btn").click(function() {
      var category_id = $(this).attr("category_id");
      var btn = $(this);
      if (btn.hasClass("active")) {
        btn.removeClass("active");
        $(".products_load"+category_id).slideUp();
        btn.html("Смотреть все");
      } else {
        $.ajax({
            type: "POST",
            url: "views/index/products.php",
            dataType: "html",
            data: {
              category_id,
            },
            success: function(response) {
               $(".products_load"+category_id).html(response);
               $(".products_load"+category_id).slideDown();
               btn.html("Свернуть");
               btn.addClass("active");
            },
            error: function(response) {
               $(".products_reload").html("Ошибка ajax");
             }
        });
      }
    });

    $(".shop_btn").click(function() {
      var btn = $(this);
      if (btn.hasClass("active")) {
        btn.removeClass("active");
        $(".shops_load").slideUp();
        btn.html("Смотреть все магазины");
      } else {
        $.ajax({
            type: "POST",
            url: "views/index/shops.php",
            dataType: "html",
            success: function(response) {
               $(".shops_load").html(response);
               $(".shops_load").slideDown();
               btn.html("Свернуть");
               btn.addClass("active");
            },
            error: function(response) {
               $(".products_reload").html("Ошибка ajax");
             }
        });
      }
    });


  });
