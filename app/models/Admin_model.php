<?php 

class Admin_model
{
  private $table = 'admins';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllAdmins()
  {
    $this->db->query('SELECT * FROM ' . $this->table);
    return $this->db->resultSet();
  }
  
  public function getAdminByEmail($email)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:email');
    $this->db->bind('email', $email);
    return $this->db->single();
  }

  public function addAdmin($data)
  {
    $query = "INSERT INTO " . $this->table . "(name, email, phone, gender, password) VALUES (:name, :email, '', '', :password)";
    $password = password_hash($data['password'], PASSWORD_DEFAULT);
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('password', $password);
    
    $this->db->execute();
    return $this->db->affectedRows();
  }

  public function updateAdmin($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET name = :name, email = :email, phone = :phone, gender = :gender, profile_image = :image WHERE email = :email';
    $image = $this->uploadImage();
    $this->db->query($query);

    if ($image) {
      $this->db->bind('image', $image);
    } else {
      $this->db->bind('image', $data['profile_image']);
    }
    $this->db->bind('name', $data['name']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('phone', $data['phone']);
    $this->db->bind('gender', isset($data['gender']) ? $data['gender'] : null);
    
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

// public function searchAdmin()
  // {
  //   $keyword = $_POST['keyword'];
  //   $query = 'SELECT * FROM ' . $this->table . ' WHERE name LIKE :keyword';
  //   $this->db->query($query);
  //   $this->db->bind('keyword', "%$keyword%");

  //   var_dump($keyword);
  //   return $this->db->resultSet();
  // }
}

?>