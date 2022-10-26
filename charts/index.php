<?php
include __DIR__."/vendor/autoload.php";



if(isset($_REQUEST['upload']) && $_REQUEST['upload'] === 'file')
{
	require_once 'upload.php';
}
else
{
	$excel = new \classes\viewer\Viewer();
	$excel->Render();
}
