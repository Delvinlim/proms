<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php foreach (array_unique($data['team_member_group']) as $group) {
    echo "<title>Group $group</title>";
  } ?>
  <link rel="preconnect" href="https://fonts.gstatic.com">

  <!-- Favicons -->
  <link href="<?= BASEURL ?>/assets/img/favicon.png" rel="icon">
  <link href="<?= BASEURL ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Convergence&family=Lato:wght@300;400;700;900&family=Mukta:wght@300;400;600;700;800&family=Noto+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- AOS CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Swiper CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASEURL; ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Box Icon CSS -->
  <link href="<?= BASEURL; ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

  <!-- Fonts Awesome Icon -->
  <link rel="stylesheet" href="<?= BASEURL; ?>/assets/vendor/fontawesome-free-6.1.1-web/css/all.css">

  <!-- Main CSS -->
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/project_empty.css">
</head>
