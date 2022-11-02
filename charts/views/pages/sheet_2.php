<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<script>



</script>

<h5><?= $params['sheet']['sheet_name'] ?></h5>

<div class="charts-wrapper sheet_2">

	<?php foreach ($params['charts'] as $table_id => $chart):?>

    <?php
        $labels = [];
		foreach($params['charts'][$table_id]['rows'] as $row) {
			$labels[] = current($row);
		};

        $lq = ($labels);

        $data = [];
        foreach($params['charts'][$table_id]['rows'] as $i =>  $row) {
           foreach (array_slice($row, 1) as $key => $value) {
			   $data[$i][] = $value;
           }
        }

        $datasets = [];
        foreach ($params['charts'][$table_id]['header_row'][0] as $hr) {
            foreach ($hr as $h){
              $datasets[] = ($h !== '\\') ? $h : 'CHECH Freq';
            }
        }

        //var_dump($params['charts']['table3']['rows']);
?>

		<div class="row">

			<div class="col-10">
				<div class="table_name">
					<?= $params['charts'][$table_id]['table_name'] ?>
				</div>

				<canvas id="chart_<?=$table_id?>"></canvas>
				<script>
                    var data = {
                        labels: [
							<?php foreach ($lq as $item) {
							echo '"' . $item . '"' . ',';
						};?>
                        ],
                        datasets: [
							<?php foreach ( $datasets as $key => $dataset ) : ?>
                            {
                                label: '<?php echo $dataset;?>',
                                backgroundColor: NAMED_COLORS_SHEET2.<?=$table_id?>[<?=$key?>],
                                data: [
									<?php foreach ($data as $sss) {
									echo '"' . $sss[$key] . '"' . ',';
								};?>
                                ]
                            },
							<?php endforeach; ?>
                        ]
                    };

					new Chart(document.getElementById('chart_<?=$table_id?>').getContext('2d'), {
						type: 'bar',
						data: data,
						options: {
							plugins: {
								title: {
									display: true,
									text: ''
								},
							},

							scales: {
								x: {
									stacked: true,
								},
								y: {
									stacked: true
								}
							}
						}
					});
				</script>
			</div>

			<div class="col-2">

				<div class="table-block">
					<table class="display nowrap table table-striped table-hover table_filtered" id="<?=$table_id?>" >
						<thead>
							<tr class="header-row">
								<?php foreach(array_slice($params['tables'][$table_id]['header_row'], 0) as $cell):?>
									<th style="display: none"></th>
									<th colspan="1" class="header-cell text-start table-table_name">
										<?=$cell?>
									</th>
								<?php endforeach?>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($params['tables'][$table_id]['rows'] as $row):?>
								<tr class="">

									<?php $j=0;?>
									<?php foreach ($row as $colValue):?>
										<?php if($j === 0):?>
											<td class="cell header-cell">
												<?=$colValue?>
											</td>
										<?php endif;?>

										<?php if($j !== 0):?>
											<td class="cell">
												<?=$colValue?>
											</td>
										<?php endif;?>


										<?php $j++;?>
									<?php endforeach?>
								</tr>
							<?php endforeach?>
						</tbody>
					</table>
				</div>
			</div>

		</div>
	<?php endforeach;?>

</div>
