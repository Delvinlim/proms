<?php 

class Auth extends Controller
{
  public function index()
  {
    if (isset($_SESSION["Login"])) {
      header('Location: '. BASEURL .'/Project ');
      exit;
    }

    $this->view('home/auth');
    $this->view('templates/auth/footer');
  }
}

?>