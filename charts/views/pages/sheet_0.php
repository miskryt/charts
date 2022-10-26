<?php require_once BASEPATH.'/views/includes/header.php';?>
<?php require_once BASEPATH.'/views/includes/navbar.php';?>


<div class="row">
	<div class="col">
		<h4>
			<?=$params['filename']?>
		</h4>
	</div>
</div>
<div class="table-block">
	<table class="display nowrap table table-striped table-hover table-border" id="table_0">

		<thead>
		<tr class="header-row">
			<th>id</th>
			<?php foreach ($params['sheet']['header_row'] as $cell):?>
			<th class="header-cell align-top">
				<?=$cell?>
			</th>
			<?php endforeach;?>
		</tr>
		</thead>

		<tbody>

		<?php foreach ($params['sheet']['rows'] as $i => $row):?>
		<tr id="<?=$i?>">
			<td><?=$i?></td>
			<?php foreach($row as $c => $cell):?>
			<td class="cell <?=$c === 0 ? 'header-cell' : ''?>">
				<?=$cell?>
			</td>
			<?php endforeach?>
		</tr>
		<?php endforeach?>
		</tbody>

	</table>
</div>

<?php require_once BASEPATH.'/views/includes/footer.php';?>
