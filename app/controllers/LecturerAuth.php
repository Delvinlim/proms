<?php 

class LecturerAuth extends Controller
{
  public function index()
  {
    session_start();
    if(!isset($_SESSION["Login"]) ) {
      header('Location: '. BASEURL .'/Auth');
      exit;
    }
  }

  public function Register()
  {
    $this->view('templates/auth/registerHeader');
    $this->view('lecturer/register');

    if (isset($_POST['submit'])) {
      if ($this->model('Lecturer_model')->addLecturer($_POST) > 0) {
        Alert::setAlertPopup(
          'Register Successfully',
          'Please login with your NIDN',
          'success',
          'document.location.href = "'. BASEURL .'/LecturerAuth/Login"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Register Failed', 
          'User already registered', 
          'error', 
          'document.location.href = "'. BASEURL .'/LecturerAuth/Register"'
        );
        echo Alert::AlertPopup();
      }
    }
  }
  
  public function Login()
  {
    if(!isset($_SESSION)){
      session_start();
    }

    if(isset($_SESSION["Login"]) ) {
      // session_destroy();
      header('Location: '. BASEURL .'/Project'.'');
      exit;
    }

    $this->view('templates/auth/loginHeader');
    $this->view('lecturer/login');

    if (isset($_POST['submit'])) {
      $lecturer = $this->model('Lecturer_model')->getLecturerByNidn($_POST['nidn']);
      if ($lecturer) {
        if (isset($_COOKIE['npm'])) {
          unset($_COOKIE['npm']);
          setcookie("npm", "", time() - 3600, '/');
          // var_dump("hello");die;
        }        
        $inputtedPassword = $_POST['password'];
        $password = $lecturer['password'];
        $name = $lecturer['name'];
        $nidn = $lecturer['nidn'];
        if (password_verify($inputtedPassword, $password)) {
          setcookie("nidn", $nidn, time() + 86400, '/');
          $_SESSION["Login"]= true;
          $_SESSION["L_Login"]= true;
          Alert::setAlertPopup(
            'Successfully Authenticated',
            'Welcome '. $name .'', 
            'success', 
            'document.location.href = "'. BASEURL .'/Project"'
          );          
          echo Alert::AlertPopup();          
        } else {
          Alert::setAlertPopup(
            'Failed',
            'Invalid credentials', 
            'error', 
            'document.location.href = "'. BASEURL .'/LecturerAuth/Login"'
          );          
          echo Alert::AlertPopup();
        }
        exit;
      } else {
        Alert::setAlertPopup(
          'Failed', 
          'User not registered', 
          'error', 
          'document.location.href = "'. BASEURL .'/LecturerAuth/Login"'
        );
        echo Alert::AlertPopup();
      }
    }    
  }    
}


?>