<?php 

class Subject_model
{
  private $table = 'subject';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }
  
  public function getAllSubjects($limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' LIMIT :limit_start, :limit');
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function getSubjectById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function getSubjectByLecturerId($lecturer_id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE lecturer_id=:lecturer_id');
    $this->db->bind('lecturer_id', $lecturer_id);
    return $this->db->resultSet();
  }

  // Note only admin can add Subject
  public function addSubject($data)
  {
    $query = "INSERT INTO ". $this->table ." (id, name, lecturer_id) VALUES ('', :name, :lecturer_id);";

    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('lecturer_id', $data['lecturer_id']);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function deleteSubject($id)
  {
    $query = 'DELETE FROM ' . $this->table . 'WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function updateSubject($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, lecturerNidn = :lecturerNidn';
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('lecturerNidn', $data['lecturerNidn']);
    
    $this->db->execute();

    return $this->db->affectedRows();
  }

  // public function searchSubject()
  // {
  //   $keyword = $_POST['keyword'];
  //   $query = 'SELECT * FROM ' . $this->table . ' WHERE name LIKE :keyword';
  //   $this->db->query($query);
  //   $this->db->bind('keyword', "%$keyword%");

  //   var_dump($keyword);
  //   return $this->db->resultSet();
  // }

  public function countSubjects()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }
}

?>