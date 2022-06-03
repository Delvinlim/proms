<?php 

class Friends_model
{
  private $table = 'students_relationship';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  
  public function addFriends($data)
  {
    $query = "INSERT INTO " . $this->table . "(relating_student, related_student, type) VALUES (:relating_student, :related_student, :type)";
    $this->db->query($query);
    $this->db->bind('relating_student', $data['relating_student']);
    $this->db->bind('related_student', $data['related_student']);
    $this->db->bind('type', "Requested");
    
    $this->db->execute();
    return $this->db->affectedRows();
  }

  public function acceptFriendRequest($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET type = :type WHERE relating_student = :relating_student AND related_student = :related_student';
    $this->db->query($query);
    $this->db->bind('relating_student', $data['relating_student']);
    $this->db->bind('related_student', $data['related_student']);
    $this->db->bind('type', "Accepted");
    
    $this->db->execute();
    
    $query_insert = "INSERT INTO " . $this->table . "(relating_student, related_student, type) VALUES (:relating_student, :related_student, :type)";
    $this->db->query($query_insert);
    $this->db->bind('relating_student', $data['related_student']);
    $this->db->bind('related_student', $data['relating_student']);
    $this->db->bind('type', "Accepted");

    $this->db->execute();
    return $this->db->affectedRows();    
  }

  // public function rejectFriendRequest($data)
  // {
  //   $query = 'UPDATE ' . $this->table . ' SET type = :type WHERE relating_student = :relating_student AND related_student = :related_student';
  //   $this->db->query($query);
  //   $this->db->bind('relating_student', $data['relating_student']);
  //   $this->db->bind('related_student', $data['related_student']);
  //   $this->db->bind('type', "Rejected");
    
  //   $this->db->execute();
  //   return $this->db->affectedRows();    
  // }  

  public function rejectFriendRequest($data)
  {
    $query = 'DELETE FROM ' . $this->table . ' WHERE relating_student = :relating_student AND related_student = :related_student AND type = :type';
    $this->db->query($query);
    $this->db->bind('relating_student', $data['relating_student']);
    $this->db->bind('related_student', $data['related_student']);
    $this->db->bind('type', "Requested");
    
    $this->db->execute();
    return $this->db->affectedRows();
  }    

  public function getFriendRequest($related_student)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE related_student = :related_student AND type = :type');
    $this->db->bind('related_student', $related_student);
    $this->db->bind('type', "Requested");
    return $this->db->resultSet();
  }

  public function getFriends($related_student, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE related_student = :related_student AND type = :type LIMIT :limit_start, :limit');
    // var_dump($limit);die;
    $this->db->bind('related_student', $related_student);
    $this->db->bind('type', "Accepted");
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function deleteFriend($data)
  {
    $query = 'DELETE FROM ' . $this->table . ' WHERE relating_student = :relating_student AND related_student = :related_student AND type = :type';
    $this->db->query($query);
    $this->db->bind('relating_student', $data['relating_student']);
    $this->db->bind('related_student', $data['related_student']);
    $this->db->bind('type', "Accepted");    
    
    $this->db->execute();
    
    $query_second = 'DELETE FROM ' . $this->table . ' WHERE relating_student = :relating_student AND related_student = :related_student AND type = :type';
    $this->db->query($query_second);
    $this->db->bind('relating_student', $data['related_student']);
    $this->db->bind('related_student', $data['relating_student']);
    $this->db->bind('type', "Accepted");    
    
    $this->db->execute();
    return $this->db->affectedRows();    
  }

  public function countFriends($related_student)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE related_student = :related_student');
    $this->db->bind('related_student', $related_student);
    return $this->db->single();    
  }
}

?>