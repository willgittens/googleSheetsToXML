<?php

require_once __DIR__ . '/vendor/autoload.php';

define( "API_KEY","HERE-YOUR-GOOGLE-API-CONSOLE-KEY" );
define( "API_NAME","HERE-THE-NAME-OF-YOUR-API-PROJECT" );

define( "ID_SPREADSHEET","HERE-THE-ID-OF-SPREADSHEET" );
define( "RANGE_SPREADSHEET","A:E" );

class GoogleSheetsToXML{

		private $resultSheet;
		private $resultCells;

		private function checkAuth() {
					$client = new Google_Client();
					$client->setApplicationName(API_NAME);
					$client->setDeveloperKey(API_KEY);
					return $client;
		}

		private function arrayResult( $tab ){
					$client = $this->checkAuth();
					$service = new Google_Service_Sheets($client);

					$spreadsheetId = ID_SPREADSHEET;
					$range = $tab."!".RANGE_SPREADSHEET;

					$response = $service->spreadsheets_values->get($spreadsheetId, $range);
					$values = $response->getValues();

					$this->resultSheet = array_reverse($values);
					array_pop( $this->resultSheet );
					$this->resultSheet = array_reverse( $this->resultSheet );

					$this->resultCells = $values[0];
		}

		public function generateXML( $tabSpreadSheet ){

					$this->arrayResult( $tabSpreadSheet );

					$count = 0;

					$result = '<'.$tabSpreadSheet.'>';

					foreach ( $this->resultSheet as $key ) {
						
							$result .= '<item>';

										foreach ( $this->resultCells as $key2 ) {
												
												$result .= '<'.$key2.'>';
												
												if( strpos( $key[$count], "<" ) !== false || strpos( $key[$count], ">" ) !== false || strpos( $key[$count], "/" ) !== false ){

													$result .= "<![CDATA[";

												}	
													$result .= $key[$count];

												if( strpos( $key[$count], "<" ) !== false || strpos( $key[$count], ">" ) !== false || strpos( $key[$count], "/" ) !== false ){

													$result .= "]]>";

												}

												$result .= '</'.$key2.'>';

												$count++;

										}	

							$result .= '</item>';	
							$count = 0;

					}

					$result .= '</'.$tabSpreadSheet.'>';

				    header('Access-Control-Allow-Origin: *'); 
				    header("Content-type: text/xml; charset=utf-8");
				    echo $result;					

		}	

}