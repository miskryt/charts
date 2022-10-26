<?php require_once BASEPATH.'/views/includes/header.php';?>
<?php require_once BASEPATH.'/views/includes/navbar.php';?>

<div class="row">
	<div class="col-10">
		<canvas id="chart1" ></canvas>
		<script>
            const ctx = document.getElementById('chart1').getContext('2d');
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table1']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table1']['rows'],0) as $row):?>
							<?php foreach(array_slice($row,1) as $col):?>
                            {x: '<?=current($row)?>',y:'<?=($col)?>'},
							<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table1']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
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
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart2" ></canvas>
		<script>
            const ctx2 = document.getElementById('chart2').getContext('2d');
            const myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table2']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table2']['rows'],0) as $row):?>
							<?php foreach(array_slice($row,1) as $col):?>
                            {x: '<?=current($row)?>',y:'<?=($col)?>'},
							<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table2']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table2']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
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
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart3" ></canvas>
		<script>
            const ctx3 = document.getElementById('chart3').getContext('2d');
            const myChart3 = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table3']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table3']['rows'],0) as $row):?>
							<?php foreach(array_slice($row,1) as $col):?>
                            {x: '<?=current($row)?>',y:'<?=($col)?>'},
							<?php endforeach?>
							<?php endforeach?>

                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table3']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
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
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart4" ></canvas>
		<script>
            const ctx4 = document.getElementById('chart4').getContext('2d');
            const myChart4 = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table4']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table4']['rows'],0) as $row):?>
							<?php foreach(array_slice($row,1) as $col):?>
                            {x: '<?=current($row)?>',y:'<?=($col)?>'},
							<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table4']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table4']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table4']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart5" ></canvas>
		<script>
            const ctx5 = document.getElementById('chart5').getContext('2d');
            const myChart5 = new Chart(ctx5, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table5']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table5']['rows'],0) as $row):?>
							<?php foreach(array_slice($row,1) as $col):?>
                            {x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
							<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table5']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table5']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table5']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart6" ></canvas>
		<script>
            const ctx6 = document.getElementById('chart6').getContext('2d');
            const myChart6 = new Chart(ctx6, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table6']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table6']['rows'],0) as $row):?>
								<?php foreach(array_slice($row,1) as $col):?>
									{x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
								<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table6']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table6']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table6']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-10">
		<canvas id="chart7" ></canvas>
		<script>
            const ctx7 = document.getElementById('chart7').getContext('2d');
            const myChart7 = new Chart(ctx7, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table7']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table7']['rows'],0) as $row):?>
								<?php foreach(array_slice($row,1) as $col):?>
									{x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
								<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table7']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table7']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table7']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>


<div class="row">
	<div class="col-10">
		<canvas id="chart8" ></canvas>
		<script>
            const ctx8 = document.getElementById('chart8').getContext('2d');
            const myChart8 = new Chart(ctx8, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table8']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table8']['rows'],0) as $row):?>
								<?php foreach(array_slice($row,1) as $col):?>
									{x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
								<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table8']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table8']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table8']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart9" ></canvas>
		<script>
            const ctx9 = document.getElementById('chart9').getContext('2d');
            const myChart9 = new Chart(ctx9, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table9']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table9']['rows'],0) as $row):?>
								<?php foreach(array_slice($row,1) as $col):?>
									{x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
								<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table9']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table9']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table9']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-10">
		<canvas id="chart10" ></canvas>
		<script>
            const ctx10 = document.getElementById('chart10').getContext('2d');
            const myChart10 = new Chart(ctx10, {
                type: 'bar',
                data: {
                    labels: [
						<?php foreach($params['charts'] as $c):?>

						<?php endforeach?>
                    ],
                    datasets: [{
                        label: '<?=$params['charts']['table10']['table_name']?>',
                        data: [
							<?php foreach(array_slice($params['charts']['table10']['rows'],0) as $row):?>
								<?php foreach(array_slice($row,1) as $col):?>
									{x: '<?=current($row)?>-<?=$i?>',y:'<?=($col)?>'},
								<?php endforeach?>
							<?php endforeach?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
		</script>
	</div>

	<div class="col-2">
		<div class="row ">
			<div class="col">
				<div class="card card-sheet-name">
					<div class="card-body">
						<?=$params['tables']['table10']['table_name']?>
					</div>
				</div>
			</div>
		</div>
		<div class="table-block">
			<table class=" table table-hover table-border" style="border-style: solid">
				<thead>
				<tr>
					<?php foreach($params['tables']['table10']['header_row'] as $cell):?>
						<th class="header-cell text-start">
							<?=$cell?>
						</th>
					<?php endforeach?>
				</tr>
				</thead>
				<tbody>
				<?php foreach ($params['tables']['table10']['rows'] as $i => $row):?>
					<tr class="" >
						<?php $j=0;?>
						<?php foreach ($row as $colValue):?>
							<td class="cell <?=$j === 0 ? 'header-cell' : ''?>">
								<?=$colValue?>
							</td>
							<?php $j++;?>
						<?php endforeach?>
					</tr>
				<?php endforeach?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<?php require_once BASEPATH.'/views/includes/footer.php';?>
