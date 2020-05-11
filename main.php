
<?php
require(__DIR__ . "/vendor/autoload.php");
require(__DIR__ . "/schema.php");
require(__DIR__ . "/body_params.php");
require(__DIR__ . "/creds.php");

use GuzzleHttp\Client;

build_new_csv_schema('forms');

function build_new_csv_schema($filename) {
  $req_schema = [];
  $req_schema_arr = []; //instantiate the return array object
//import the CSV data
  $data_schema = new Schema($filename,"records");
//create a 2D indexed array
  $data_table = $data_schema->data_index;
//make the top row of the spreadhseet an array of object keys
  $keys = array_shift($data_table);
//iterate each row
  foreach($data_table as $data_row) {
    $req_schema = BodyParams::form_params($keys,$data_row);
    //$res = rest_request('POST','(not set)',$req_schema);
    error_log("body param return value:\r\n");
    error_log(print(json_encode($req_schema))  . "\r\n");
    $req_schema_arr[] = $req_schema;
  }
  return $req_schema_arr;
}

function rest_request($method,$resource,$schema) {
  $client = new GuzzleHttp\Client();
  $url = Creds::write_rest_url($resource);
  $params = array();
  error_log($url . "\r\n");
  //error_log(print_r($options["headers"]));
  //error_log(print_r($options["body"]));
  error_log(print_r($schema));
  $response = $client->request($method,$url,$schema);
  echo $response->getBody()->read(400);
  return $response;
}
/*

$response = $client->request('POST', '', [
    'form_params' => [
        'field_name' => 'abc',
        'other_field' => '123',
        'nested_field' => [
            'nested' => 'hello'
        ]
    ]
]);
*/
 ?>
