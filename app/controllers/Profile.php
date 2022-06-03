<?php 

class Profile extends Controller 
{
  public function index()
  {
    if(!isset($_SESSION)){
      session_start();
    }
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }
  }

  public function Student()
  {
    if(!isset($_SESSION)){
      session_start();
    }
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    

    $data['friends'] = [];
    $data['pending_friends'] = [];
    if (isset($_GET['npm'])) {
      $page = (isset($_POST['page']))? $_POST['page'] : 1;
      $limit = 10; 
      $limit_start = ($page - 1) * $limit;
      
      $student = $this->model('Student_model')->getStudentByNpm($_GET['npm']);
      $friends = $this->model('Friends_model')->getFriends($_GET['npm'], $limit_start, $limit);
      $pending_friends = $this->model('Friends_model')->getFriendRequest($_GET['npm']);

      foreach ($friends as $friend) {
        array_push($data['friends'], $friend['relating_student']);
      }
      foreach ($pending_friends as $pending_friend) {
        array_push($data['pending_friends'], $pending_friend['relating_student']);
      }
    } else {
      $student = $this->model('Student_model')->getStudentByNpm($_COOKIE['npm']);
    }

    $data['npm'] = $student['npm'];
    $data['name'] = $student['name'];
    $data['email'] = $student['email'];
    $data['phone'] = $student['phone'];
    $data['gender'] = $student['gender'];
    $data['image'] = $student['profile_image'];
    $data['social_score'] = $student['social_score'];
    $this->view('student/profile', $data);
  }

  public function updateStudent()
  {
    if (isset($_POST['submit'])) {
      if ($this->model('Student_model')->updateStudent($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Update',
          'New profile saved',
          'success',
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Update Failed',
          'Please try again',
          'error',
          'document.location.href = "'. BASEURL .'/Profile/Student"'
        );
        echo Alert::AlertPopup();
      }
    }
  }

  public function addFriend()
  {
    if (isset($_POST['submit'])) {
      $npm = $_POST['npm'];
      if ($this->model('Friends_model')->addFriends($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Added',
          'Please wait until your friend accept your request',
          'success',
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Request Failed',
          'This person added you as friend, please check your Friendlist Request',
          'error',
          'document.location.href = "'. BASEURL .'/Profile/Student?npm='. $npm .'"'
        );
        echo Alert::AlertPopup();
      }
    }    
  }

  public function Lecturer()
  {
    if(!isset($_SESSION)){
      session_start();
    }
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    

    $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($_COOKIE['nidn']);
    $data['nidn'] = $lecturer['nidn'];
    $data['name'] = $lecturer['name'];
    $data['email'] = $lecturer['email'];
    $data['phone'] = $lecturer['phone'];
    $data['gender'] = $lecturer['gender'];
    $data['image'] = $lecturer['profile_image'];
    $this->view('lecturer/profile', $data);
  }

  public function updateLecturer()
  {
    if (isset($_POST['submit'])) {
      if ($this->model('Lecturer_model')->updateLecturer($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Update',
          'New profile saved',
          'success',
          'document.location.href = "'. BASEURL .'/Project"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Update Failed',
          'Please try again',
          'error',
          'document.location.href = "'. BASEURL .'/Profile/Lecturer"'
        );
        echo Alert::AlertPopup();
      }
    }
  }  


  public function Admin()
  {
    if(!isset($_SESSION)){
      session_start();
    }
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    

    $admin = $this->model('Admin_model')->getAdminByEmail($_COOKIE['email']);
    $data['name'] = $admin['name'];
    $data['email'] = $admin['email'];
    $data['phone'] = $admin['phone'];
    $data['gender'] = $admin['gender'];
    $data['image'] = $admin['profile_image'];
    $this->view('admin/profile', $data);

    // $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($_COOKIE['nidn']);
    // $data['nidn'] = $lecturer['nidn'];
    // $data['name'] = $lecturer['name'];
    // $data['email'] = $lecturer['email'];
    // $data['phone'] = $lecturer['phone'];
    // $data['gender'] = $lecturer['gender'];
    // $data['image'] = $lecturer['profile_image'];
    // $this->view('lecturer/profile', $data);
  }

  public function updateAdmin()
  {
    if (isset($_POST['submit'])) {
      if ($this->model('Admin_model')->updateAdmin($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Update',
          'New profile saved',
          'success',
          'document.location.href = "'. BASEURL .'/Dashboard"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Update Failed',
          'Please try again',
          'error',
          'document.location.href = "'. BASEURL .'/Profile/Admin"'
        );
        echo Alert::AlertPopup();
      }
    }
  }
}