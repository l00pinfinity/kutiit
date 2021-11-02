<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');
header('Acces-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Acces-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../config/Database.php';
include_once '../models/Proverb.php';

$database = new Database();
$db = $database->connect();

$kutiit = new Proverb($db);

$data = json_decode(file_get_contents("php://input"));

$kutiit->id = $data->id;

if ($kutiit->delete()) {
  echo json_encode(array('message' => 'Proverb deleted successfully'));
}else{
  echo json_encode(array('message' => 'Proverb not deleted, try again'));
}