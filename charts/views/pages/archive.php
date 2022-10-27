<?php require_once BASEPATH.'/views/includes/header.php';?>

<div class="row">
	<div class="col">

		<div class="border border-light p-3 mb-4">

			<div class="d-flex align-items-center justify-content-center" style="height: 350px">
				<div class="list-group d-flex justify-content-center">

                    <?php if(empty($files)):?>
                        <a href="?upload=file" class="list-group-item list-group-item-action px-3 border-0">
                            Upload file...
                        </a>
                    <?php else:?>
                        <?php foreach ($files as $file):?>
                        <a href="?file_id=<?=$file['id']?>" class="list-group-item list-group-item-action px-3 border-0"><?=$file['filename']?></a>
                        <?php endforeach?>
                    <?php endif;?>
				</div>
			</div>

		</div>


	</div>
</div>

<?php require_once BASEPATH.'/views/includes/footer.php';?>
