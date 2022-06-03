<?php 

class StudentAuth extends Controller
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
    $this->view('student/register');

    if (isset($_POST['submit'])) {
      if ($this->model('Student_model')->addStudent($_POST) > 0) {
        Alert::setAlertPopup(
          'Register Successfully',
          'Please login with your NPM',
          'success',
          'document.location.href = "'. BASEURL .'/StudentAuth/Login"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Register Failed', 
          'User already registered', 
          'error', 
          'document.location.href = "'. BASEURL .'/StudentAuth/Register"'
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
    $this->view('student/login');

    if (isset($_POST['submit'])) {
      $student = $this->model('Student_model')->getStudentByNpm($_POST['npm']);
      if ($student) {
        if (isset($_COOKIE['nidn'])) {
          unset($_COOKIE['nidn']);
          setcookie("nidn", "", time() - 3600, '/');
        }        
        $inputtedPassword = $_POST['password'];
        $password = $student['password'];
        $name = $student['name'];
        $npm = $student['npm'];
        if (password_verify($inputtedPassword, $password)) {
          setcookie("npm", $npm, time() + 86400, '/');
          $_SESSION["Login"]= true;
          $_SESSION["S_Login"]= true;
          $_SESSION["S_NPM"]= $npm;
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
            'document.location.href = "'. BASEURL .'/StudentAuth/Login"'
          );
          echo Alert::AlertPopup();
        }
        exit;
      } else {
        Alert::setAlertPopup(
          'Failed', 
          'User not registered', 
          'error', 
          'document.location.href = "'. BASEURL .'/StudentAuth/Login"'
        );
        echo Alert::AlertPopup();
      }
    }    
  }    
}


?>