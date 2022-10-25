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
			$data['header_row'][] = $cell->getValue();
		}

		foreach (array_slice($sheet->toArray(), 4) as $i => $row ){
			$cells = [];

			foreach ($row as $cell)
			{
				$cells[] = $cell;
			}

			$data['rows'][] = $cells;
		}

		if(empty($data))
		{
			throw new Exception('sheet 0 was not parsed');
		}

		$result['data'] = json_encode($data);
		$result['sheet_name'] = $this->getWorkSheetByIndex(0)->getTitle();

		return $result;
	}

	private function parseSheet1(){
		$this->reader->setReadDataOnly(true);

		try{
			$table1 = $this->getWorkSheetByIndex(1)->rangeToArray('A1:G17', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(1)->rangeToArray('A19:G35', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(1)->rangeToArray('A37:H53', NULL, TRUE, TRUE, TRUE);

			$table4 = $this->getWorkSheetByIndex(1)->rangeToArray('A55:E56', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(1)->rangeToArray('A78:E78', NULL, TRUE, TRUE, TRUE);

			$table6 = $this->getWorkSheetByIndex(1)->rangeToArray('K1:R40', NULL, TRUE, TRUE, TRUE);
			$table7 = $this->getWorkSheetByIndex(1)->rangeToArray('T1:AA40', NULL, TRUE, TRUE, TRUE);
			$table8 = $this->getWorkSheetByIndex(1)->rangeToArray('AC1:AJ40', NULL, TRUE, TRUE, TRUE);
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

		$data['table4']['table_name'] = $table4[55]['A'];
		$data['table4']['header_row'] = array_slice($table4, 1)[0];
		$data['table4']['rows'] = array_slice(array_slice($table4, 1), 1);

		$data['table5']['table_name'] = $table5[78]['A'];
		$data['table5']['header_row'] = array_slice($table5, 1)[0];
		$data['table5']['rows'] = array_slice(array_slice($table5, 1), 1);

		$data['table6']['table_name'] = '';
		$data['table6']['header_row'] = array_slice($table6, 0)[0];
		$data['table6']['rows'] = array_slice(array_slice($table6, 1), 1);

		$data['table7']['table_name'] = '';
		$data['table7']['header_row'] = array_slice($table7, 0)[0];
		$data['table7']['rows'] = array_slice(array_slice($table7, 1), 1);

		$data['table8']['table_name'] = '';
		$data['table8']['header_row'] = array_slice($table8, 0)[0];
		$data['table8']['rows'] = array_slice(array_slice($table8, 1), 1);

		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(1)->getTitle();

		return $data;
	}

	private function parseImages($sheet_index = 1){
		$this->reader->setReadDataOnly(false);

		try{
			$images = $this->getImagesFromSheet($sheet_index);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing images from sheet'.$sheet_index.': '.$e->getMessage());
		}

		$sheetName = $this->getWorkSheetByIndex($sheet_index)->getTitle();

		return [
			'data' => $images,
			'sheet_name' => $sheetName
			];
	}

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
		$data['table1']['rows'] = array_slice(array_slice($table1, 1), 1);

		$data['table2']['table_name'] = $table2[33]['AB'];
		$data['table2']['header_row'][] = $table2[33]['AB'];
		$data['table2']['rows'] = array_slice(array_slice($table2, 1), 1);

		$data['table3']['table_name'] = $table3[63]['AB'];
		$data['table3']['header_row'][] = $table3[63]['AB'];
		$data['table3']['rows'] = array_slice(array_slice($table3, 1), 1);

		$data['table4']['table_name'] = $table4[93]['AB'];
		$data['table4']['header_row'][] = $table4[93]['AB'];
		$data['table4']['rows'] = array_slice(array_slice($table4, 1), 1);

		$data['table5']['table_name'] = $table5[124]['AB'];
		$data['table5']['header_row'][] = $table5[124]['AB'];
		$data['table5']['rows'] = array_slice(array_slice($table5, 1), 1);


		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(2)->getTitle();


		return $data;
	}

	private function parseCharts(){
		$this->reader->setReadDataOnly(true);

		try
		{
			$table1 = $this->getWorkSheetByIndex(1)->rangeToArray('A2:F17', NULL, TRUE, TRUE, TRUE);
			$table2 = $this->getWorkSheetByIndex(1)->rangeToArray('K1:Q15', NULL, TRUE, TRUE, TRUE);
			$table3 = $this->getWorkSheetByIndex(1)->rangeToArray('K16:Q29', NULL, TRUE, TRUE, TRUE);
			$table4 = $this->getWorkSheetByIndex(1)->rangeToArray('K30:Q37', NULL, TRUE, TRUE, TRUE);
			$table5 = $this->getWorkSheetByIndex(1)->rangeToArray('K38:Q40', NULL, TRUE, TRUE, TRUE);
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing charts: '.$e->getMessage());
		}



		$data['table1']['table_name'] = 'Overall Betting Averages';
		$data['table1']['header_row'][] = '';
		$data['table1']['rows'] = array_slice(array_slice($table1, 0), 1);

		$data['table2']['table_name'] = 'A High Boards';
		$data['table2']['header_row'][] = '';
		$data['table2']['rows'] = array_slice(array_slice($table2, 0), 1);

		$data['table3']['table_name'] = 'Broadway Boards';
		$data['table3']['header_row'][] = '';
		$data['table3']['rows'] = array_slice(array_slice($table3, 0), 1);

		$data['table4']['table_name'] = 'Mid Boards';
		$data['table4']['header_row'][] = '';
		$data['table4']['rows'] = array_slice(array_slice($table4, 0), 1);

		$data['table5']['table_name'] = 'Low Boards';
		$data['table5']['header_row'][] = '';
		$data['table5']['rows'] = array_slice(array_slice($table5, 0), 1);



		$data['data'] = json_encode($data);
		$data['sheet_name'] = $this->getWorkSheetByIndex(2)->getTitle();

		return $data;
	}

	private function saveSheetToDb($data, $index, $tableName=''){
		global $wpdb;

		$ret = $wpdb->insert('charts_sheets', array(
			'sheet' => $data['data'],
			'sheet_name' => $data['sheet_name'],
			'table_name' => $tableName,
			'file_id' => $this->file_id,
			'sheet_index' => $index
		));

		return $wpdb->insert_id;
	}

	private function saveChartsToDb($data, $index, $tableName=''){
		global $wpdb;

		$ret = $wpdb->insert('charts_charts', array(
			'charts' => $data['data'],
			'sheet_name' => $data['sheet_name'],
			'table_name' => $tableName,
			'file_id' => $this->file_id,
			'sheet_index' => $index
		));

		return $wpdb->insert_id;
	}

	private function saveImagesToDb($data, $sheet_id, $sheet_index){
		global $wpdb;

		foreach ($data['data'] as $image){
			$ret = $wpdb->insert('charts_images', array(
				'sheet_name' => $data['sheet_name'],
				'file_id' => $this->file_id,
				'image' => $image,
				'sheet_id' => $sheet_id
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
			$chartsToSave = $this->parseCharts();
			//die();
		}
		catch(\PhpOffice\PhpSpreadsheet\Reader\Exception $e){
			die('Error parsing sheets: '.$e->getMessage());
		}

		$this->SaveFileNameToDb($file, $filename);
		$this->saveSheetToDb($sheet0ToSave, 0,'Bet Frequency Averages');
		$sheet_id = $this->saveSheetToDb($sheet1ToSave, 1 );
		$this->saveImagesToDb($imagesToSave, $sheet_id, 1);
		$this->saveSheetToDb($sheet2ToSave, 2,'Bet Freq Graphs');
		$this->saveChartsToDb($chartsToSave, 2);




		return true;
	}
}
