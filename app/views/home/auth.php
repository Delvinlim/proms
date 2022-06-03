<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Authentication</title>
  <meta content="Second Semester UTS Project Perancangan Situs Web Universitas Internasional Batam" name="description">
  <meta content="UTS Project" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@900&display=swap" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Box Icon CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Fonts Awesome Icon -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/vendor/fontawesome-free-6.1.1-web/css/all.css">

  <!-- Particle CSS -->
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/particle.css">

  <style>
    .logo img {
      transition: all 0.5s;
    }

    .logo .logo-image:hover{
      transform: translateY(-30px);
    }
  </style>
</head>

<body>
  <div id="particles-js" class=""></div>
  <div class="container">
    <div class="logo row mt-5 mb-4">
      <img src="<?= BASEURL ?>/assets/img/favicon.png" class="img-fluid logo-image" alt="Logo Project Management System">
    </div>

    <div class="row text-center">
      <div class="col-lg-6 col-md-12 mt-5">
        <div class="d-grid gap-2 col-8 mx-auto">
          <a href="<?= BASEURL ?>/StudentAuth/Login" class="btn btn-auth btn-lg fs-4">Student</a>
          <!-- <button class="btn btn-auth btn-lg fs-4" type="button"><a href="<?= BASEURL ?>/StudentAuth/Login">Student</a></button> -->
        </div>
      </div>
      <div class="col-lg-6 col-md-12 mt-5">
        <div class="d-grid gap-2 col-8 mx-auto">
          <a href="<?= BASEURL ?>/LecturerAuth/Login" class="btn btn-auth btn-lg fs-4">Lecturer</a>
          <!-- <button class="btn btn-auth btn-lg fs-4"><a href="">Lecturer</a></button> -->
        </div>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-12 mt-5">
        <div class="d-grid gap-2 col-8 mx-auto">
          <a href="<?= BASEURL ?>/AdminAuth/Login" class="btn btn-auth btn-lg fs-4">Admin</a>
          <a href="<?= BASEURL ?>" class="btn fs-4">Go Back</a>
          <!-- <button class="btn btn-auth btn-lg fs-4"><a href="">Admin</a></button> -->
        </div>
      </div>
    </div>
  </div>