<?php 

class Alert
{
  public static function setAlertPopup($title, $description, $type, $cb)
  {
    $_SESSION['Alert'] = [
      'title' => $title,
      'description' => $description,
      'type' => $type,
      'cb' => $cb
    ];
  }

  public static function AlertPopup()
  {
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  if(isset($_SESSION['Alert'])) {
      echo '<script type="text/javascript">
      setTimeout(() => { 
        swal("'. $_SESSION['Alert']['title'] .'","'. $_SESSION['Alert']['description'] .'","'. $_SESSION['Alert']['type'] .'")
        .then(() => {
          '. $_SESSION['Alert']['cb'] .'
        })
    }, 300);
    </script>';
    unset($_SESSION['Alert']);
    }
  }

  public static function setAlertQuestion($title, $description, $type, $cb)
  {
    $_SESSION['Alert_Question'] = [
      'title' => $title,
      'description' => $description,
      'type' => $type,
      'cb' => $cb
    ];
  }

  public static function AlertQuestion()
  {
  echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
  if(isset($_SESSION['Alert_Question'])) {
      echo '<script type="text/javascript">
      setTimeout(() => { 
        swal(
          "title: '. $_SESSION['Alert_Question']['title'] .'",
          "text: '. $_SESSION['Alert_Question']['description'] .'",
          "icon: '. $_SESSION['Alert_Question']['type'] .'"
          "button: true"
          "dangerMode: true",
        )
        .then((willDelete) => {
          if (willDelete) {
            swal(
              "Removed",
              "You leaved the project",
              "success"
            )
            .then(() => {
              '. $_SESSION['Alert_Question']['cb'] .'
            })
          } else {
            swal("Your imaginary file is safe!")
              .then(() => {
                '. $_SESSION['Alert_Question']['cb'] .'
              })
          }
        })
    }, 300);
    </script>';
    unset($_SESSION['Alert_Question']);
    }
  }  


}
?>