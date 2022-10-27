<?php require_once BASEPATH.'/views/includes/header.php';?>
<?php require_once BASEPATH.'/views/includes/navbar.php';?>


<div class="row ">
	<div class="col">
		<div class="card card-sheet-name">
			<div class="card-body">
				<h5>
					<?=$params['tables']['table1']['table_name']?>
                </h5>
			</div>
		</div>
	</div>
</div>
<div class="table-block">
	<table class="tables_1 table table-hover table-border" style="border-style: solid">
		<thead>
            <tr>
                <?php foreach($params['tables']['table1']['header_row'] as $cell):?>
                    <th class="header-cell text-start">
                        <?=$cell?>
                    </th>
                <?php endforeach?>
            </tr>
		</thead>
		<tbody>
            <?php foreach ($params['tables']['table1']['rows'] as $i => $row):?>
            <tr class="" >
                <?php $j=0;?>
                <?php foreach ($row as $colValue):?>
                    <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                        <?=$colValue?>
                    </td>
                    <?php $j++;?>
                <?php endforeach ?>
            </tr>
            <?php endforeach ?>
		</tbody>
	</table>
</div>

<div class="row ">
	<div class="col">
		<div class="card card-sheet-name">
			<div class="card-body">
                <h5>
					<?=$params['tables']['table2']['table_name']?>
                </h5>
			</div>
		</div>
	</div>
</div>
<div class="table-block">
	<table class="tables_1 table table-hover table-border" style="border-style: solid">
		<thead>
		<tr>
			<?php foreach($params['tables']['table2']['header_row'] as $cell):?>
                <th class="header-cell text-start">
                    <?=$cell?>
                </th>
			<?php endforeach ?>
		</tr>
		</thead>
		<tbody>
            <?php foreach ($params['tables']['table2']['rows'] as $i => $row):?>
                <tr class="" >
                    <?php $j=0;?>
                    <?php foreach ($row as $colValue):?>
                        <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                            <?=$colValue?>
                        </td>
                        <?php $j++;?>
                    <?php endforeach?>
                </tr>
            <?php endforeach;?>
		</tbody>
	</table>
</div>

<div class="row ">
	<div class="col">
		<div class="card card-sheet-name">
			<div class="card-body">
                <h5>
					<?=$params['tables']['table3']['table_name']?>
                </h5>
			</div>
		</div>
	</div>
</div>
<div class="table-block">
	<table class=" tables_1 table table-hover table-border" style="border-style: solid">
		<thead>
		<tr>
			<?php foreach($params['tables']['table3']['header_row'] as $cell):?>
                <th class="header-cell text-start">
                    <?=$cell?>
                </th>
			<?php endforeach?>
		</tr>
		</thead>
		<tbody>
            <?php foreach ($params['tables']['table3']['rows'] as $i => $row):?>
            <tr class="" >
                <?php $j=0;?>
                <?php foreach ($row as $colValue):?>
                    <td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
                        <?=$colValue?>
                    </td>
                    <?php $j++;?>
                <?php endforeach?>
            </tr>
            <?php endforeach;?>
		</tbody>
	</table>
</div>

<div class="image-block">
	<div class="row justify-content-start">
		<div class="col">
			<div class="card card-sheet-name">
				<div class="card-body">
                    <h5>
						<?=$params['tables']['table4']['table_name']?>
                    </h5>
				</div>
			</div>
		</div>
	</div>
	<div class="image-div">
		<img class="image" src="data:image/jpeg;base64, <?=base64_encode($params['tables']['table4']['images'][0]['image'])?>"/>
	</div>
</div>

<div class="image-block">
	<div class="row justify-content-start">
		<div class="col">
			<div class="card card-sheet-name">
				<div class="card-body">
                    <h5>
						<?=$params['tables']['table5']['table_name']?>
                    </h5>
				</div>
			</div>
		</div>
	</div>
	<div class="image-div">
		<img class="image" src="data:image/jpeg;base64, <?=base64_encode($params['tables']['table5']['images'][0]['image'])?>"/>
	</div>
</div>

<?php require_once BASEPATH.'/views/includes/footer.php';?>
