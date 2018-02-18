<?php include("../../autoload.php");; ?>
<?php $pdo = Connection::create(); ?>
<?php $product = new Product;?>
<?php $products = $product->select($_POST['category_id'], 'full'); ?>
<?php foreach ($products as $row): ?>
<div class="products_item col-sm-4">
  <div class="products_item-image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div>
  <div class="item-description products_item-title"><?=$row['title']?></div>
  <?php if ($row['price']): ?>
  <div class="item-description products_item-price"><?=$row['price']?> руб.</div>
  <?php endif; ?>
</div>
<?php endforeach; ?>
