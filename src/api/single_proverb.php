<?php
//headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: aplication/json');

include_once '../config/Database.php';
include_once '../models/Proverb.php';

$database = new Database();
$db = $database->connect();

$kutiit = new Proverb($db);

//Get id from url
$kutiit->id = isset($_GET['id']) ? $_GET['id'] : die();

$kutiit->read_single();

$proverb_arr = array(
  'id' => $kutiit->id,
  'proverb' => $kutiit->proverb,
  'english' => $kutiit->english,
  'meaning' => $kutiit->meaning,
  'tribe' => $kutiit->tribe_name
);

print_r(json_encode($proverb_arr));
