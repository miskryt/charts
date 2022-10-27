

<div class="col-12">
    <div class="row">
        <div class="col">
            <h4>
				<?=$params['filename']?>
            </h4>
        </div>
    </div>

	<div class="row justify-content-start">
		<div class="col">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="">

                    <div class="collapse navbar-collapse " id="navbarText">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<?php foreach($params['sheets'] as $sheet):?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $sheet['active'] ? 'active' : '' ?>" aria-current="page" href="?file_id=<?=$sheet['file_id']?>&sheet=<?=$sheet['id']?>">
										<?=$sheet['nav_title']?>
                                    </a>
                                </li>
							<?php endforeach?>
                        </ul>

                    </div>
                </div>
            </nav>

		</div>
	</div>
</div>
