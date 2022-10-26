
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/wp-content/themes/<?=THEME_NAME?>/charts/public/css/style.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/ju/jq-3.6.0/dt-1.12.1/fc-4.1.0/fh-3.2.4/r-2.3.0/sp-2.0.2/sr-1.1.1/datatables.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/af-2.4.0/b-2.2.3/b-colvis-2.2.3/b-html5-2.2.3/cr-1.5.6/date-1.1.2/fc-4.1.0/fh-3.2.4/kt-2.7.0/r-2.3.0/rg-1.2.0/rr-1.2.8/sc-2.0.7/sb-1.3.4/sp-2.0.2/sl-1.4.0/sr-1.1.1/datatables.min.js"></script>


    <?php if(empty($_REQUEST['tables'])):?>
        <script src="/wp-content/themes/<?=THEME_NAME?>/charts/public/js/tables.js"></script>
    <?php endif;?>

	<?php if($_REQUEST['tables'] === '1'):?>
        <script src="/wp-content/themes/<?=THEME_NAME?>/charts/public/js/tables-1.js"></script>
	<?php endif;?>

	<?php if($_REQUEST['tables'] === '2'):?>
        <script src="/wp-content/themes/<?=THEME_NAME?>/charts/public/js/tables-2.js"></script>
	<?php endif;?>


</head>
<body>
<div class="container-fluid">
