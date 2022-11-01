<?php require_once BASEPATH . '/views/includes/header.php'; ?>
<?php require_once BASEPATH . '/views/includes/navbar.php'; ?>

<script>
  $(document).ready(function () {
    var table = $('.table').DataTable({
      paging: false,
      fixedHeader: true,
      scrollX: true,
      orderCellsTop: true,
      "processing": true,
      searching: false,
      order: [],
    });
  });

  const CHART_COLORS = {
      red: 'rgb(255, 99, 132)',
      orange: 'rgb(255, 159, 64)',
      blue: 'rgb(54, 162, 235)',
      yellow: 'rgb(255, 205, 86)',


      green: 'rgb(75, 192, 192)',
      purple: 'rgb(153, 102, 255)',
      grey: 'rgb(201, 203, 207)'
  };

  const NAMED_COLORS = [
      CHART_COLORS.red,
      CHART_COLORS.orange,
      CHART_COLORS.blue,
      CHART_COLORS.yellow,


      CHART_COLORS.green,
      CHART_COLORS.purple,
      CHART_COLORS.grey,
  ];
</script>


<h5><?= $params['sheet']['sheet_name'] ?></h5>

<div class="charts-wrapper sheet_3">

    <div class="row">
    <div class="col-10">
      <div class="table-table_name">
        <?= $params['charts']['table1']['table_name'] ?>
      </div>
      <canvas id="chart1"></canvas>
        <script>
            const ctx1 = document.getElementById('chart1').getContext('2d');
            const myChart1 = new Chart(ctx1, {
                type: 'bar',
                data: {
                    labels:
                        [

                        ],
                    datasets:
                        [
							<?php foreach ($params['charts']['table1']['header_row'][0] as $hr):?>
							<?php $color = 0;?>
							<?php foreach ($hr as $h):

							?>

                            {
                                label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                backgroundColor: NAMED_COLORS[<?=$color?>],
                                borderColor: 'rgb(255, 99, 132)',
                                data:
                                    [
										<?php foreach(array_slice($params['charts']['table1']['rows'], 0) as $row):?>
										<?php foreach(array_slice($row, 1) as $col):?>
                                        {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
        <table class=" table table-hover table-border" style="border-style: solid">
          <thead>
          <tr>
            <th class="header-cell text-start">Board Type</th>
            <th class="header-cell text-start">Board Count</th>
          </tr>
          </thead>
          <tbody>
          <?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table2']['table_name'] ?>
            </div>
            <canvas id="chart2"></canvas>
            <script>
                const ctx2 = document.getElementById('chart2').getContext('2d');
                const myChart2 = new Chart(ctx2, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table2']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table2']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table3']['table_name'] ?>
            </div>
            <canvas id="chart3"></canvas>
            <script>
                const ctx3 = document.getElementById('chart3').getContext('2d');
                const myChart3 = new Chart(ctx3, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table3']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table3']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table4']['table_name'] ?>
            </div>
            <canvas id="chart4"></canvas>
            <script>
                const ctx4 = document.getElementById('chart4').getContext('2d');
                const myChart4 = new Chart(ctx4, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table4']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table4']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table5']['table_name'] ?>
            </div>
            <canvas id="chart5"></canvas>
            <script>
                const ctx5 = document.getElementById('chart5').getContext('2d');
                const myChart5 = new Chart(ctx5, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table5']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table5']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table6']['table_name'] ?>
            </div>
            <canvas id="chart6"></canvas>
            <script>
                const ctx6 = document.getElementById('chart6').getContext('2d');
                const myChart6 = new Chart(ctx6, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table6']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table6']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table7']['table_name'] ?>
            </div>
            <canvas id="chart7"></canvas>
            <script>
                const ctx7 = document.getElementById('chart7').getContext('2d');
                const myChart7 = new Chart(ctx7, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table7']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table7']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table8']['table_name'] ?>
            </div>
            <canvas id="chart8"></canvas>
            <script>
                const ctx8 = document.getElementById('chart8').getContext('2d');
                const myChart8 = new Chart(ctx8, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table8']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table8']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table9']['table_name'] ?>
            </div>
            <canvas id="chart9"></canvas>
            <script>
                const ctx9 = document.getElementById('chart9').getContext('2d');
                const myChart9 = new Chart(ctx9, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table9']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table9']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

    <div class="row">
        <div class="col-10">
            <div class="table-table_name">
				<?= $params['charts']['table10']['table_name'] ?>
            </div>
            <canvas id="chart10"></canvas>
            <script>
                const ctx10 = document.getElementById('chart10').getContext('2d');
                const myChart10 = new Chart(ctx10, {
                    type: 'bar',
                    data: {
                        labels:
                            [

                            ],
                        datasets:
                            [
								<?php foreach ($params['charts']['table10']['header_row'][0] as $hr):?>
								<?php $color = 0;?>
								<?php foreach ($hr as $h):

								?>

                                {
                                    label: '<?=($h !== '\\') ? $h : 'CHECH Freq'?>',
                                    backgroundColor: NAMED_COLORS[<?=$color?>],
                                    borderColor: 'rgb(255, 99, 132)',
                                    data:
                                        [
											<?php foreach(array_slice($params['charts']['table10']['rows'], 0) as $row):?>
											<?php foreach(array_slice($row, 1) as $col):?>
                                            {x: '<?=current($row)?>', y: '<?=($col)?>'},
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
                <table class=" table table-hover table-border" style="border-style: solid">
                    <thead>
                    <tr>
                        <th class="header-cell text-start">Board Type</th>
                        <th class="header-cell text-start">Board Count</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php foreach ($params['tables']['table1']['rows'] as $i => $row): ?>
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

</div>
<?php require_once BASEPATH . '/views/includes/footer.php'; ?>
