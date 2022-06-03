<?php 

class Friends extends Controller
{
  public function index()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    

    $this->view('friends/index');
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
    $friends_count = $this->model('Friends_model')->countFriends($_COOKIE['npm']);

    $data['page'] = $page;
    $data['friends_no'] = $no;
    $data['friends_total'] = $friends_count['total'];
    $data['friends_limit'] = $limit;

    $requests = $this->model('Friends_model')->getFriends($_COOKIE['npm'], $limit_start, $limit);
    $data['requester_name'] = [];
    $data['requester_npm'] = [];
    foreach ($requests as $request) {
      $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
      array_push($data['requester_name'], $student['name']);
      array_push($data['requester_npm'], $student['npm']);
    }

    $this->view('friends/friends', $data);
  }

  public function Request()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    

    $requests = $this->model('Friends_model')->getFriendRequest($_COOKIE['npm']);
    $data['requester_name'] = [];
    $data['requester_npm'] = [];
    foreach ($requests as $request) {
      $student = $this->model('Student_model')->getStudentByNpm($request['relating_student']);
      array_push($data['requester_name'], $student['name']);
      array_push($data['requester_npm'], $student['npm']);
    }

    if (isset($_POST['accept']) && isset($_POST['related_student']) ) {
      $_POST['relating_student'] = $_POST['accept'];
      if ($this->model('Friends_model')->acceptFriendRequest($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Accepted',
          'Congrats, you guys are a buddy now',
          'success',
          'document.location.href = "'. BASEURL .'/Friends"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Accept Failed',
          'Please try again later',
          'error',
          'document.location.href = "'. BASEURL .'/Friends/Request"'
        );
        echo Alert::AlertPopup();
      }
    }

    if (isset($_POST['reject']) && isset($_POST['related_student']) ) {
      $_POST['relating_student'] = $_POST['reject'];
      if ($this->model('Friends_model')->rejectFriendRequest($_POST) > 0) {
        Alert::setAlertPopup(
          'Successfully Rejected',
          'You rejected the request',
          'success',
          'document.location.href = "'. BASEURL .'/Friends"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Reject Failed',
          'Please try again later',
          'error',
          'document.location.href = "'. BASEURL .'/Friends/Request"'
        );
        echo Alert::AlertPopup();
      }
    }

    $this->view('friends/request', $data);    
  }

  public function Delete()
  {
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth ');
      exit;
    }    
    
    if (isset($_GET['npm'])) {
      $_GET['relating_student'] = $_GET['npm'];
      $_GET['related_student'] = $_COOKIE['npm'];
      if ($this->model('Friends_model')->deleteFriend($_GET) > 0) {
        Alert::setAlertPopup(
          'Successfully Deleted',
          'You guys are not a buddy anymore',
          'success',
          'document.location.href = "'. BASEURL .'/Friends"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Delete Failed',
          'Please try again later',
          'error',
          'document.location.href = "'. BASEURL .'/Friends"'
        );
        echo Alert::AlertPopup();
      }      
    }
  }

}

?>