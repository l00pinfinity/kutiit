<?php
class Tribe{
  private $conn;
  private $table = 'tribes';

  public $id;
  public $name;
  public $created_at;

  public function __construct($db){
    $this->conn = $db;
  }

  //get all tribes

  public function read(){
    $query = 'SELECT id,name,created_at FROM ' . $this->table . ' ORDER BY created_at DESC';

    //prepared statement
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }
}
