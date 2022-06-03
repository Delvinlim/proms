<?php 

class Student_model
{
  private $table = 'students';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllStudents()
  {
    $this->db->query('SELECT * FROM' . $this->table);
    return $this->db->resultSet();
  }

  public function getStudentByNpm($npm)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE npm=:npm');
    $this->db->bind('npm', $npm);
    return $this->db->single();
  }

  public function addStudent($data)
  {
    $query = "INSERT INTO " . $this->table . "(npm, name, email, phone, gender, password) VALUES (:npm, :name, :email, '', '', :password)";
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $this->db->query($query);
    $this->db->bind('npm', $data['npm']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    // $this->db->bind('phone', $data['phone']);
    // $this->db->bind('gender', $data['gender']);
    $this->db->bind('password', $password);
    
    $this->db->execute();
    return $this->db->affectedRows();
  }

  public function deleteStudent($id)
  {
    $query = 'DELETE FROM ' . $this->table . 'WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id', $id);
    
    $this->db->execute();
    
    return $this->db->affectedRows();
  }

  public function uploadImage()
  {
    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $error = $_FILES['image']['error'];
    $fileTmpName = $_FILES['image']['tmp_name'];

    if ($error === 4) {
      return false;
    }

    $validImageExtension = ['jpg', 'png', 'jpeg'];
    $imageExtension = explode('.', $fileName);
    $imageExtension = strtolower(end($imageExtension));
  
    if (!in_array($imageExtension, $validImageExtension)) {
      return false;
    }
  
    if ($fileSize > 2000000) {
      return false;
    }
    
    $newFileName = uniqid();
    $newFileName .= '.';
    $newFileName .= $imageExtension;
  
    move_uploaded_file($fileTmpName, '../public/assets/img/profiles/'. $newFileName);
    return $newFileName;
  }    

  public function updateStudent($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET name = :name, email = :email, phone = :phone, gender = :gender, profile_image = :image WHERE npm = :npm';

    $image = $this->uploadImage();
    $this->db->query($query);

    if ($image) {
      $this->db->bind('image', $image);
    } else {
      $this->db->bind('image', $data['profile_image']);
    }
    $this->db->bind('name', $data['name']);
    $this->db->bind('npm', $data['npm']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('gender', $data['gender']);
    // $this->db->bind('password', $data['password']);
    
    $this->db->execute();
    return $this->db->affectedRows();
  }

  public function searchStudent($limit_start, $limit)
  {
    $keyword = $_POST['keyword'];
    $query = 'SELECT * FROM ' . $this->table . ' WHERE name LIKE :keyword LIMIT :limit_start, :limit';
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);

    return $this->db->resultSet();
  }

  public function countStudents()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }

  public function countMaleStudents()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE gender = "Male"');
    return $this->db->single();
  }

  public function countFemaleStudents()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE gender = "Female"');
    return $this->db->single();
  }

  public function countUndefinedStudents()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE gender = False');
    return $this->db->single();
  }
}

?>