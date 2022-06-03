<?php 

class Flasher {

  public static function setReviewFlash($msg, $action, $type)
  {
    $_SESSION['reviewFlash'] = [
      'msg' => $msg,
      'action' => $action,
      'type' => $type
    ];
  }


  public static function flash()
  {
    if( isset($_SESSION['reviewFlash']) ) {
      echo '<div class="alert alert-' . $_SESSION['reviewFlash']['type'] . ' alert-dismissible fade show" role="alert">
        Reviews <strong>' . $_SESSION['reviewFlash']['msg'] . '</strong> ' . $_SESSION['reviewFlash']['action'] . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
      unset($_SESSION['reviewFlash']);
    }
  }
  
  

}