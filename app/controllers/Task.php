<?php 
class Task extends Controller
{
  public function index()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }
    
    if (isset($_POST['complete_task'])) {
      if ($this->model('Task_model')->completeTask($_POST) > 0) {
        Alert::setAlertPopup(
          'Task Submited',
          'Thanks for your hardwork, Please wait for leader confirmation', 
          'success',
          'document.location.href = "'. BASEURL .'/Task"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Failed', 
          'Unable to submit a task right now, please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Task"'
        );
        echo Alert::AlertPopup();
      }        
    }        
    
    // GET FRIEND REQUEST
    $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
    $data['requester_name'] = [];
    foreach ($requests as $request) {
      $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
      array_push($data['requester_name'], $student['name']);
    }
    
    $npm = $_COOKIE['npm'];
    $student = $this->model('Student_model')->getStudentByNpm($npm);
    $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
    $data['image'] = $student['profile_image'];
    $data['active_state'] = "Task";

    $this->view('templates/project/header', $data);
    $this->view('task/index', $data);
    $this->view('templates/project/footer', $data);
  }

  public function List()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }
    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 10; 
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;

    $npm = $_COOKIE['npm'];
    $student = $this->model('Student_model')->getStudentByNpm($npm);
    $tasks= $this->model('Task_model')->getTaskByStudentId($npm, $limit_start, $limit);
    $tasks_count= $this->model('Task_model')->countTaskByStudentId($npm);
    $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
    $data['image'] = $student['profile_image'];
    $data['tasks'] = $tasks;

    $data['page'] = $page;
    $data['task_no'] = $no;
    $data['task_total'] = $tasks_count['total'];
    $data['task_limit'] = $limit;
    $data['task_id'] = [];
    $data['task_title'] = [];
    $data['task_description'] = [];
    $data['task_start_date'] = [];
    $data['task_end_date'] = [];
    $data['task_taken_date'] = [];
    $data['task_completed_date'] = [];
    $data['task_level'] = [];
    $data['task_progress_status'] = [];
    $data['task_approval_status'] = [];
    $data['task_project'] = [];
    $data['task_available_status'] = [];
    $data['task_responsible'] = [];
    $data['task_submission_link'] = [];
    $data['active_state'] = "Task";
    foreach ($tasks as $task) {
      $project = $this->model('Project_model')->getProjectById($task['project_id']);
      array_push($data['task_id'], $task['id']);
      array_push($data['task_title'], $task['title']);
      array_push($data['task_description'], $task['description']);
      array_push($data['task_start_date'], $task['start_date']);
      array_push($data['task_end_date'], $task['end_date']);
      array_push($data['task_taken_date'], $task['taken_date']);
      array_push($data['task_completed_date'], $task['completed_date']);
      array_push($data['task_level'], $task['level']);
      array_push($data['task_progress_status'], $task['task_status']);
      array_push($data['task_approval_status'], $task['approval_status']);
      array_push($data['task_available_status'], $task['available_status']);
      array_push($data['task_submission_link'], $task['submission_link']);
      array_push($data['task_responsible'], $task['student_id']);
      array_push($data['task_project'], $project['name']);
    }

    $this->view('task/task_list', $data);
  }

  public function Completed()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 10; 
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;

    $npm = $_COOKIE['npm'];
    $student = $this->model('Student_model')->getStudentByNpm($npm);
    $tasks= $this->model('Task_model')->getCompletedTaskByStudentId($npm, $limit_start, $limit);
    $tasks_count= $this->model('Task_model')->countCompletedTaskByStudentId($npm);
    $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
    $data['image'] = $student['profile_image'];
    $data['tasks'] = $tasks;

    $data['page'] = $page;
    $data['task_no'] = $no;
    $data['task_total'] = $tasks_count['total'];
    $data['task_limit'] = $limit;
    $data['task_id'] = [];
    $data['task_title'] = [];
    $data['task_description'] = [];
    $data['task_start_date'] = [];
    $data['task_end_date'] = [];
    $data['task_taken_date'] = [];
    $data['task_completed_date'] = [];
    $data['task_level'] = [];
    $data['task_progress_status'] = [];
    $data['task_approval_status'] = [];
    $data['task_project'] = [];
    $data['task_available_status'] = [];
    $data['task_responsible'] = [];
    $data['task_submission_link'] = [];
    $data['active_state'] = "Task";
    foreach ($tasks as $task) {
      $project = $this->model('Project_model')->getProjectById($task['project_id']);
      array_push($data['task_id'], $task['id']);
      array_push($data['task_title'], $task['title']);
      array_push($data['task_description'], $task['description']);
      array_push($data['task_start_date'], $task['start_date']);
      array_push($data['task_end_date'], $task['end_date']);
      array_push($data['task_taken_date'], $task['taken_date']);
      array_push($data['task_completed_date'], $task['completed_date']);
      array_push($data['task_level'], $task['level']);
      array_push($data['task_progress_status'], $task['task_status']);
      array_push($data['task_approval_status'], $task['approval_status']);
      array_push($data['task_available_status'], $task['available_status']);
      array_push($data['task_submission_link'], $task['submission_link']);
      array_push($data['task_responsible'], $task['student_id']);
      array_push($data['task_project'], $project['name']);
    }

    $this->view('task/task_completed', $data);    
  }

  public function Progress()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 10; 
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;

    $npm = $_COOKIE['npm'];
    $student = $this->model('Student_model')->getStudentByNpm($npm);
    $tasks= $this->model('Task_model')->getProgressTaskByStudentId($npm, $limit_start, $limit);
    $tasks_count= $this->model('Task_model')->countProgressTaskByStudentId($npm);
    $data['name'] = isset ($student['name']) ? $student['name'] : 'Student' ;
    $data['image'] = $student['profile_image'];
    $data['tasks'] = $tasks;

    $data['page'] = $page;
    $data['task_no'] = $no;
    $data['task_total'] = $tasks_count['total'];
    $data['task_limit'] = $limit;
    $data['task_id'] = [];
    $data['task_title'] = [];
    $data['task_description'] = [];
    $data['task_start_date'] = [];
    $data['task_end_date'] = [];
    $data['task_taken_date'] = [];
    $data['task_completed_date'] = [];
    $data['task_level'] = [];
    $data['task_progress_status'] = [];
    $data['task_approval_status'] = [];
    $data['task_project'] = [];
    $data['task_available_status'] = [];
    $data['task_responsible'] = [];
    $data['task_submission_link'] = [];
    $data['active_state'] = "Task";
    foreach ($tasks as $task) {
      $project = $this->model('Project_model')->getProjectById($task['project_id']);
      array_push($data['task_id'], $task['id']);
      array_push($data['task_title'], $task['title']);
      array_push($data['task_description'], $task['description']);
      array_push($data['task_start_date'], $task['start_date']);
      array_push($data['task_end_date'], $task['end_date']);
      array_push($data['task_taken_date'], $task['taken_date']);
      array_push($data['task_completed_date'], $task['completed_date']);
      array_push($data['task_level'], $task['level']);
      array_push($data['task_progress_status'], $task['task_status']);
      array_push($data['task_approval_status'], $task['approval_status']);
      array_push($data['task_available_status'], $task['available_status']);
      array_push($data['task_submission_link'], $task['submission_link']);
      array_push($data['task_responsible'], $task['student_id']);
      array_push($data['task_project'], $project['name']);
    }

    $this->view('task/task_completed', $data);    
  }  
}


?>