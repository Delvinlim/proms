<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $data['active_state'] ?></title>
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
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/project.css">
  <link rel="stylesheet" href="<?= BASEURL ?>/assets/css/project_empty.css">
</head>

<header id="header" class="header d-flex align-items-center" >
  <div class="container d-flex align-items-center justify-content-between">
    <div class='logo d-flex align-items-center'>
      <img src="<?= BASEURL ?>/assets/img/favicon.png" alt="Logo" class="img-fluid logo-image" />
      <span class="fs-4"><?= $data['active_state'] ?></span>
      <!-- <label class="switch ms-3 mt-1">
        <input type="checkbox" class="toggleDark">
        <span class="slider"></span>
      </label> -->
    </div>

    <!-- NAVIGATION -->
    <nav id="navbar" class="navbar order-1">
      <ul class="">
        <?php if (isset($_SESSION['A_Login'])) : ?>
          <li>
            <a href="<?= BASEURL ?>/Dashboard" class="nav-link <?= $data['active_state'] == "Dashboard" ? "active" : "" ?> ">Dashboard</a>
          </li>
          <li>
            <a href="<?= BASEURL ?>/Reviews" class="nav-link <?= $data['active_state'] == "Reviews" ? "active" : "" ?> ">Reviews</a>
          </li>
          <li>
            <a href="<?= BASEURL ?>/Subject" class="nav-link <?= $data['active_state'] == "Subject" ? "active" : "" ?> ">Subject</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['S_Login']) or isset($_SESSION['L_Login'])) : ?>
          <li>
            <a href="<?= BASEURL ?>/Project" class="nav-link <?= $data['active_state'] == "Project" ? "active" : "" ?>">Project</a>
          </li>
        <?php endif; ?>
        <?php if (isset($_SESSION['S_Login'])) : ?>
          <li>
            <a href="<?= BASEURL ?>/Task" class="nav-link <?= $data['active_state'] == "Task" ? "active" : "" ?>">Task</a>
          </li>
        <?php endif; ?>
      </ul>
      <i class="bi bi-list mobile-nav-toggle pe-3"></i>
    </nav>
    <!-- End Navigation -->

    <!-- ICON NAVIGATION -->
    <nav class="dashboard-header-nav order-sm-2">
      <ul class="d-flex align-items-center" style="list-style: none;">
        <li class="nav-item dropdown">
          <div class="nav-link nav-profile d-flex justify-content-center align-items-center pt-4" data-bs-toggle="dropdown">
            <img src="<?= BASEURL ?>/assets/img/profiles/<?= $data['image'] ?>" alt="Profile" class="rounded-circle profile-image"/>
            <span class="d-none d-md-block dropdown-toggle ps-2" style="cursor: pointer;"><?= $data['name']; ?></span>
          </div>

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-dashboard-header text-center">
              <h6><?= $data['name'] ?></h6>
              <!-- <span><?= isset($_SESSION['S_Login']) ? "Student" : "Lecturer" ?></span> -->
              <span><?php if (isset($_SESSION['S_Login'])) {
                echo "Student";
              } elseif (isset($_SESSION['L_Login'])) {
                echo "Lecturer";
              } else {
                echo "Admin";
              } ?></span>
              <!-- <span>Student</span> -->
            </li>

            <li>
              <hr class="dropdown-divider" />
            </li>

            <li>
              <a href="<?= BASEURL ?>/Profile/<?php if (isset($_SESSION['S_Login'])) { echo "Student"; } elseif (isset($_SESSION['L_Login'])) { echo "Lecturer"; } else { echo "Admin"; } ?>" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-person"></i>
                <span>Profile</span>
              </a>
            </li>

            <li>
              <hr class="dropdown-divider" />
            </li>

            <?php if (isset($_SESSION['S_Login'])) : ?>
            <li>
              <a href="<?= BASEURL ?>/Friends" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-people"></i>
                <span>Friendlist</span>
                <?php if (count($data['requester_name']) > 0): ?>
                  <span>
                    <p class="badge" style="color: #ff5e5e; font-size: 16px;"><?= count($data['requester_name']) ?></p>
                  </span>
                <?php endif; ?>
              </a>
            </li>
            
            <li>
              <hr class="dropdown-divider" />
            </li>
            <?php endif; ?>

            <li>
              <a href="<?= BASEURL ?>/Logout" class="dropdown-item d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul>
          <!-- End Profile Dropdown Items -->
        </li>
        <!-- End Profile Nav -->

      </ul>
    </nav>
    <!-- End Icons Navigation -->

  </div>

  <!-- {/* <i class={`bi bi-list mobile-nav-toggle ${mobileActive ? "bi-list bi-x" : "" }`} onClick={handleToggle}></i> */} -->

</header>