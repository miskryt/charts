<?php require_once BASEPATH.'/views/includes/header.php';?>
<?php require_once BASEPATH.'/views/includes/navbar.php';?>

<div class="row">
    <div class="col">
        <div class="image-block">
            <div class="row justify-content-start">
                <div class="col">
                    <div class="card card-sheet-name">
                        <div class="card-body">
                            <h5>
								<?=$params['images'][0]['image_name']?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-div">
                <img class="image" src="data:image/jpeg;base64, <?=base64_encode($params['images'][0]['image'])?>"/>
            </div>
        </div>
    </div>

    <div class="col">
        <div class="image-block">
            <div class="row justify-content-start">
                <div class="col">
                    <div class="card card-sheet-name">
                        <div class="card-body">
                            <h5>
								<?=$params['images'][0]['image_name']?>
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="image-div">
                <img class="image" src="data:image/jpeg;base64, <?=base64_encode($params['images'][1]['image'])?>"/>
            </div>
        </div>
    </div>
</div>





<?php require_once BASEPATH.'/views/includes/footer.php';?>
