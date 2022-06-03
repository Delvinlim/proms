<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Project</title>
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

<body onload="triggerGroupName()">
  <div class="container">
    <div class="row mt-5">
      <div class="col">
        <h1 data-aos="fade-right"><?= $data['project_name'] ?></h1>
      </div>
      <div class="col-md-1">
        <div class="d-flex flex-row align-items-center">
          <a href="<?= BASEURL ?>/Project">
            <!-- <i class="fa fa-long-arrow-left" aria-hidden="true"></i> -->
            <i class="fa fa-solid fa-square-xmark" style="font-size: 48px;" aria-hidden="true"></i>
            <!-- Go Back -->
          </a>
        </div>
      </div>      
      <hr>
      <h3 data-aos="fade-right"><?= $data['project_subject'] ?></h3>
    </div>
    
    <div class="row" data-aos="fade-up">
      <div class="col-lg-4 mt-5">
        <div class="project-information-card">
          <h3>Lecturer : <span class="fs-5"><?= $data['project_lecturer'] ?></span></h3>
          <h3>Start Date : <span class="fs-5"><?= $data['project_start_date'] ?></span></h3>
          <h3>Deadline : <span class="fs-5"><?= $data['project_end_date'] ?></span></h3>
        </div>
      </div>
      <div class="col-lg-1"></div>
      <div class="col-lg-7 mt-5">
        <div class="project-description-card">
          <h3>Description</h3>
          <p><?= $data['project_description'] ?></p>
        </div>
      </div>      
    </div>
    
    <div class="row" data-aos="fade-up">
      <div class="col-lg-4 mt-5">
        <div class="project-groups-card">
          <h3 class="text-center">Groups</h3>
          <!-- <hr> -->
          <?php if (!empty($data['team_group'])) : ?>
            <?php sort($data['team_group']) ?>
            <?php foreach (array_unique($data['team_group']) as $team) {
              // $url = $_SERVER['REQUEST_URI'];
              $url = BASEURL;
              $key = $data['project_key'];
              echo "<div class='row'>
                      <div class='col'>
                        <a href='$url/Project/DisplayProject?projectKey=$key&group=$team' class='btn btn-outline-primary mt-3 mb-3 d-flex justify-content-center'>Group $team</a>
                      </div>
                    </div>";
            } ?>
          <?php endif; ?>
          <?php if (empty($data['team_group'])) : ?>
            <hr>
            <h5 class="text-center">No Groups Yet</h5>
          <?php endif; ?>
          <?php 
            for ($i=1; $i < 6; $i++) { 
              if (!in_array($i, $data['team_group'])) {
                $setCreateButton = true;
                break;
              } else {
                $setCreateButton = false;
              }
            }
            if ($setCreateButton) {
              echo "
                <div class='text-center mt-5'>
                  <button type='button' data-bs-toggle='modal' data-bs-target='#createGroupModal' class='btn btn-join btn-lg'>Create &amp; Join</button>
                </div>
              ";
            }
            ?>
        </div>
      </div>
      <div class="col-lg-1">
        <!-- Join Button Here? -->
      </div>
      <div class="col-lg-7 mt-5">
        <div class="project-member-card text-center">
          <?php if (!empty($data['team_group_name'])) : ?>
            <?php foreach (array_unique($data['team_group_name']) as $groupName) {
              echo "<h3 class='text-center'>$groupName</h3>";
              echo "<hr>";
            } ?>
            <!-- <?= "manager here style it later <br>"; ?> -->
            <h5>Manager</h5>
            <?php foreach ($data['team_group_manager'] as $groupManager) : ?>
              <p><?= $groupManager ?></p>
            <?php endforeach; ?>
            <hr>
            <h5>Member</h5>
            <?php foreach ($data['team_group_student'] as $groupMember) : ?>
              <p><?= $groupMember ?></p>
            <?php endforeach; ?>
            <?php 
              $base = BASEURL;
              $project_name = $data['project_name'];
              $project_id = $data['project_id'];
              $npm = $_COOKIE['npm'];
              if (isset($_GET['group'])) {
                $group = $_GET['group'];
              }
              if (!empty($data['team_group_manager'])) {
                echo " <form action='$base/Project/JoinProject' method='POST'>
                  <input type='hidden' class='form-control' name='join' id='join' value='Join'>
                  <input type='hidden' class='form-control' name='projectName' id='name' value='$project_name'>
                  <input type='hidden' class='form-control' name='projectGroup' id='group' value='$group'>
                  <input type='hidden' class='form-control' name='projectId' id='projectId' value='$project_id'>
                  <input type='hidden' class='form-control' name='studentNpm' id='studentNpm' value='$npm'>
                  <button type='submit' name='submitMember' class='btn btn-join btn-lg w-100'>Join as an Member</button>
                  </form>";
              } else {
                echo " <form action='$base/Project/JoinProject' method='POST'>
                  <input type='hidden' class='form-control' name='join' id='join' value='Join'>
                  <input type='hidden' class='form-control' name='projectName' id='name' value='$project_name'>
                  <input type='hidden' class='form-control' name='projectGroup' id='group' value='$group'>
                  <input type='hidden' class='form-control' name='projectId' id='projectId' value='$project_id'>
                  <input type='hidden' class='form-control' name='managerNpm' id='managerNpm' value='$npm'>
                  <input type='hidden' class='form-control' name='studentNpm' id='studentNpm' value='$npm'>
                  <div class=row>
                    <div class=col-6>
                      <button type='submit' name='submitManager' class='btn btn-join btn-lg w-100'>Join as an Leader</button>
                    </div>
                    <div class=col-6>
                      <button type='submit' name='submitMember' class='btn btn-join btn-lg w-100'>Join as an Member</button>
                    </div>
                  </div>                  
                  </form>";                
              }
              ?>
          <?php endif; ?>
          <?php if (empty($data['team_group_name'])) : ?>
              <?php echo "<h5 class='text-center' style='line-height: 200px;'>Group Members will be shown here</h5>" ?>
          <?php endif; ?>
        </div>
      </div>
    </div>
    
    <!-- Bootstrap Modal -->
    <div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Reviews</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="<?= BASEURL ?>/Project/JoinProject" method="POST">
            <div class="modal-body">
              <!-- <input type="hidden" name="create" id="create" value="Create"> -->
              <input type="hidden" name="projectId" id="projectId" value="<?= $data['project_id'] ?>">
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="projectName" id="projectName" value="<?= $data['project_name'] . ' Group ' ?>" readonly >
              </div>
              <div class="mb-3">
                <label for="studentName" class="form-label">Student</label>
                <input type="text" class="form-control" name="studentName" id="studentName" value="<?= $data['active_user'] ?>" readonly/>
                <input type="hidden" class="form-control" name="studentNpm" id="studentName" value="<?= $data['active_user_id'] ?>" readonly/>
              </div>              
              <div class="mb-3">
                <label for="group" class="form-label">Group</label>
                <select class="form-select" name="projectGroup" id="projectGroup">
                  <option value="1" <?= (in_array(1, $data['team_group'])) ? 'disabled' : '' ?> >Group 1</option>
                  <option value="2" <?= (in_array(2, $data['team_group'])) ? 'disabled' : '' ?> >Group 2</option>
                  <option value="3" <?= (in_array(3, $data['team_group'])) ? 'disabled' : '' ?> >Group 3</option>
                  <option value="4" <?= (in_array(4, $data['team_group'])) ? 'disabled' : '' ?> >Group 4</option>
                  <option value="5" <?= (in_array(5, $data['team_group'])) ? 'disabled' : '' ?> >Group 5</option>
                </select>
              </div>
            </div>
            <div class="row mb-5 d-flex justify-content-center">
              <button type="submit" name="submitManager" class="btn btn-join" >Create and Join as an Leader</button>
              <button type="submit" name="submitMember" class="btn mt-3">Create an Join as an Member</button>
            </div>
          </form>
        </div>
      </div>
    </div>    
  </div>

  <script>
    function triggerGroupName() {
      let name = document.querySelector('#projectName');
      let group = document.querySelector('#projectGroup');
      name.value += group.value;
      group.addEventListener('change', () => {
        if (!isNaN(name.value.slice(-1))) {
          name.value = name.value.slice(0, -1); 
          name.value += group.value;
        }
      })
    };
  </script>

</body>