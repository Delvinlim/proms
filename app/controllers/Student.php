<?php 

class Student extends Controller
{
  public function index()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }

    $this->view('student/index');
  }

  public function StudentList()
  {
    
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }
    
    $page = (isset($_POST['page']))? $_POST['page'] : 1;
    $limit = 10; 
    $limit_start = ($page - 1) * $limit;
    $no = $limit_start + 1;

    if (isset($_POST['keyword'])) {
      $students = $this->model('Student_model')->searchStudent($limit_start, $limit);
      $students_count = $this->model('Student_model')->countStudents();
      $data['page'] = $page;
      $data['no'] = $no;
      $data['students_total'] = $students_count['total'];
      $data['students_limit'] = $limit; 
      $data['name'] = [];
      $data['npm'] = [];
      foreach ($students as $student) {
        array_push($data['name'], $student['name']);
        array_push($data['npm'], $student['npm']);
      }
      
      $this->view('student/all_students', $data);
    }
  }
}


?>