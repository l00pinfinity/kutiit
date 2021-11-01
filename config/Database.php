<?php
class Database{
  private $dsn = "mysql:host=127.0.0.1;charset=utf8;dbname=kutiit";
  private $username = 'root';
  private $password = '';
  private $conn;

  public function connect(){
    $this->conn = null;

    try{
      $this->conn = new PDO($this->dsn,$this->username,$this->password);
      //Set error mode
      $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      die('Connection failed: ' . $e->getMessage()); 
    }
    return $this->conn;
  }
}