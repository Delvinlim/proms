<?php 
class Reviews extends Controller
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
      $data['active_state'] = "Reviews";
    }

    $this->view('templates/project/header', $data);
    // $this->view('project/index', $data);
    $this->view('reviews/index');
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
    $reviews = $this->model('Reviews_model')->getReviews($limit_start, $limit);
    $reviews_count = $this->model('Reviews_model')->countReviews();
    $data['name'] = isset ($admin['name']) ? $admin['name'] : 'Admin' ;
    $data['image'] = $admin['profile_image'];
    $data['admin'] = $admin;
    $data['active_state'] = "Reviews";
    $data['reviews'] = $reviews;

    $data['page'] = $page;
    $data['reviews_no'] = $no;
    $data['reviews_total'] = $reviews_count['total'];
    $data['reviews_limit'] = $limit;

    $data['reviews_id'] = [];
    $data['reviews_name'] = [];
    $data['reviews_job'] = [];
    $data['reviews_comment'] = [];
    $data['reviews_image'] = [];
    $data['reviews_status'] = [];

    foreach ($reviews as $review) {
      array_push($data['reviews_id'], $review['id']);
      array_push($data['reviews_name'], $review['name']);
      array_push($data['reviews_job'], $review['job']);
      array_push($data['reviews_comment'], $review['comment']);
      array_push($data['reviews_image'], $review['image']);
      array_push($data['reviews_status'], $review['status']);
    }

    $this->view('reviews/list', $data);
  }

  public function Approve()
  {
    if (isset($_GET['id'])) {
      if ($this->model('Reviews_model')->approveReviews($_GET) > 0) {
        Alert::setAlertPopup(
          'Approved',
          'Reviews Approved',
          'success',
          'document.location.href = "'. BASEURL .'/Reviews"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Fail to approved please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Reviews"'
        );
        echo Alert::AlertPopup();
      }
    }
  }
  
  public function Reject()
  {
    if (isset($_GET['id'])) {
      if ($this->model('Reviews_model')->rejectReviews($_GET) > 0) {
        Alert::setAlertPopup(
          'Rejected',
          'Reviews has been removed from database',
          'success',
          'document.location.href = "'. BASEURL .'/Reviews"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Fail to reject please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'/Reviews"'
        );
        echo Alert::AlertPopup();
      }
    }
  }
}


?>