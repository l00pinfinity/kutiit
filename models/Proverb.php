<?php
class Proverb
{
  private $conn;
  private $table = 'proverbs';

  public $id;
  public $tribe_id;
  public $tribe_name;
  public $proverb;
  public $english;
  public $meaning;
  public $created_at;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  //Get proverb
  public function read()
  {
    $query = 'SELECT
    t.name as tribe_name,
    p.id,
    p.tribe_id,
    p.proverb,
    p.english,
    p.meaning,
    p.created_at 
    FROM 
    ' . $this->table . ' p
    LEFT JOIN
    tribes t ON p.tribe_id = t.id
    ORDER BY
    p.created_at DESC';

    //prepared statement
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
  }

  //Get single proverb
  public function read_single()
  {
    $query = 'SELECT
    t.name as tribe_name,
    p.id,
    p.tribe_id,
    p.proverb,
    p.english,
    p.meaning,
    p.created_at 
    FROM 
    ' . $this->table . ' p
    LEFT JOIN
    tribes t ON p.tribe_id = t.id
    WHERE p.id = ? LIMIT 0,1';

    //prepared statement
    $stmt = $this->conn->prepare($query);

    //Bind id using name parameter
    $stmt->bindParam(1, $this->id);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->proverb = $row['proverb'];
    $this->english = $row['english'];
    $this->meaning = $row['meaning'];
    $this->tribe_name = $row['tribe_name'];

    return $stmt;
  }

  //Create proverb that will be from Admin-Kutiit
  public function create(){
    $query = 'INSERT INTO ' . $this->table . '
    SET 
    proverb = :proverb,
    english = :english,
    meaning = :meaning,
    tribe_id = :tribe_id';

    $stmt = $this->conn->prepare($query);

    //clean data from admin
    $this->proverb = htmlspecialchars(strip_tags($this->proverb));
    $this->english = htmlspecialchars(strip_tags($this->english));
    $this->meaning = htmlspecialchars(strip_tags($this->meaning));
    $this->tribe_id = htmlspecialchars(strip_tags($this->tribe_id));

    //Bind data
    $stmt->bindParam(':proverb', $this->proverb);
    $stmt->bindParam(':english', $this->english);
    $stmt->bindParam(':meaning', $this->meaning);
    $stmt->bindParam(':tribe_id', $this->tribe_id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  //update proverb that will be from Admin-Kutiit
  public function update(){
    $query = 'UPDATE ' . $this->table . '
      SET 
      proverb = :proverb,
      english = :english,
      meaning = :meaning,
      tribe_id = :tribe_id
      WHERE
      id = :id';

    $stmt = $this->conn->prepare($query);

    //clean data from admin
    $this->proverb = htmlspecialchars(strip_tags($this->proverb));
    $this->english = htmlspecialchars(strip_tags($this->english));
    $this->meaning = htmlspecialchars(strip_tags($this->meaning));
    $this->tribe_id = htmlspecialchars(strip_tags($this->tribe_id));
    $this->id = htmlspecialchars(strip_tags($this->id));


    //Bind data
    $stmt->bindParam(':proverb', $this->proverb);
    $stmt->bindParam(':english', $this->english);
    $stmt->bindParam(':meaning', $this->meaning);
    $stmt->bindParam(':tribe_id', $this->tribe_id);
    $stmt->bindParam(':id', $this->id);


    if ($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }

  //delete proverb
  public function delete(){
    $query = 'DELETE FROM ' . $this->table . ' WHERE id=:id ';

    $stmt = $this->conn->prepare($query);

    $this->id = htmlspecialchars(strip_tags($this->id));

    $stmt->bindParam(':id', $this->id);

    if ($stmt->execute()) {
      return true;
    }
    printf("Error: %s.\n", $stmt->error);
    return false;
  }
}
