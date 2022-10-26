
<div class="col-12">
	<div class="row justify-content-start">
		<div class="col">
			<ul class="nav">
				<?php foreach($params['sheets'] as $sheet):?>
				<li class="nav-item">
					<a class="nav-link active" aria-current="page" href="?file_id=<?=$sheet['file_id']?>&sheet=<?=$sheet['id']?>">
						<?=$sheet['sheet_name']?>
					</a>
				</li>
				<?php endforeach?>
			</ul>
		</div>
	</div>
</div>
