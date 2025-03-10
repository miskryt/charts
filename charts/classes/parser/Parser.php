<?php

namespace classes\parser;

use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;

class Parser
{
	private $reader;
	private $spreadsheet;
	private $filename;
	private $file_id;
	private $errors;

	public function __construct ($inputFileName, $inputFileType = 'Xlsx')
	{
		$this->reader = IOFactory::createReader($inputFileType);
		$this->reader->setReadEmptyCells(false);
		$this->spreadsheet = $this->reader->load($inputFileName);
	}

	private function getAllSheets(){
		return $this->spreadsheet->getAllSheets();
	}

	private function getAllSheetsNames(){
		return $this->spreadsheet->getSheetNames();
	}

	private function getWorkSheetByName($SheetName){
		return $this->spreadsheet->getSheetByName($SheetName);
	}

	private function getWorkSheetByIndex($index){
		return $this->spreadsheet->getSheet($index);
	}

	private function setFileName($filename){
		$this->filename = $filename;
	}

	private function SaveFileNameToDb($file, $filename)
	{
		global $wpdb;
		$sheets = [];

		$info = $this->reader->listWorksheetInfo($file);

		foreach ($info as $sheet)
		{
			$sheets[] = $sheet['worksheetName'];
		}

		$sheets = json_encode($sheets);

		$wpdb->insert('charts_files', array(
			'filename' => $filename,
			//'sheets' => $sheets
		));

		$this->file_id = $wpdb->insert_id;
	}

	private function getImagesFromSheet($index){
		$i = 0;
		$imgs = [];

		foreach ($this->getWorkSheetByIndex($index)->getDrawingCollection() as $drawing) {
			if ($drawing instanceof MemoryDrawing) {
				ob_start();
				call_user_func(
					$drawing->getRenderingFunction(),
					$drawing->getImageResource()
				);
				$imageContents = ob_get_contents();
				ob_end_clean();
				switch ($drawing->getMimeType()) {
					case MemoryDrawing::MIMETYPE_PNG :
						$extension = 'png';
						break;
					case MemoryDrawing::MIMETYPE_GIF:
						$extension = 'gif';
						break;
					case MemoryDrawing::MIMETYPE_JPEG :
						$extension = 'jpg';
						break;
				}
			} else {
				if ($drawing->getPath()) {

					if ($drawing->getIsURL()) {
						$imageContents = file_get_contents($drawing->getPath());
						$filePath = tempnam(sys_get_temp_dir(), 'Drawing');
						file_put_contents($filePath , $imageContents);
						$mimeType = mime_content_type($filePath);

						$extension = File::mime2ext($mimeType);
						unlink($filePath);
					}
					else {
						$zipReader = fopen($drawing->getPath(),'r');
						$imageContents = '';
						while (!feof($zipReader)) {
							$imageContents .= fread($zipReader,1024);
						}
						fclose($zipReader);
						$extension = $drawing->getExtension();
					}
				}
			}

			$imgs[] = $imageContents;
		}

		return $imgs;
	}


	private function parseSheet0(){
		$data = [];
		$result = [];

		$this->reader->setReadDataOnly(true);

		$sheet = $this->getWorkSheetByIndex(0);
		if($sheet === null)
		{
			throw new Exception('getWorkSheetByIndex returned empty');
		}

		$headerRow = $sheet->getRowIterator(4)->current();
		if($headerRow === null)
		{
			throw new Exception('getRowIterator(4)->current() returned empty');
		}

		foreach ($headerRow->getCellIterator() as $cell){
			if(!empty($cell->getValue()))
				$data['header_row'][] = $cell->getValue();
		}

		foreach (array_slice($sheet->toArray(), 4) as $i => $row ){
			$cells = [];

			foreach ($row as $cell)
			{
				if(!empty($cell))
					$cells[] = $cell;
			}

			$data['rows'][] = $cells;
		}

		if(empty($data))
		{
			throw new Exception('sheet 0 was not parsed');
		}

		$result['data'] = json_encode($data);
		$result['sheet_name'] = 'Bet Frequency Averages';//$this->getWorkSheetByIndex(0)->getTitle();
		$result['nav_title'] = 'Raw Data';

		return $result;
	}

	private function parseImages($sheet_index = 1){
		$this->reader->setReadDataOnly(true);

		$table4 = $this->getWorkSheetByIndex($sheet_index)->rangeToArray('A55:E56', NULL, TRUE, TRUE, TRUE);
		$table5 = $this->getWorkSheetByIndex($sheet_index)->rangeToArray('A78:E78', NULL, TRUE, TRUE, TRUE);


		try{
			$this->reader->setReadDataOnly(false);
			$images = $this->getImagesFromSheet($sheet_index);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing images from sheet'.$sheet_index.': '.$e->getMessage());
		}

		$sheet = [
			'data' => [],
			'nav_title' => 'Ranges',
			'sheet_name' => ''
		];

		$images =
			[
				[
					'image' => $images[0],
					'image_name' => $table4[55]['A']
				],
				[
					'image' => $images[1],
					'image_name' => $table5[78]['A']
				]
			];


		return [
			'images' => $images,
			'sheet' => $sheet,
		];
	}

	// many tables with images
	private function parseSheet1(){
		$this->reader->setReadDataOnly(true);

		try{
			$table1 = $this->getWorkSheetByIndex(1)->rangeToArray('A1:G17', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(1)->rangeToArray('A19:G35', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(1)->rangeToArray('A37:H53', NULL, TRUE, TRUE, TRUE);

			//$table4 = $this->getWorkSheetByIndex(1)->rangeToArray('A55:E56', NULL, TRUE, TRUE, TRUE);
			//$table5 = $this->getWorkSheetByIndex(1)->rangeToArray('A78:E78', NULL, TRUE, TRUE, TRUE);

			//$table6 = $this->getWorkSheetByIndex(1)->rangeToArray('K1:R40', NULL, TRUE, TRUE, TRUE);
			//$table7 = $this->getWorkSheetByIndex(1)->rangeToArray('T1:AA40', NULL, TRUE, TRUE, TRUE);
			//$table8 = $this->getWorkSheetByIndex(1)->rangeToArray('AC1:AJ40', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing sheet1: '.$e->getMessage());
		}

		$data['table1']['table_name'] = $table1[1]['A'];
		$data['table1']['header_row'] = array_slice($table1, 1)[0];
		$data['table1']['rows'] = array_slice(array_slice($table1, 1), 1);

		$data['table2']['table_name'] = $table2[19]['A'];
		$data['table2']['header_row'] = array_slice($table2, 1)[0];
		$data['table2']['rows'] = array_slice(array_slice($table2, 1), 1);

		$data['table3']['table_name'] = $table3[37]['A'];
		$data['table3']['header_row'] = array_slice($table3, 1)[0];
		$data['table3']['rows'] = array_slice(array_slice($table3, 1), 1);

		/*
		$data['table4']['table_name'] = $table4[55]['A'];
		$data['table4']['header_row'] = array_slice($table4, 1)[0];
		$data['table4']['rows'] = array_slice(array_slice($table4, 1), 1);

		$data['table5']['table_name'] = $table5[78]['A'];
		$data['table5']['header_row'] = array_slice($table5, 1)[0];
		$data['table5']['rows'] = array_slice(array_slice($table5, 1), 1);
		*/

		/*
		$data['table6']['table_name'] = '';
		$data['table6']['header_row'] = array_slice($table6, 0)[0];
		$data['table6']['rows'] = array_slice(array_slice($table6, 1), 1);

		$data['table7']['table_name'] = '';
		$data['table7']['header_row'] = array_slice($table7, 0)[0];
		$data['table7']['rows'] = array_slice(array_slice($table7, 1), 1);

		$data['table8']['table_name'] = '';
		$data['table8']['header_row'] = array_slice($table8, 0)[0];
		$data['table8']['rows'] = array_slice(array_slice($table8, 1), 1);
		*/

		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(1)->getTitle();
		$data['nav_title'] = $this->getWorkSheetByIndex(1)->getTitle();

		return $data;
	}

	// charts sheet 1
	private function parseSheet2(){
		$this->reader->setReadDataOnly(true);

		try
		{
			$table1 = $this->getWorkSheetByIndex(2)->rangeToArray('AB1:AC16', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(2)->rangeToArray('AB33:AC48', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(2)->rangeToArray('AB63:AC78', NULL, TRUE, TRUE, TRUE);
			$table4 = $this->getWorkSheetByIndex(2)->rangeToArray('AB93:AC108', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(2)->rangeToArray('AB124:AC139', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing sheet2: '.$e->getMessage());
		}

		$data['table1']['table_name'] = $table1[1]['AB'];
		$data['table1']['header_row'][] = $table1[1]['AB'];
		$data['table1']['rows'] = array_slice(array_slice($table1, 1), 0);

		$data['table2']['table_name'] = $table2[33]['AB'];
		$data['table2']['header_row'][] = $table2[33]['AB'];
		$data['table2']['rows'] = array_slice(array_slice($table2, 1), 0);

		$data['table3']['table_name'] = $table3[63]['AB'];
		$data['table3']['header_row'][] = $table3[63]['AB'];
		$data['table3']['rows'] = array_slice(array_slice($table3, 1), 0);

		$data['table4']['table_name'] = $table4[93]['AB'];
		$data['table4']['header_row'][] = $table4[93]['AB'];
		$data['table4']['rows'] = array_slice(array_slice($table4, 1), 0);

		$data['table5']['table_name'] = $table5[124]['AB'];
		$data['table5']['header_row'][] = $table5[124]['AB'];
		$data['table5']['rows'] = array_slice(array_slice($table5, 1), 0);


		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(2)->getTitle();
		$data['nav_title'] = $this->getWorkSheetByIndex(2)->getTitle();


		return $data;
	}

	// charts sheet 2
	private function parseSheet3(){
		$this->reader->setReadDataOnly(true);

		try
		{
			$table1 = $this->getWorkSheetByIndex(3)->rangeToArray('AE1:AF16', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(3)->rangeToArray('AE34:AF49', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(3)->rangeToArray('AE65:AF80', NULL, TRUE, TRUE, TRUE);
			$table4 = $this->getWorkSheetByIndex(3)->rangeToArray('AE97:AF112', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(3)->rangeToArray('AE129:AF144', NULL, TRUE, TRUE, TRUE);
			$table6 = $this->getWorkSheetByIndex(3)->rangeToArray('AE161:AF176', NULL, TRUE, TRUE, TRUE);
			$table7 = $this->getWorkSheetByIndex(3)->rangeToArray('AE193:AF208', NULL, TRUE, TRUE, TRUE);
			$table8 = $this->getWorkSheetByIndex(3)->rangeToArray('AE225:AF240', NULL, TRUE, TRUE, TRUE);
			$table9 = $this->getWorkSheetByIndex(3)->rangeToArray('AE257:AF272', NULL, TRUE, TRUE, TRUE);
			$table10 = $this->getWorkSheetByIndex(3)->rangeToArray('AE289:AF304', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing sheet2: '.$e->getMessage());
		}

		$data['table1']['table_name'] = $table1[1]['AE'];
		$data['table1']['header_row'][] = $table1[1]['AE'];
		$data['table1']['rows'] = array_slice(array_slice($table1, 1), 1);

		$data['table2']['table_name'] = $table2[34]['AE'];
		$data['table2']['header_row'][] = $table2[34]['AE'];
		$data['table2']['rows'] = array_slice(array_slice($table2, 1), 1);

		$data['table3']['table_name'] = $table3[65]['AE'];
		$data['table3']['header_row'][] = $table3[65]['AE'];
		$data['table3']['rows'] = array_slice(array_slice($table3, 1), 1);

		$data['table4']['table_name'] = $table4[97]['AE'];
		$data['table4']['header_row'][] = $table4[97]['AE'];
		$data['table4']['rows'] = array_slice(array_slice($table4, 1), 1);

		$data['table5']['table_name'] = $table5[129]['AE'];
		$data['table5']['header_row'][] = $table5[129]['AE'];
		$data['table5']['rows'] = array_slice(array_slice($table5, 1), 1);

		$data['table6']['table_name'] = $table6[161]['AE'];
		$data['table6']['header_row'][] = $table6[161]['AE'];
		$data['table6']['rows'] = array_slice(array_slice($table6, 1), 1);

		$data['table7']['table_name'] = $table7[193]['AE'];
		$data['table7']['header_row'][] = $table7[193]['AE'];
		$data['table7']['rows'] = array_slice(array_slice($table7, 1), 1);

		$data['table8']['table_name'] = $table8[225]['AE'];
		$data['table8']['header_row'][] = $table8[225]['AE'];
		$data['table8']['rows'] = array_slice(array_slice($table8, 1), 1);

		$data['table9']['table_name'] = $table9[257]['AE'];
		$data['table9']['header_row'][] = $table9[257]['AE'];
		$data['table9']['rows'] = array_slice(array_slice($table9, 1), 1);

		$data['table10']['table_name'] = $table10[289]['AE'];
		$data['table10']['header_row'][] = $table10[289]['AE'];
		$data['table10']['rows'] = array_slice(array_slice($table10, 1), 1);


		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(3)->getTitle();
		$data['nav_title'] = $this->getWorkSheetByIndex(3)->getTitle();


		return $data;
	}

	private function parseChartsSheet2(){
		$this->reader->setReadDataOnly(true);

		try
		{
			$table1 = $this->getWorkSheetByIndex(1)->rangeToArray('A2:F17', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(1)->rangeToArray('K1:P15', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(1)->rangeToArray('K16:Q29', NULL, TRUE, TRUE, TRUE);
			$table4 = $this->getWorkSheetByIndex(1)->rangeToArray('K30:Q37', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(1)->rangeToArray('K38:Q40', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing charts: '.$e->getMessage());
		}

		$tbl2 = [];
		foreach (array_slice($table2, 1) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl2[] = $v;
		}

		$tbl3 = [];
		foreach (array_slice($table3, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl3[] = $v;
		}

		$tbl4 = [];
		foreach (array_slice($table4, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl4[] = $v;
		}

		$tbl5 = [];
		foreach (array_slice($table5, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl5[] = $v;
		}


		$headers = $this->getWorkSheetByIndex(1)->rangeToArray('M1:Q1', NULL, TRUE, TRUE, TRUE);

		$data['table1']['table_name'] = 'Overall Betting Averages';
		$data['table1']['header_row'][] = $headers;
		$data['table1']['rows'] = array_slice($table1, 1);

		$data['table2']['table_name'] = 'A High Boards';
		$data['table2']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('M1:P1', NULL, TRUE, TRUE, TRUE);;
		$data['table2']['rows'] = $tbl2;

		$data['table3']['table_name'] = 'Broadway Boards';
		$data['table3']['header_row'][] = $headers;
		$data['table3']['rows'] = $tbl3;

		$data['table4']['table_name'] = 'Mid Boards';
		$data['table4']['header_row'][] = $headers;
		$data['table4']['rows'] = $tbl4;

		$data['table5']['table_name'] = 'Low Boards';
		$data['table5']['header_row'][] = $headers;
		$data['table5']['rows'] = $tbl5;



		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(2)->getTitle();
		$data['nav_title'] = $this->getWorkSheetByIndex(2)->getTitle();

		return $data;
	}

	private function parseChartsSheet3(){
		$this->reader->setReadDataOnly(true);

		try
		{
			$table1 = $this->getWorkSheetByIndex(1)->rangeToArray('A39:G53', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(1)->rangeToArray('A21:F35', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(1)->rangeToArray('T2:AA15', NULL, TRUE, TRUE, TRUE);
			$table4 = $this->getWorkSheetByIndex(1)->rangeToArray('AC2:AI15', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(1)->rangeToArray('T16:AA29', NULL, TRUE, TRUE, TRUE);
			$table6 = $this->getWorkSheetByIndex(1)->rangeToArray('AC16:AI29', NULL, TRUE, TRUE, TRUE);
			$table7 = $this->getWorkSheetByIndex(1)->rangeToArray('T30:AA37', NULL, TRUE, TRUE, TRUE);
			$table8 = $this->getWorkSheetByIndex(1)->rangeToArray('AC30:AI37', NULL, TRUE, TRUE, TRUE);
			$table9 = $this->getWorkSheetByIndex(1)->rangeToArray('T38:AA40', NULL, TRUE, TRUE, TRUE);
			$table10 = $this->getWorkSheetByIndex(1)->rangeToArray('AC38:AI40', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing charts: '.$e->getMessage());
		}


		$tbl3 = [];
		foreach (array_slice($table3, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl3[] = $v;
		}

		$tbl4 = [];
		foreach (array_slice($table4, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl4[] = $v;
		}

		$tbl5 = [];
		foreach (array_slice($table5, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl5[] = $v;
		}

		$tbl6 = [];
		foreach (array_slice($table6, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl6[] = $v;
		}

		$tbl7 = [];
		foreach (array_slice($table7, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl7[] = $v;
		}

		$tbl8 = [];
		foreach (array_slice($table8, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl8[] = $v;
		}

		$tbl9 = [];
		foreach (array_slice($table9, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl9[] = $v;
		}

		$tbl10 = [];
		foreach (array_slice($table10, 0) as $item)
		{
			$v = array_merge(array_slice($item, 0, 1), array_slice($item, 2));
			$tbl10[] = $v;
		}


		$data['table1']['table_name'] = 'Overall EV and EQR Averages ';
		$data['table1']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('B38:G38', NULL, TRUE, TRUE, TRUE);;
		$data['table1']['rows'] = array_slice(array_slice($table1, 0), 1);

		$data['table2']['table_name'] = 'EV Averages By Bet Size';
		$data['table2']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('B20:F20', NULL, TRUE, TRUE, TRUE);;
		$data['table2']['rows'] = array_slice(array_slice($table2, 0), 1);

		$data['table3']['table_name'] = 'A High Board EV and EQR Averages';
		$data['table3']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('V1:AA1', NULL, TRUE, TRUE, TRUE);;
		$data['table3']['rows'] = $tbl3;

		$data['table4']['table_name'] = 'A High Board EV Averages By Bet Size';
		$data['table4']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('AE1:AI1', NULL, TRUE, TRUE, TRUE);;
		$data['table4']['rows'] = $tbl4;

		$data['table5']['table_name'] = 'Broadway Board EV and EQR Averages';
		$data['table5']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('V1:AA1', NULL, TRUE, TRUE, TRUE);;
		$data['table5']['rows'] = $tbl5;

		$data['table6']['table_name'] = 'Broadway Board EV Averages By Bet Size';
		$data['table6']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('AE1:AI1', NULL, TRUE, TRUE, TRUE);;
		$data['table6']['rows'] = $tbl6;

		$data['table7']['table_name'] = 'Mid Board EV and EQR Averages';
		$data['table7']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('V1:AA1', NULL, TRUE, TRUE, TRUE);;
		$data['table7']['rows'] = $tbl7;

		$data['table8']['table_name'] = 'Mid Board EV Averages By Bet Size';
		$data['table8']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('AE1:AI1', NULL, TRUE, TRUE, TRUE);;
		$data['table8']['rows'] = $tbl8;

		$data['table9']['table_name'] = 'Low Board EV and EQR Averages';
		$data['table9']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('V1:AA1', NULL, TRUE, TRUE, TRUE);;
		$data['table9']['rows'] = $tbl9;

		$data['table10']['table_name'] = 'Low Board EV Averages By Bet Size ';
		$data['table10']['header_row'][] = $this->getWorkSheetByIndex(1)->rangeToArray('AE1:AI1', NULL, TRUE, TRUE, TRUE);;
		$data['table10']['rows'] = $tbl10;



		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(3)->getTitle();
		$data['nav_title'] = $this->getWorkSheetByIndex(3)->getTitle();

		return $data;
	}

	private function saveSheetToDb($data, $index, $nav_position,  $tableName=''){
		global $wpdb;

		$ret = $wpdb->insert('charts_sheets', array(
			'sheet' => $data['data'],
			'sheet_name' => $data['sheet_name'],
			'nav_title' => $data['nav_title'],
			'table_name' => $tableName,
			'file_id' => $this->file_id,
			'sheet_index' => $index,
			'nav_position' => $nav_position
		));

		return $wpdb->insert_id;
	}

	private function saveChartsToDb($data, $sheet_id, $index, $tableName=''){
		global $wpdb;

		$ret = $wpdb->insert('charts_charts', array(
			'charts' => $data['data'],
			'sheet_name' => $data['sheet_name'],
			'table_name' => $tableName,
			'file_id' => $this->file_id,
			'sheet_index' => $index,
			'sheet_id' => $sheet_id
		));

		return $wpdb->insert_id;
	}

	private function saveImagesToDb($data, $nav_position){
		global $wpdb;

		//var_dump($data);die();\

		$ret = $wpdb->insert('charts_sheets', array(
			'file_id' => $this->file_id,
			'sheet' => '',
			'table_name' => '',
			'sheet_index' => '11',
			'nav_title' => $data['sheet']['nav_title'],
			'nav_position' => $nav_position
		));

		$sheet_id = $wpdb->insert_id;

		foreach ($data['images'] as $image){
			$ret = $wpdb->insert('charts_images', array(
				'file_id' => $this->file_id,
				'sheet_id' => $sheet_id,
				'image_name' => $image['image_name'],
				'image' => $image['image'],
			));

		}

	}

	public function Parse($file, $filename){
		$this->setFileName($filename);

		try{
			$sheet0ToSave = $this->parseSheet0();
			$sheet1ToSave = $this->parseSheet1();

			$imagesToSave = $this->parseImages();

			$sheet2ToSave = $this->parseSheet2();
			$chartsSheet2ToSave = $this->parseChartsSheet2();

			$sheet3ToSave = $this->parseSheet3();
			$chartsSheet3ToSave = $this->parseChartsSheet3();
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing sheets: '.$e->getMessage());
		}

		$this->SaveFileNameToDb($file, $filename);

		$this->saveImagesToDb($imagesToSave, 0);

		$this->saveSheetToDb($sheet0ToSave, 0,1, 'Bet Frequency Averages');

		$this->saveSheetToDb($sheet1ToSave, 1, 2);

		$sheet2_id = $this->saveSheetToDb($sheet2ToSave, 2,3,'Bet Freq Graphs');
		$this->saveChartsToDb($chartsSheet2ToSave, $sheet2_id, 2);

		$sheet3_id = $this->saveSheetToDb($sheet3ToSave, 3,4, 'EV and EQR Graphs');
		$this->saveChartsToDb($chartsSheet3ToSave, $sheet3_id, 3);


		return true;
	}
}
