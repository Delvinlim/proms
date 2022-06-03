<?php 
class Dashboard extends Controller
{
  public function index()
  {
    if (!isset($_SESSION["Login"])) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    if (isset($_SESSION['A_Login'])) {
      $email = $_COOKIE['email'];
      $admin = $this->model('Admin_model')->getAdminByEmail($email);

      $data['name'] = isset ($admin['name']) ? $admin['name'] : 'Admin' ;
      $data['image'] = $admin['profile_image'];
      $data['admin'] = $admin;
      $data['active_state'] = "Dashboard";      

      $easy_tasks = $this->model('Task_model')->countEasyTasks();
      $medium_tasks = $this->model('Task_model')->countMediumTasks();
      $hard_tasks = $this->model('Task_model')->countHardTasks();
      $male_students = $this->model('Student_model')->countMaleStudents();
      $female_students = $this->model('Student_model')->countFemaleStudents();
      $undefined_students = $this->model('Student_model')->countUndefinedStudents();
      $projects = $this->model('Project_model')->countAllProjects();
      $students = $this->model('Student_model')->countStudents();
      $subjects = $this->model('Subject_model')->countSubjects();
      $count_lecturers = $this->model('Lecturer_model')->countLecturers();
      $tasks = $this->model('Task_model')->countTasks();
      $data['project_total'] = $projects['total'];
      $data['student_total'] = $students['total'];
      $data['subject_total'] = $subjects['total'];
      $data['lecturer_total'] = $count_lecturers['total'];
      $data['task_total'] = $tasks['total'];
      $data['male_students'] = $male_students['total'];
      $data['female_students'] = $female_students['total'];
      $data['easy_tasks'] = $easy_tasks['total'];
      $data['medium_tasks'] = $medium_tasks['total'];
      $data['hard_tasks'] = $hard_tasks['total'];
      $data['undefined_students'] = $undefined_students['total'];
    }

    $this->view('templates/project/header', $data);
    // $this->view('project/index', $data);
    $this->view('dashboard/index', $data);
    $this->view('templates/project/footer', $data);    
  }
}


?>