<?php 

class Database 
{
  private $host = DB_HOST;
  private $user = DB_USER;
  private $password = DB_PASS;
  private $db_name = DB_NAME;

  private $dbh;
  private $stmt;

  public function __construct()
  {
    // Data Source Name
    $dsn = 'mysql:host='. $this->host .';dbname='. $this->db_name;
    $option = [
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->password, $option);
    } catch(PDOException $err) {
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
      }
    }

    $this->stmt->bindValue($params, $value, $type);
  }

  public function execute()
  {
    try {
      $this->stmt->execute();
    } catch (PDOException $err) {
      // if ($err->getCode() == 23000) {
      //     $message = $err->getMessage();
      //     Alert::setAlert(
      //         'Register Failed', 
      //         ''.$message.'', 
      //         'error', 
      //         'document.location.href = "'. BASEURL .'/StudentAuth/Register"'
      //       );
      //     echo Alert::Alert();
      // } else {
      //   throw $err;
      // }
    }
  }
  
  // Fetch Datas
  public function resultSet()
  {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Fetch Data
  public function single()
  {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function affectedRows()
  {
    return $this->stmt->rowCount();
  }

}

?>