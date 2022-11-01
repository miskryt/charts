<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>


<div class="si-images">
  <div class="col">
    <div class="image-block">
      <div class="header"><?= $params['images'][0]['image_name'] ?></div>
      <div class="image-div">
        <img class="image" src="data:image/jpeg;base64, <?= base64_encode($params['images'][1]['image']) ?>"/>
      </div>
    </div>
  </div>

  <div class="col">
    <div class="image-block">
      <div class="header"><?= $params['images'][1]['image_name'] ?></div>
      <div class="image-div">
        <img class="image" src="data:image/jpeg;base64, <?= base64_encode($params['images'][0]['image']) ?>"/>
      </div>
    </div>
  </div>
</div>


<?php require_once BASEPATH . '/views/includes/footer.php'; ?>
