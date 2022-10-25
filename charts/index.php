<?php
include "vendor/autoload.php";

define('BASEPATH', __DIR__);

if(isset($_REQUEST['upload']) && $_REQUEST['upload'] === 'file')
{
	require_once 'upload.php';
}
else
{
	$excel = new \classes\viewer\Viewer();
	$excel->Render();
}
