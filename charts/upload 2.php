<?php


if(isset($_FILES['file']))
{
	if (!mkdir($concurrentDirectory = BASEPATH . '/tmp') && !is_dir($concurrentDirectory))
	{
		throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
	}

	$uploadDir = BASEPATH.'/tmp';
	$fileName = basename($_FILES['file']['name']);
	$uploadFile = $uploadDir .'/'. $fileName;

	if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile))
	{
        $excel = new \classes\parser\Parser($uploadFile);
        $excel->Parse($uploadFile, $fileName);

		unlink($uploadFile);
	}
	else
	{
		echo "Possible file upload failed!\n";
	}
}
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div class="justify-content-center">
				<form action="" method="post" enctype="multipart/form-data">
					<div>
						<label for="formFileLg" class="form-label">Load EXCEL file</label>
						<input class="form-control form-control-lg" name="file" id="formFileLg" type="file">
					</div>
					<div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
