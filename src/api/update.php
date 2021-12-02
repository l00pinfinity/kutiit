<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');
header('Acces-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Proverb.php';

$database = new Database();
$db = $database->connect();

$kutiit = new Proverb($db);

$data = json_decode(file_get_contents("php://input"));

$kutiit->id = $data->id;

$kutiit->proverb = $data->proverb;
$kutiit->english = $data->english;
$kutiit->meaning = $data->meaning;
$kutiit->tribe_id = $data->tribe_id;

if ($kutiit->update()) {
  echo json_encode(array('message' => 'Proverb updated successfully'));
} else {
  echo json_encode(array('message' => 'Proverb failed to update, try again'));
}
