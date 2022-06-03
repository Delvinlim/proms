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
      <div class="col-md-1 mt-3 d-flex">
        <a href="<?= BASEURL ?>/Friends">
          <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
          Go Back
        </a> 
      </div>
      <div class="col-md-10 text-center">
        <h1>Friend Request</h1>
      </div>
    </div>
    <div class="table-responsive mt-3">
      <form action="<?= BASEURL ?>/Friends/Request" method="POST">
        <table class="table text-center">
          <tr>
            <th>Name</th>
            <th>NPM</th>
            <th>Accept</th>
            <th>Reject</th>
          </tr>
          <input type="hidden" name="related_student" id="related_student" value="<?= $_COOKIE['npm'] ?>">
          <?php for ($i=0; $i < count($data['requester_name']); $i++) : ?>
            <tr>
                <td class="p-3"><?= $data['requester_name'][$i] ?></td>
                <td class="p-3"><?= $data['requester_npm'][$i] ?></td>
                <td class="p-3"><button type="submit" name="accept" value="<?= $data['requester_npm'][$i] ?>" class="btn btn-success w-75">Accept Request</button></td>
                <td class="p-3"><button type="submit" name="reject" value="<?= $data['requester_npm'][$i] ?>" class="btn btn-danger w-75">Reject Request</button></td>
            </tr>
          <?php endfor; ?>
          <?php if (count($data['requester_name']) <= 0) : ?>
            <tr>
              <td colspan="4"><h3 class="mt-3">Empty Request</h3></td>
            </tr>
          <?php endif; ?>
        </table>
      </form>      
    </div>
  </div>
</body>
</html>