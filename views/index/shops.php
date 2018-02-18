<?php include("../../autoload.php");; ?>
<?php $pdo = Connection::create(); ?>
<?php $shop = new Shop; ?>
<?php $shops = $shop->select('full'); ?>
<?php foreach ($shops as $row): ?>
<div class="shops_item">
  <hr>
  <div class="shops_item-image" style="background-image: url(content/images/<?=$row['image_src']?>);"></div>
  <div class="shops_item-image">
    <?=$row['map']?>
  </div>
  <div class="shops_item-description">
    <?=$row['title']?><br>
    <?=$row['description']?><br>
    Время работы: <?=$row['working_hours']?><br>
    Адрес: <?=$row['adress']?>
  </div>
</div>
<?php endforeach; ?>
