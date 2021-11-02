<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');
header('Acces-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Proverb.php';

$database = new Database();
$db = $database->connect();

$kutiit = new Proverb($db);

$data = json_decode(file_get_contents("php://input"));

$kutiit->proverb = $data->proverb;
$kutiit->english = $data->english;
$kutiit->meaning = $data->meaning;
$kutiit->tribe_id = $data->tribe_id;

if ($kutiit->create()) {
  echo json_encode(array('message' => 'Proverb added successfully'));
} else {
  echo json_encode(array('message' => 'Proverb not added, try again'));
}
