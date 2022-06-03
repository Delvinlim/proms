<?php 

class Project_model extends Controller
{
  private $table = 'projects';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function generateRandomProjectKey()
  {
    $randomKey = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($randomKey), 0, 8);
  }
  
  public function getAllProjects()
  {
    $this->db->query('SELECT * FROM' . $this->table);
    return $this->db->resultSet();
  }

  public function getProjectById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function getTeamByProjectKey($project_key)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_key=:project_key');
    $this->db->bind('project_key', $project_key);
    return $this->db->single();
  }

  public function getProjectByLecturer($id, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE lecturer_id = :lecturer_id LIMIT :limit_start, :limit');
    $this->db->bind('lecturer_id', $id);
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);    
    return $this->db->resultSet();
  }

  public function countProjects($id)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE lecturer_id = :lecturer_id');
    $this->db->bind('lecturer_id', $id);
    return $this->db->single();
  }

  public function countAllProjects()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }

  // Only Lecturer can create project
  public function addProject($data)
  {
    $query = "INSERT INTO ". $this->table ." (id, name, description, project_key, start_date, end_date, subject_id, lecturer_id) VALUES ('', :name, :description, :project_key, :start_date, :end_date, :subject_id, :lecturer_id)";

    $subject = $this->model('Subject_model')->getSubjectById($data['subject_id']);
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('project_key', $data['project_key']);
    // $this->db->bind('project_key', $this->generateRandomProjectKey());
    $this->db->bind('start_date', $data['start_date']);
    $this->db->bind('end_date', $data['end_date']);
    $this->db->bind('subject_id', $subject['id']);
    $this->db->bind('lecturer_id', $data['lecturer_id']);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function deleteProject($id)
  {
    $query = 'DELETE FROM ' . $this->table . 'WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function updateProject($data)
  {
    $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, startDate = :startDate, endDate = :endDate, subjectId = :subjectId, lecturerNidn = :lecturerNidn';
    $this->db->query($query);
    $this->db->bind('name', $data['name']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('startDate', $data['startDate']);
    $this->db->bind('endDate', $data['endDate']);
    $this->db->bind('subjectId', $data['subjectId']);
    $this->db->bind('lecturerId', $data['lecturerId']);
    
    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function searchProject()
  {
    $keyword = $_POST['keyword'];
    $query = 'SELECT * FROM ' . $this->table . ' WHERE name LIKE :keyword';
    $this->db->query($query);
    $this->db->bind('keyword', "%$keyword%");

    var_dump($keyword);
    return $this->db->resultSet();
  }
}

?>