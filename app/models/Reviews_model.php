<?php 

class Reviews_model
{
  private $table = 'reviews';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
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
  
    move_uploaded_file($fileTmpName, '../public/assets/img/reviews/'. $newFileName);
    return $newFileName;
  }  

  public function createReviews($data)
  {
    $image = $this->uploadImage();
    if (!$image) {
      return false;
    }

    $query = "INSERT INTO ". $this->table ." (id, name, job, comment, image, status) VALUES ('', :name, :job, :comment, :image, :status)";
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('job', $data['job']);
    $this->db->bind('comment', $data['comment']);
    $this->db->bind('image', $image);
    $this->db->bind('status', 'Pending');

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function getApprovedReviews()
  {
    $query = "SELECT * FROM ". $this->table . " WHERE status = :status";
    // var_dump($query);
    $this->db->query($query);
    $this->db->bind('status', 'Approved');
    $this->db->execute();
    return $this->db->resultSet();
  }
  
  public function getReviews($limit_start, $limit)
  {
    $query = "SELECT * FROM ". $this->table . " WHERE status = :status LIMIT :limit_start, :limit";
    // var_dump($query);die;
    $this->db->query($query);
    $this->db->bind('status', 'Pending');
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    $this->db->execute();
    return $this->db->resultSet();
  }

  public function countReviews()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }

  public function approveReviews($data)
  {
    // $query = 'UPDATE ' . $this->table . ' SET name = :name, email = :email, phone = :phone, gender = :gender, profile_image = :image WHERE npm = :npm';
    $query = 'UPDATE ' . $this->table . ' SET status = :status WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('status' , 'Approved');
    $this->db->bind('id' , $data['id']);

    $this->db->execute();
    return $this->db->affectedRows();
  }

  public function rejectReviews($data)
  {
    $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id' , $data['id']);

    $this->db->execute();
    return $this->db->affectedRows();
  }
}
?>