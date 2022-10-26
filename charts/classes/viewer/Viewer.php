<?php


namespace classes\viewer;


use Jenssegers\Blade\Blade;

class Viewer
{
	private $blade;
	private $filename;

	public function __construct(){
		//$this->blade = new Blade(BASEPATH.'/views', BASEPATH.'/tmp/cache');
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

	private function getSheetsByFileId($file_id){
		global $wpdb;
		$sheets = $wpdb->get_results(sprintf("select * from charts_sheets where file_id=%d", $file_id), ARRAY_A);

		$data = [];

		foreach ($sheets as $sheet)
		{
			$d['sheet_name'] = $sheet['sheet_name'];
			$d['file_id'] = $sheet['file_id'];
			$d['id'] = $sheet['id'];

			$data[] = $d;
		}

		return $data;
	}

	private function getSheetsByIndex($index, $file_id){
		global $wpdb;

		$sheet = $wpdb->get_results(sprintf("select * from charts_sheets where sheet_index=%d and file_id=%d", $index, $file_id), ARRAY_A);

		$data = [];

		$data['id'] = $sheet[0]['id'];
		$data['file_id'] = $sheet[0]['file_id'];
		$data['header_row'] = json_decode($sheet[0]['sheet'])->header_row;
		$data['rows'] = json_decode($sheet[0]['sheet'])->rows;
		$data['sheet_index'] = $sheet[0]['sheet_index'];

		return $data;
	}

	private function getSheetsById($sheet_id){
		global $wpdb;

		$sheet = $wpdb->get_results(sprintf("select * from charts_sheets where id=%d", $sheet_id), ARRAY_A);

		$data = [];

		$data['id'] = (int)$sheet[0]['id'];
		$data['file_id'] = (int)$sheet[0]['file_id'];
		$data['header_row'] = json_decode($sheet[0]['sheet'])->header_row;
		$data['rows'] = json_decode($sheet[0]['sheet'])->rows;
		$data['sheet_index'] = (int)$sheet[0]['sheet_index'];

		return $data;
	}


	private function renderArchive($files){
		//echo $this->blade->make('pages.home', ['files' => $files])->render();
		require_once BASEPATH.'/views/pages/home.php';
	}

	private function renderFile($sheets, $file_id ){
		$sheet = $this->getSheetsByIndex(0, $file_id);
		$filename = $this->getFileNameById($file_id);

		$params = ['filename' => $filename,'sheets' => $sheets, 'sheet' => $sheet, 'file_id'=>$file_id];
		$this->renderSheet0($params);
	}

	private function renderSheet0($param){
		$sheet = $param['sheet'];
		$data = [];

		$data['id'] = (int)$sheet[0]['id'];
		$data['file_id'] = (int)$param['file_id'];
		$data['header_row'] = $sheet['header_row'];
		$data['rows'] =       $sheet['rows'];
		$data['sheet_index'] = (int)$sheet[0]['sheet_index'];

		$params = [
			'sheets' => $param['sheets'],
			'file_id' => $data['file_id'],
			'sheet' => ['header_row' => $data['header_row'], 'rows' => $data['rows']]
		];

		//echo $this->blade->make('pages.sheet_0', $params)->render();
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
		//
		//echo $this->blade->make('pages.sheet_1', $params)->render();
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


		require_once BASEPATH.'/views/pages/sheet_3.php';
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

	private function renderSheet($sheets, $sheet_id, $file_id){
		$sheet = $this->getSheetsById($sheet_id);
		$filename = $this->getFileNameById($file_id);

		$params = ['filename' => $filename,'sheets' => $sheets, 'sheet' => $sheet, 'file_id'=>$file_id];

		if($sheet['sheet_index'] === 0)
		{
			$this->renderSheet0($params);
		}

		if($sheet['sheet_index'] === 1)
		{
			$this->renderSheet1($params);
		}

		if($sheet['sheet_index'] === 2)
		{
			$this->renderSheet2($params);
		}
	}

	public function Render(){

		if(!isset($_REQUEST['file_id']))
		{
			$files = $this->getFiles();
			$this->renderArchive($files);
		}

		if(isset($_REQUEST['file_id']) && !isset($_REQUEST['sheet']) )
		{
			$file_id = (int)$_REQUEST['file_id'];

			if($file_id !== 0)
			{
				$sheets = $this->getSheetsByFileId($file_id);
				$this->renderFile($sheets, $file_id);
			}
		}

		if(isset($_REQUEST['sheet']) && isset($_REQUEST['file_id']))
		{
			$file_id = (int)$_REQUEST['file_id'];
			$sheets = $this->getSheetsByFileId($file_id);

			$this->renderSheet($sheets, (int)$_REQUEST['sheet'], $file_id);
		}
	}
}
