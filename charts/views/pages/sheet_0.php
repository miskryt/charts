<?php require_once BASEPATH.'/views/includes/header.php';?>
<?php require_once BASEPATH.'/views/includes/navbar.php';?>




<div class="table-block">
    <h5><?=$params['sheets'][0]['sheet_name']?></h5>

    <button type="button" class="btn btn-outline-secondary" id="toggle_filter_0" title="Filters">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
        </svg>
        <span class="visually-hidden">Button</span>
    </button>

	<table class="display nowrap table table-striped table-hover" id="table_0">

		<thead>
		<tr class="header-row">
			<th></th>
			<?php foreach ($params['sheet']['header_row'] as $cell):?>
                <th class="header-cell align-top">
                    <?=$cell?>
                </th>
			<?php endforeach;?>
		</tr>
		</thead>

		<tbody>

		<?php foreach ($params['sheet']['rows'] as $i => $row):?>
		<tr>
			<td></td>
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
