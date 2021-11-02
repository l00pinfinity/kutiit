<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');

include_once '../config/Database.php';
include_once '../models/Tribe.php';

$database = new Database();
$db = $database->connect();

$tribe = new Tribe($db);

$result = $tribe->read();
$num = $result->rowCount();

if ($num > 0) {
  $tribe_arr = array();
  $tribe_arr['data'] = array();
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $tribe_item = array(
      'id' => $id,
      'name' => $name
    );

    //Push to 'data'
    array_push($tribe_arr['data'],$tribe_item);
  }

  //Turn to json
  echo json_encode($tribe_arr);
}else{
  echo json_encode(
    array('message' => 'No tribes added')
  );
}