<?php 

class AdminAuth extends Controller
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
    $this->view('admin/register');

    if (isset($_POST['submit'])) {
      if ($this->model('Admin_model')->addAdmin($_POST) > 0) {
        Alert::setAlertPopup(
          'Register Successfully',
          'Please login with your Email',
          'success',
          'document.location.href = "'. BASEURL .'/AdminAuth/Login"'
        );
        echo Alert::AlertPopup();
      } else {
        Alert::setAlertPopup(
          'Register Failed', 
          'User already registered', 
          'error', 
          'document.location.href = "'. BASEURL .'/AdminAuth/Register"'
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
      header('Location: '. BASEURL .'/Dashboard'.'');
      exit;
    }

    $this->view('templates/auth/loginHeader');
    $this->view('admin/login');

    if (isset($_POST['submit'])) {
      $admin = $this->model('Admin_model')->getAdminByEmail($_POST['email']);
      if ($admin) {
        if (isset($_COOKIE['nidn'])) {
          unset($_COOKIE['nidn']);
          setcookie("nidn", "", time() - 3600, '/');
        }
        if (isset($_COOKIE['npm'])) {
          unset($_COOKIE['npm']);
          setcookie("npm", "", time() - 3600, '/');
        }
        $inputtedPassword = $_POST['password'];
        $password = $admin['password'];
        $name = $admin['name'];
        $email = $admin['email'];

        if (password_verify($inputtedPassword, $password)) {
          setcookie("email", $email, time() + 86400, '/');
          $_SESSION["Login"] = true;
          $_SESSION["A_Login"] = true;
          $_SESSION["A_Email"] = $email;
          Alert::setAlertPopup(
            'Successfully Authenticated', 
            'Welcome '. $name .'', 
            'success', 
            'document.location.href = "'. BASEURL .'/Dashboard"'
          );          
          echo Alert::AlertPopup();
        } else {
          Alert::setAlertPopup(
            'Failed',
            'Invalid credentials', 
            'error', 
            'document.location.href = "'. BASEURL .'/AdminAuth/Login"'
          );
          echo Alert::AlertPopup();
        }
        exit;
      } else {
          Alert::setAlertPopup(
            'Failed', 
            'User not registered', 
            'error', 
            'document.location.href = "'. BASEURL .'/AdminAuth/Login"'
          );
          echo Alert::AlertPopup();
      }
    }
  }    
}


?>