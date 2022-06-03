<?php 
class Home extends Controller {
  public function index()
  {
    $reviews = $this->model('Reviews_model')->getApprovedReviews();
    // $reviews = $this->model('Reviews_model')->getReviews(1,2);
    $data['reviewer_name'] = [];
    $data['reviewer_job'] = [];
    $data['reviewer_image'] = [];
    $data['reviewer_comment'] = [];

    foreach ($reviews as $review) {
      array_push($data['reviewer_name'], $review['name']);
      array_push($data['reviewer_job'], $review['job']);
      array_push($data['reviewer_comment'], $review['comment']);
      array_push($data['reviewer_image'], $review['image']);
    }
    
    $this->view('templates/home/header');
    $this->view('home/index', $data);
    $this->view('templates/home/footer');

    if (isset($_POST['submit'])){
      if( $this->model('Reviews_model')->createReviews($_POST) > 0 ) {
        Alert::setAlertPopup(
          'Success', 
          'Data successfully Upload into Database', 
          'success', 
          'document.location.href = "'. BASEURL .'"'
        );          
        echo Alert::AlertPopup();           
        exit;
      } else {
        Alert::setAlertPopup(
          'Failed',
          'Unable to join the project, Please try again later', 
          'error',
          'document.location.href = "'. BASEURL .'"'
        );          
        echo Alert::AlertPopup();
      }
    }
  }
}

