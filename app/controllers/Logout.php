<?php 
class Logout extends Controller
{
  public function index()
  {
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    
    $base = BASEURL;
    header("Location: $base/Auth ");    
  }
}

?>