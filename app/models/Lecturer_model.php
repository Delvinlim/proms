<?php 

class Lecturer_model
{
  private $table = 'lecturers';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllLecturers()
  {
    $this->db->query('SELECT * FROM '. $this->table);
    return $this->db->resultSet();
  }

  public function getLecturerByNidn($nidn)
  {
    $this->db->query('SELECT * FROM '. $this->table . ' WHERE nidn=:nidn');
    $this->db->bind('nidn', $nidn);
    return $this->db->single();
  }

  public function addLecturer($data)
  {
    $query = "INSERT INTO " . $this->table . "(nidn, name, email, phone, gender, password) VALUES (:nidn, :name, :email, '', '', :password)";
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    
    $this->db->query($query);
    $this->db->bind('nidn', $data['nidn']);
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $password);

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

  public function updateLecturer($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET name = :name, email = :email, phone = :phone, gender = :gender, profile_image = :image WHERE nidn = :nidn';

    $image = $this->uploadImage();
    $this->db->query($query);

    if ($image) {
      $this->db->bind('image', $image);
    } else {
      $this->db->bind('image', $data['profile_image']);
    }
    $this->db->bind('name', $data['name']);
    $this->db->bind('nidn', $data['nidn']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('gender', isset($data['gender']) ? $data['gender'] : null);
    
    $this->db->execute();
    return $this->db->affectedRows();
  }  
  
  public function countLecturers()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }
  
}

?>