<?php 

class Task_model extends Controller
{
  private $table = 'tasks';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllTasks()
  {
    $this->db->query('SELECT * FROM' . $this->table);
    return $this->db->resultSet();
  }

  public function getTaskById($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
    $this->db->bind('id', $id);
    return $this->db->single();
  }

  public function getTaskByProjectId($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_id = :project_id');
    $this->db->bind('project_id', $id);
    return $this->db->resultSet();
  }

  public function getTaskByProjectGroupLimited($id, $group, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_id = :project_id AND groups = :group LIMIT :limit');
    // $this->db->query('SELECT * FROM ' . $this->table . '  INNER JOIN project_teams ON project_id = :project_id AND project_teams.groups = :group');
    $this->db->bind('project_id', $id);
    $this->db->bind('group', $group);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function getTaskByProjectGroup($id, $group)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_id = :project_id AND groups = :group');
    // $this->db->query('SELECT * FROM ' . $this->table . '  INNER JOIN project_teams ON project_id = :project_id AND project_teams.groups = :group');
    $this->db->bind('project_id', $id);
    $this->db->bind('group', $group);
    return $this->db->resultSet();
  }

  public function getStudentProjectTaskProgress($id, $group, $npm)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_id = :project_id AND groups = :group AND student_id = :student_id');
    $this->db->bind('project_id', $id);
    $this->db->bind('group', $group);
    $this->db->bind('student_id', $npm);
    return $this->db->resultSet();
  }

  public function getTaskByStudentId($npm, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE student_id = :npm LIMIT :limit_start, :limit');
    $this->db->bind('npm', $npm);
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function countTaskByStudentId($npm)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE student_id = :npm');
    $this->db->bind('npm', $npm);
    return $this->db->single();
  }

  public function countTasks()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table);
    return $this->db->single();
  }

  public function countEasyTasks()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE level = "Easy"');
    return $this->db->single();
  }

  public function countMediumTasks()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE level = "Medium"');
    return $this->db->single();
  }

  public function countHardTasks()
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE level = "Hard"');
    return $this->db->single();
  }

  public function getCompletedTaskByStudentId($npm, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE task_status = "COMPLETED" AND student_id = :npm LIMIT :limit_start, :limit');
    $this->db->bind('npm', $npm);
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function countCompletedTaskByStudentId($npm)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE task_status = "COMPLETED" AND student_id = :npm');
    $this->db->bind('npm', $npm);
    return $this->db->single();
  }  

  public function getProgressTaskByStudentId($npm, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE task_status = "ON PROGRESS" AND student_id = :npm LIMIT :limit_start, :limit');
    $this->db->bind('npm', $npm);
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function countProgressTaskByStudentId($npm)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE task_status = "ON PROGRESS" AND student_id = :npm');
    $this->db->bind('npm', $npm);
    return $this->db->single();
  }  

  public function addTask($data)
  {
    // var_dump($data);die;
    if ($data['student_id']) {
      $student = $this->model('Student_model')->getStudentByNpm($data['student_id']);
    }
    $project = $this->model('Project_model')->getProjectById($data['project_id']);
    
    $query = "INSERT INTO ". $this->table ." (id, title, groups, description, start_date, end_date, taken_date, completed_date, level, task_status, available_status, approval_status, project_id, student_id) VALUES (NULL, :title, :groups, :description, :start_date, :end_date, :taken_date, NULL, :level, :task_status, :available_status, NULL, :project_id, :student_id);";
    
    $this->db->query($query);
    $this->db->bind('title', $data['title']);
    $this->db->bind('groups', $data['groups']);
    $this->db->bind('description', $data['description']);
    $this->db->bind('start_date', $data['start_date']);
    $this->db->bind('end_date', $data['end_date']);
    $this->db->bind('level', $data['level']);
    $this->db->bind('project_id', $project['id']);
    // $this->db->bind('available_status', true);
    // $this->db->bind('task_status', "PENDING");
    if ($data['student_id']) {
      $this->db->bind('student_id', $student['npm']);
      $this->db->bind('available_status', false);
      $this->db->bind('taken_date', date("Y-m-d"));
      $this->db->bind('task_status', "ON PROGRESS");
    } else {
      $this->db->bind('student_id', null);
      $this->db->bind('available_status', true);
      $this->db->bind('task_status', "PENDING");
      $this->db->bind('taken_date', null);
    }

    $this->db->execute();
    return $this->db->affectedRows();
  }
  
  public function WorkOnTask($data)
  {
    $query = "UPDATE ". $this->table ." SET available_status = b'0', student_id = :student_id, taken_date = :taken_date, task_status = :task_status WHERE id = :id;";
    $this->db->query($query);
    $this->db->bind('student_id', $data['student_id']);
    $this->db->bind('taken_date', date("Y-m-d"));
    $this->db->bind('task_status', "ON PROGRESS");
    $this->db->bind('id', $data['id']);
    
    $this->db->execute();
    
    return $this->db->affectedRows();
  }

  public function dropTask($data)
  {
    $query = "UPDATE ". $this->table ." SET available_status = b'1', student_id = :student_id, taken_date = :taken_date, task_status = :task_status WHERE id = :id;";
    $this->db->query($query);
    $this->db->bind('student_id', null);
    $this->db->bind('taken_date', null);
    $this->db->bind('task_status', "PENDING");
    $this->db->bind('id', $data['id']);
    
    $this->db->execute();

    $student = $this->model('Student_model')->getStudentByNpm($data['student_id']);
    $social_score = $student['social_score'] - 5;    
    $query_social_score = "UPDATE students SET social_score = :social_score WHERE npm = :npm;";
    $this->db->query($query_social_score);
    $this->db->bind('npm', $student['npm']);
    $this->db->bind('social_score', $social_score);

    $this->db->execute();
    
    return $this->db->affectedRows();
  }

  public function completeTask($data)
  {
    $query = "UPDATE ". $this->table ." SET submission_link = :submission_link, approval_status = :approval_status WHERE id = :id;";
    $this->db->query($query);
    $this->db->bind('submission_link', $data['submission_link']);
    $this->db->bind('approval_status', "Waiting For Confirmation");
    $this->db->bind('id', $data['id']);
    
    $this->db->execute();
    
    return $this->db->affectedRows();
  }

  public function approveTask($data)
  {
    $query = "UPDATE ". $this->table ." SET completed_date = :completed_date, task_status = :task_status, approval_status = :approval_status WHERE id = :id;";
    $this->db->query($query);
    $this->db->bind('completed_date', date("Y-m-d"));
    $this->db->bind('task_status', "COMPLETED");
    $this->db->bind('approval_status', "Accepted");
    $this->db->bind('id', $data['id']);
    
    $this->db->execute();


    $student = $this->model('Student_model')->getStudentByNpm($data['student_id']);
    $social_score = $student['social_score'] + 5;
    $query_social_score = "UPDATE students SET social_score = :social_score WHERE npm = :npm;";
    $this->db->query($query_social_score);
    $this->db->bind('npm', $student['npm']);
    $this->db->bind('social_score', $social_score);

    $this->db->execute();
        
    
    return $this->db->affectedRows();
  }

  public function rejectTask($data)
  {
    $query = "UPDATE ". $this->table ." SET submission_link = :submission_link, task_status = :task_status, approval_status = :approval_status WHERE id = :id;";
    $this->db->query($query);
    $this->db->bind('submission_link', null);
    $this->db->bind('task_status', "ON PROGRESS");
    $this->db->bind('approval_status', "Rejected");
    $this->db->bind('id', $data['id']);
    
    $this->db->execute();
    
    return $this->db->affectedRows();
  }  

  public function deleteTask($id)
  {
    $query = 'DELETE FROM ' . $this->table . 'WHERE id = :id';
    $this->db->query($query);
    $this->db->bind('id', $id);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  // public function updateTask($data)
  // {
  //   $query = 'UPDATE ' . $this->table . ' SET name = :name, description = :description, startDate = :startDate, endDate = :endDate, subjectId = :subjectId, lecturerNidn = :lecturerNidn';
  //   $this->db->query($query);
  //   $this->db->bind('name', $data['name']);
  //   $this->db->bind('description', $data['description']);
  //   $this->db->bind('startDate', $data['startDate']);
  //   $this->db->bind('endDate', $data['endDate']);
  //   $this->db->bind('subjectId', $data['subjectId']);
  //   $this->db->bind('lecturerId', $data['lecturerId']);
    
  //   $this->db->execute();

  //   return $this->db->affectedRows();
  // }

  public function searchTask()
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