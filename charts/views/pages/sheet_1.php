<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<?php foreach ( $params['tables'] as $table_id => $table):?>
<div class="">

	<div class="row ">
		<div class="col">
			<div class="card card-sheet-name">
				<div class="card-body">
					<h5><?= $table['table_name'] ?></h5>
				</div>
			</div>
		</div>
	</div>

	<div class="filter-buttons ">
		<button type="button" class="btn btn-grey btn-outline-secondary float-left" id="toggle_filter_<?=$table_id?>" title="Filters" data-column="filters">
			<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
				 viewBox="0 0 16 16">
				<path
					d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"></path>
			</svg>
		</button>

		<button type="button" class="btn btn-grey btn-outline-secondary" id="reset_filter_<?=$table_id?>" title="Clear" data-column="filters">
			<span class="btn-text">Clear</span>
		</button>
	</div>

	<div class="table-block">
		<table class="display nowrap table table-striped table-hover table_filtered" id="<?=$table_id?>" style="width: 100%">
			<thead>
                <tr class="header-row">
                    <?php foreach ($table['header_row'] as $cell): ?>
                        <th class="header-cell text-start table-table_name"><?= $cell ?></th>
                    <?php endforeach ?>
                </tr>
			</thead>
			<tbody>
                <?php foreach ($table['rows'] as $i => $row): ?>
                    <tr class="">
                        <?php $j = 0; ?>
                        <?php foreach ($row as $colValue): ?>
                            <td class="cell <?= $j === 0 ? 'header-cell' : '' ?>"><?= $colValue ?></td>
                            <?php $j++; ?>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>

<?php endforeach;?>
