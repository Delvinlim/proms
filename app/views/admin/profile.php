<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta content="Second Semester Project Universitas Internasional Batam" name="description">
  <meta content="UTS Project" name="keywords">
  <title><?= isset($_GET['update']) ? "Edit Profile" : "Profile" ?></title>

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
  <div class="container mt-5 profile">
    <form action="<?= BASEURL ?>/Profile/UpdateAdmin" enctype="multipart/form-data" method="POST">
      <div class="row d-flex justify-content-center">
        <div class="d-flex flex-row mt-4 ms-5">
          <a href="<?= BASEURL ?>/Dashboard">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            Go Back
          </a>
          <?php if (!isset($_GET['update'])) : ?>
          <a href="<?= BASEURL ?>/Profile/Admin?update=1" class="ms-auto me-5 btn btn-save">Update Profile</a>
          <?php elseif (isset($_GET['update'])) : ?>
          <a href="<?= BASEURL ?>/Profile/Admin" class="ms-auto me-5 btn btn-save">Cancel</a>
          <?php endif; ?>
        </div>
        
        <div class="col-md-4">
          <div class="d-flex flex-column align-items-center text-center p-3 py-5 mt-2">
            <div class="image-preview">
              <img src="<?= BASEURL . '/assets/img/profiles/' . $data['image'] ?>" alt="Profile" class="img-fluid profile-image">
            </div>
            <?php if (isset($_GET['update'])) : ?>
              <input type="file" class="form-control-file mt-3 ms-5 ps-5" name="image" id="image" >
            <?php endif; ?>
          </div>
        </div>

        <div class="col-md-8">
          <div class="p-3 py-5">
            <div class="row mt-2">
              <div class="col-md-5">
                <input type="hidden" name="profile_image" class="form-control" placeholder="NPM" value="<?= $data['image'] ?>">
                <!-- <input type="hidden" name="nidn" class="form-control" placeholder="NIDN" value="<?= $data['nidn'] ?>"> -->
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="<?= $data['name'] ?>" <?= !isset($_GET['update']) ? "disabled" : "" ?> >
              </div>
              <div class="col-md-5">
                <label for="gender">Gender</label>
                <select class="form-select" name="gender" id="gender" <?= !isset($_GET['update']) ? "disabled" : "" ?> >
                  <option disabled selected value>-- Select an option --</option>
                  <option value="Male" <?= $data['gender'] == "Male" ? 'selected' : '' ?> >Male</option>
                  <option value="Female" <?= $data['gender'] == "Female" ? 'selected' : '' ?> >Female</option>
                  <option value="Unknown" <?= $data['gender'] == "Unknown" ? 'selected' : '' ?> >Rather not to say</option>
                </select>
              </div>              
            </div>

            <div class="row mt-3">
              <div class="col-md-5">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Email" value="<?= $data['email'] ?>" <?= !isset($_GET['update']) ? "disabled" : "" ?> >
              </div>
              <div class="col-md-5">
                <label for="phone">Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Phone Number" value="<?= $data['phone'] ?>" <?= !isset($_GET['update']) ? "disabled" : "" ?> >
              </div>              
            </div>

            <?php if (isset($_GET['update'])) : ?>
            <div class="mt-4 text-right d-grid col-md-10">
              <button class="btn btn-save profile-button" type="submit" name="submit">Save Profile</button>
            </div>
            <?php endif; ?>
            
          </div>
        </div>
      </div>
    </form>
  </div>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    function imagePreview(fileInput) {
        if (fileInput.files && fileInput.files[0]) {
            var fileReader = new FileReader();
            fileReader.onload = function (event) {
                if($('.profile-image')) {
                  $('.profile-image').remove();
                }
                $('.image-preview').html('<img src="'+event.target.result+'" class="profile-image" />');
            };
            fileReader.readAsDataURL(fileInput.files[0]);
        }
    }

    $("#image").change(function () {
        imagePreview(this);
    });    
  </script>
</body>
</html>