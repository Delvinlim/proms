<?php 

class Database 
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $dbName = DB_NAME;

  private $dbh;
  private $stmt;

  // connect database
  public function __construct()
  {
    $dsn = 'mysql:host='. $this->host . ';dbname=' . $this->dbName;

    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    try {
      $this->dbh = new PDO($dsn, $this->user, $this->password, $option);
    } catch (PDOException $err) {
      die($err->getMessage());
    }
  }

  public function query($query)
  {
    $this->stmt = $this->dbh->prepare($query);
  }
  
  public function bind($params, $value, $type = null)
  {
    if( is_null($type) ) {
      switch (true) {
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
          break;
      }
    }
    
    $this->stmt->bindValue($params, $value, $type);
  }

  public function execute()
  {
    $this->stmt->execute();
  }

  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function singleSet()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function affectedRow()
  {
    return $this->stmt->rowCount();
  }
  
  
}


?>