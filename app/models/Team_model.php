<?php 

class Team_model extends Controller
{
  private $table = 'project_teams';
  private $db;

  public function __construct()
  {
    $this->db = new Database;
  }

  public function getAllTeams()
  {
    $this->db->query('SELECT * FROM' . $this->table);
    return $this->db->resultSet();
  }

  public function getTeamByProject($id)
  {
    $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_id=:id');
    $this->db->bind('id', $id);
    return $this->db->resultSet();
  }

  public function getTeamByProjectGroup($group, $id)
  {
    $this->db->query('SELECT * FROM ' . $this->table. ' WHERE groups=:group AND project_id=:project_id');
    $this->db->bind('project_id', $id);
    $this->db->bind('group', $group);
    return $this->db->resultSet();
  }

  public function getStudentTeams($npm, $limit_start, $limit)
  {
    $this->db->query('SELECT * FROM '. $this->table .' WHERE student_id = :npm LIMIT :limit_start, :limit');
    $this->db->bind('npm', $npm);
    $this->db->bind('limit_start', $limit_start);
    $this->db->bind('limit', $limit);
    return $this->db->resultSet();
  }

  public function countTeams($npm)
  {
    $this->db->query('SELECT COUNT(*) AS total FROM ' . $this->table . ' WHERE student_id = :npm');
    $this->db->bind('npm', $npm);
    return $this->db->single();
  }


  public function addTeam($data)
  {
    $query = "INSERT INTO ". $this->table ." (name, groups, manager_id, student_id, project_id) VALUES (:name, :groups, :managerNpm, :studentNpm, :projectId)";
    $student = $this->model('Student_model')->getStudentByNpm($data['studentNpm']);
    $project = $this->model('Project_model')->getProjectById($data['projectId']);

    $this->db->query($query);
    if (isset($data['join'])) {
      $groupName = $data['projectName'] . " Group " . $data['projectGroup'];
      $this->db->bind('name', $groupName);
    } else {
      $this->db->bind('name', $data['projectName']);
    }
    
    $this->db->bind('groups', $data['projectGroup']);
    
    if (isset($data['submitManager'])) {
      $this->db->bind('managerNpm', $student['npm']);
    } else {
      $this->db->bind('managerNpm', null);
    }
    $this->db->bind('studentNpm', $student['npm']);
    $this->db->bind('projectId', $project['id']);

    $this->db->execute();

    return $this->db->affectedRows();
  }

  public function leaveTeam($project_id, $group, $npm)
  {
    $student_task = $this->model('Task_model')->getStudentProjectTaskProgress($project_id, $group, $npm);
    if (count($student_task) > 0) {
      return false;
    }
    $query = 'DELETE FROM ' . $this->table . ' WHERE project_id = :project_id AND groups = :group AND (student_id = :npm OR manager_id = :npm)';
    $this->db->query($query);
    $this->db->bind('project_id', $project_id);
    $this->db->bind('group', $group);
    $this->db->bind('npm', $npm);

    $this->db->execute();

    return $this->db->affectedRows();
  }
  
  // public function deleteTeam($projectKey)
  // {
  //   $query = 'DELETE FROM ' . $this->table . 'WHERE project = :project';
  //   $this->db->query($query);
  //   $this->db->bind('project', $projectKey);

  //   $this->db->execute();

  //   return $this->db->affectedRows();
  // }

  public function searchTeam()
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