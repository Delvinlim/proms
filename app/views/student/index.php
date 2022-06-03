<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Second Semester Project Universitas Internasional Batam" name="description">
  <meta content="UTS Project" name="keywords">
  <title>Friends</title>

  <!-- Favicons -->
  <link href="<?= BASEURL ?>/assets/img/favicon.png" rel="icon">
  <link href="<?= BASEURL ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@900&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="<?= BASEURL ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASEURL ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Box Icon CSS -->
  <link href="<?= BASEURL ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Fonts Awesome Icon -->
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/vendor/fontawesome-free-6.1.1-web/css/all.css">

  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/profile.css">
</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-2 mt-3">
        <a href="<?= BASEURL ?>/Project">
          <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
          Go Back
        </a> 
      </div>
      <div class="col-md-7 text-center">
        <h1>All Students</h1>
      </div>
      <div class="col-md-3 mt-2">
        <div class="d-flex">
          <i class="fa fa-search p-3" aria-hidden="true"></i>
          <input type="text" placeholder="Search Students here" id="keyword" name="keyword" class="form-control">
        </div>
      </div>
    </div>
    <div class="table-responsive" id="data"></div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(() => {
      load_all_students('');

      function load_all_students(keyword, page) {
        $.ajax({
          url: "<?= BASEURL ?>/Student/StudentList",
          method: "POST",
          data: {keyword: keyword, page: page},
          success: (data) => {
            console.log(data);
            $('#data').html(data);
          }
        })
      }

      $("#keyword").keyup(() => {
        var keyword = $("#keyword").val();
        load_all_students() ? keyword != "" :  
        keyword != "" ? load_all_students(keyword) : load_all_students(""); 
      })

      $(document).on('click', '.halaman', function(){
        var keyword = $("#keyword").val();
        var page = $(this).attr("id");
        load_all_students(keyword, page);
      });      
    })
  </script>
</body>
</html> 