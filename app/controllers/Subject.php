<?php 
class Subject extends Controller
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
      $data['active_state'] = "Subject";

      $lecturers = $this->model('Lecturer_model')->getAllLecturers();
      $data['lecturer_name'] = [];
      $data['lecturer_nidn'] = [];
      
      foreach ($lecturers as $lecturer) {
        array_push($data['lecturer_name'], $lecturer['name']);
        array_push($data['lecturer_nidn'], $lecturer['nidn']);
      }
    }

    if (isset($_POST['create_subject'])) {
      if( $this->model('Subject_model')->addSubject($_POST) > 0 ) {
        Alert::setAlertPopup(
          'Success', 
          'Subject successfully Uploaded into Database', 
          'success', 
          'document.location.href = "'. BASEURL .'/Subject"'
        );          
        echo Alert::AlertPopup();           
        exit;
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Unable to create subject, Please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Subject"'
        );          
        echo Alert::AlertPopup();
      }
    }

    $this->view('templates/project/header', $data);
    $this->view('subject/index', $data);
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

    $email = $_COOKIE['email'];
    $admin = $this->model('Admin_model')->getAdminByEmail($email);
    $subjects = $this->model('Subject_model')->getAllSubjects($limit_start, $limit);
    $subjects_count = $this->model('Subject_model')->countSubjects();
    $data['name'] = isset ($admin['name']) ? $admin['name'] : 'Admin' ;
    $data['image'] = $admin['profile_image'];
    $data['admin'] = $admin;
    $data['active_state'] = "Subject";
    $data['subjects'] = $subjects;

    $data['page'] = $page;
    $data['subjects_no'] = $no;
    $data['subjects_total'] = $subjects_count['total'];
    $data['subjects_limit'] = $limit;

    $data['subject_id'] = [];
    $data['subject_name'] = [];
    $data['subject_lecturer'] = [];

    foreach ($subjects as $subject) {
      array_push($data['subject_id'], $subject['id']);
      array_push($data['subject_name'], $subject['name']);
      $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($subject['lecturer_id']);
      array_push($data['subject_lecturer'], $lecturer['name']);
    }

    $this->view('subject/list', $data);
  }
}


?>