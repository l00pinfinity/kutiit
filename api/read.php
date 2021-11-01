<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');

include_once '../config/Database.php';
include_once '../models/Proverb.php';

$database = new Database();
$db = $database->connect();

$kutiit = new Proverb($db);

$result = $kutiit->read();
$num = $result->rowCount();

if ($num > 0) {
  $proverb_arr = array();
  $proverb_arr['data'] = array();
  while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $proverb_item = array(
      'id' => $id,
      'proverb' => $proverb,
      'english' => html_entity_decode($english),
      'meaning' => html_entity_decode($meaning),
      'tribe' => $tribe_name
    );

    //Push to 'data'
    array_push($proverb_arr['data'],$proverb_item);
  }

  //Turn to json
  echo json_encode($proverb_arr);
}else{
  echo json_encode(
    array('message' => 'No proverbs currently')
  );
}