<?php

namespace classes\viewer;


class Viewer
{
	public function __construct(){

	}

	private function getFiles(){
		global $wpdb;

		return $wpdb->get_results('select * from charts_files', ARRAY_A);
	}

	private function getFileNameById($id){
		global $wpdb;

		$res = $wpdb->get_results(sprintf('select * from charts_files where id = %d', $id), ARRAY_A);

		return $res[0]['filename'];
	}

	private function getAllSheetsByFileId($file_id, $sheet_id = 0){
		global $wpdb;
		$sheets = $wpdb->get_results(sprintf("select * from charts_sheets where file_id=%d order by nav_position asc", $file_id), ARRAY_A);

		$data = [];

		foreach ($sheets as $sheet)
		{
			$d['sheet_name'] = $sheet['sheet_name'];
			$d['nav_title'] = $sheet['nav_title'];
			$d['file_id'] = $sheet['file_id'];
			$d['id'] = $sheet['id'];
			$d['active'] = false;

			if((int)$sheet_id === 0)
			{
				if((int)$sheet['sheet_index'] === 0)
				{
					$d['active'] = true;
				}

			}
			else
			{
				if((int)$sheet_id === (int)$sheet['id'])
				{
					$d['active'] = true;
				}
			}

			$data[] = $d;
		}

		return $data;
	}

	private function composeSheet($sheetFromDb){
		$data = [];

		$data['id'] = $sheetFromDb[0]['id'];
		$data['file_id'] = $sheetFromDb[0]['file_id'];
		$data['header_row'] = json_decode($sheetFromDb[0]['sheet'])->header_row;
		$data['rows'] = json_decode($sheetFromDb[0]['sheet'])->rows;
		$data['sheet_index'] = $sheetFromDb[0]['sheet_index'];
		$data['sheet_name'] = $sheetFromDb[0]['sheet_name'];

		return $data;
	}

	private function getSheetByIndex($index, $file_id, $selected_sheet_id = 0){
		global $wpdb;
		$sheet = $wpdb->get_results(sprintf("select * from charts_sheets where sheet_index=%d and file_id=%d", $index, $file_id), ARRAY_A);
		return $this->composeSheet($sheet);
	}

	private function getSheetById($sheet_id){
		global $wpdb;
		$sheet = $wpdb->get_results(sprintf("select * from charts_sheets where id=%d", $sheet_id), ARRAY_A);
		return $this->composeSheet($sheet);
	}

	private function renderArchive($files){
		require_once BASEPATH.'/views/pages/archive.php';
	}


	private function renderSheet0($param){
		$params = [
			'filename' => $param['filename'],
			'sheets' => $param['sheets'],
			'file_id' => (int)$param['file_id'],
			'sheet_name' => $param['sheet_name'],
			'sheet' => [
				'header_row' => $param['sheet']['header_row'],
				'rows' => $param['sheet']['rows'],
			]
		];


		require_once BASEPATH.'/views/pages/sheet_0.php';
	}

	private function renderSheet1($params){
		global $wpdb;

		$file_id = $params['file_id'];
		$sheet_id = $params['sheet']['id'];

		$tables = $wpdb->get_results(sprintf("select * from charts_sheets where file_id=%d and id=%d", $file_id, $sheet_id), ARRAY_A);
		$images = $wpdb->get_results(sprintf("select * from charts_images where file_id=%d and sheet_id=%d", $file_id, $sheet_id), ARRAY_A);

		$params['tables'] = json_decode($tables[0]['sheet'], 1);
		$params['tables']['table4']['images'][0] = $images[0];
		$params['tables']['table5']['images'][0] = $images[1];

		require_once BASEPATH.'/views/pages/sheet_1.php';
	}

	private function renderSheet2($params){
		global $wpdb;

		$file_id = $params['file_id'];
		$sheet_id = $params['sheet']['id'];

		$tables = $wpdb->get_results(sprintf("select * from charts_sheets where file_id=%d and id=%d", $file_id, $sheet_id), ARRAY_A);
		$charts = $wpdb->get_results(sprintf("select * from charts_charts where file_id=%d and sheet_id=%d", $file_id, $sheet_id), ARRAY_A);

		$params['tables'] = json_decode($tables[0]['sheet'], 1);
		$params['charts'] = json_decode($charts[0]['charts'], 1);

		require_once BASEPATH.'/views/pages/sheet_2.php';
	}

	private function renderSheet3($params){
		global $wpdb;

		$file_id = $params['file_id'];
		$sheet_id = $params['sheet']['id'];

		$tables = $wpdb->get_results(sprintf("select * from charts_sheets where file_id=%d and id=%d", $file_id, $sheet_id), ARRAY_A);
		$charts = $wpdb->get_results(sprintf("select * from charts_charts where file_id=%d and sheet_id=%d", $file_id, $sheet_id), ARRAY_A);

		$params['tables'] = json_decode($tables[0]['sheet'], 1);
		$params['charts'] = json_decode($charts[0]['charts'], 1);

		require_once BASEPATH.'/views/pages/sheet_3.php';
	}

	private function renderSheet11($params){
		global $wpdb;

		$file_id = $params['file_id'];
		$sheet_id = $params['sheet']['id'];

		$images = $wpdb->get_results(sprintf("select * from charts_images where file_id=%d and sheet_id=%d", $file_id, $sheet_id), ARRAY_A);

		$params['images'][0] = $images[0];
		$params['images'][1] = $images[1];

		require_once BASEPATH.'/views/pages/sheet_images.php';
	}

	private function renderSheet($sheets, $file_id, $sheet_id = 0){
		// если не выбрана вкладка, открыть нулевУю.
		if($sheet_id === 0)
			$sheet = $this->getSheetByIndex(0, $file_id);
		else
			$sheet = $this->getSheetById($sheet_id);

		$filename = $this->getFileNameById($file_id);

		$params = [
			'filename' => $filename,
			'sheets' => $sheets,
			'sheet' => $sheet,
			'file_id'=>$file_id
		];

		if((int)$sheet['sheet_index'] === 0)
			$this->renderSheet0($params);

		if((int)$sheet['sheet_index'] === 1)
			$this->renderSheet1($params);

		if((int)$sheet['sheet_index'] === 2)
			$this->renderSheet2($params);

		if((int)$sheet['sheet_index'] === 3)
			$this->renderSheet3($params);

		if((int)$sheet['sheet_index'] === 11)
			$this->renderSheet11($params);
	}

	public function Render(){

		if(!isset($_REQUEST['file_id']))
		{
			$files = $this->getFiles();
			$this->renderArchive($files);
		}

		if(isset($_REQUEST['file_id']))
		{
			$file_id = (int)$_REQUEST['file_id'];
			$sheets = $this->getAllSheetsByFileId($file_id, (int)$_REQUEST['sheet']);

			$this->renderSheet($sheets, $file_id,  (int)$_REQUEST['sheet']);
		}
	}
}
