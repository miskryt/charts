<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<h5><?= $params['sheet']['sheet_name'] ?></h5>


<div class="charts-wrapper sheet_3">

	<?php foreach ($params['charts'] as $table_id => $chart): ?>
        <div class="row">
            <div class="col-10">

                <div class="table-table_name">
					<?= $params['charts'][$table_id]['table_name'] ?>
                </div>

                <canvas id="chart_<?= $table_id ?>"></canvas>
                <script>

                    new Chart(document.getElementById('chart_<?=$table_id?>').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels:
                                [
									<?php foreach(array_slice($params['charts'][$table_id]['rows'], 0) as $row):?>
                                        <?php foreach(array_slice($row, 0) as $col):?>
                                            '<?=trim($col)?>',
                                            <?php break;?>
                                        <?php endforeach?>
									<?php endforeach?>
                                ],
                            datasets:
                                [
									<?php foreach ($params['charts'][$table_id]['header_row'][0] as $hr):?>
										<?php $color = 0;?>
										<?php foreach ($hr as $index =>  $h):?>
											{
												label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
												backgroundColor: NAMED_COLORS_SHEET3.<?=$table_id?>[<?=$color?>],
                                                borderColor: 'rgba(141,134,134,0.27)',
                                                borderWidth: 1,
												data:
													[
														<?php foreach(array_slice($params['charts'][$table_id]['rows'], 0) as $row):?>
															<?php foreach(array_slice($row, 0) as $col):?>
																<?=trim($row[$index])?>,
                                                                <?php break;?>
															<?php endforeach?>
														<?php endforeach?>
													],
											},
											<?php $color++;?>
										<?php endforeach;?>
									<?php endforeach;?>
                                ]
                        },
                        options: {
                            responsive: true
                        }
                    });
                </script>

            </div>

            <div class="col-2">
                <div class="table-block">
                    <table class=" table table-hover table-border" id="<?= $table_id ?>" style="border-style: solid">
                        <thead>
                        <tr>
                            <th class="header-cell text-start">Board Type</th>
                            <th class="header-cell text-start">Board Count</th>
                        </tr>
                        </thead>
                        <tbody>
						<?php foreach ($params['tables'][$table_id]['rows'] as $i => $row): ?>
                            <tr class="">
								<?php $j = 0; ?>
								<?php foreach ($row as $colValue): ?>
                                    <td class="cell <?= $j === 0 ? 'header-cell' : '' ?>">
										<?= $colValue ?>
                                    </td>
									<?php $j++; ?>
								<?php endforeach ?>
                            </tr>
						<?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
	<?php endforeach; ?>

</div>
