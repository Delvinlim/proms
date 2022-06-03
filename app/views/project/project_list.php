  <?php if (isset($data['student'])) : ?>
    <?php if (!$data['teams']) : ?>
      <div class="container no-project">
        <div class="row">
          <h1 class="text-center display-3">Welcome</h1>
          <h3 class="text-center fs-1"><?= $data['name'] ?></h3>
          <p class="text-center fs-3">You don't have any active project yet!</p>
        </div>
        <div class="row mt-3">
          <div class="col-lg-6 col-md-12 order-lg-1 mt-3">
            <p class="fs-4">Join with Project Key</p>
            <!-- <label for="project">Join with Project Key</label> -->
            <form action="<?= BASEURL ?>/Project/DisplayProject" method="GET">
              <div class="input-box">
                <i class="fa-solid fa-key"></i>
                <input type="text" class="input" name="projectKey" placeholder="Insert Project Key" autocomplete="off" required>
              </div>
              <div class="button-input-box mt-3">
                <button type="submit" class="btn btn-join">Join</button>
              </div>
            </form>
          </div>
          <div class="col-lg-6 col-md-12 d-flex justify-content-center mt-3">
            <iframe src="https://embed.lottiefiles.com/animation/64762"></iframe>
          </div>
        </div>
      </div>
    <?php endif; ?>
    
    <!-- got team views here -->
    <?php if ($data['teams']) : ?>
      <div class="container mt-3">
        <!-- <div class="text-center display-1">You got a project!</div> -->
        <div class="row">
          <?php for ($i=0; $i < count($data['teams']); $i++) { 
            $base = BASEURL;
            $counter = $i + 1;
            echo "
              <div class='col-lg-4 col-md-6 col-sm-12'>
                <div class='project-card'>
                  <div class='d-flex position-absolute'>
                    <p class='mb-0 badge bg-secondary rounded-pill'>Group ". $data['project_group'][$i] ."</p>
                  </div>
                  <div class='project-card-delete-wrapper'>
                    <a href='$base/Project/LeaveProject?project_id=". $data['project_id'][$i] ."&group=". $data['project_group'][$i] ."&npm=". $_COOKIE['npm'] ."'>
                      <i class='fa-solid fa-close project-card-delete'></i>
                    </a>            
                  </div>
                  <div class='project-card-title text-center pt-4'>
                    <div class='row ps-5'>
                      <h4>". $data['project_name'][$i] ."</h4>
                    </div>
                    <hr>
                  </div>

                  <div class='d-flex ps-3'>
                    <h5 class='text-uppercase text-center'>Start Date</h5>
                    <p class='ps-3 pe-3'> <strong class='pe-3'>:</strong>". $data['project_start_date'][$i] ."</p>
                  </div>                

                  <div class='d-flex ps-3'>
                    <h5 class='text-uppercase text-center'>End Date</h5>
                    <p class='ps-3 pe-3'> <strong class='pe-3'>:</strong>". $data['project_end_date'][$i] ."</p>
                  </div>

                  <div class='d-flex ps-3'>
                    <h5 class='text-uppercase text-center'>Project Key</h5>
                    <p class='ps-3 pe-3'> <strong class='pe-3'>:</strong>". $data['project_key'][$i] ."</p>
                  </div>
                  
                  <div class='d-flex ps-3'>
                    <h5 class='text-uppercase text-center'>Lecturer</h5>
                    <p class='ps-3 pe-3'> <strong class='pe-3'>:</strong>". $data['project_lecturer'][$i] ."</p>
                  </div>

                  <div class='d-flex ps-3'>
                    <h5 class='text-uppercase text-center'>Subject</h5>
                    <p class='ps-3 pe-3'> <strong class='pe-3'>:</strong>". $data['project_subject'][$i] ."</p>
                  </div>                

                  <h5 class='text-uppercase text-center mt-1'>Description</h5>
                  <div class='project-card-description ps-3 pe-3'>
                    <p class='text-truncate'>". $data['project_description'][$i] ."</p>
                  </div>                
                  <div class='project-card-button text-center fixed-bottom position-absolute p-3'>
                    <hr>
                    <a href='$base/Project/Details?id=". $data['project_id'][$i] ."&group=". $data['project_group'][$i] ."' class='btn btn-details'>
                      <span>Details</span>
                      <svg viewBox='0 0 13 10' height='10px' width='15px'>
                        <path d='M1,5 L11,5'></path>
                        <polyline points='8 1 12 5 8 9'></polyline>
                      </svg>
                    </a>
                  </div>
                </div>
              </div>
                ";
              }?>
        <div>
          <button type='button' class='add-project' data-bs-toggle='modal' data-bs-target='#joinProjectModal'>
            <div class='add-button'><i class='fa-solid fa-plus'></i></div>
          </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="joinProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content text-center">
              <form action="<?= BASEURL ?>/Project/DisplayProject" method="GET">
                <div class="modal-header">
                  <h5 class="modal-title">Join Project</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <i class="fa-solid fa-key mb-3"></i>
                  <input type="text" class="form-control" name="projectKey" placeholder="Insert Project Key" autocomplete="off" required>                
                </div>
                <div class="modal-footer d-flex justify-content-center">
                  <button type="submit" class="btn btn-join">Join Project</button>
                </div>

              </form>
            </div>
          </div>
        </div>      
      </div>
    <?php endif ?>

    <nav class="mt-3 pt-3">
      <ul class="pagination justify-content-center">
        <?php
        $page = (int)$data['page'];
        $total_page = ceil((int)$data['teams_total'] / (int)$data['teams_limit']);
        $total_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $total_number) ? $page - $total_number : 1;
        $end_number = ($page < ($total_page - $total_number)) ? $page + $total_number : $total_page;

        // if ($page == 1) {
        //   echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        //   echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        // } else {
        //   $link_prev = ($page > 1) ? $page - 1 : 1;
        //   echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
        //   echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        // }

        for ($i = $start_number; $i <= $end_number; $i++) {
          $link_active = ($page == $i) ? ' active' : '';
          echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        // if ($page == $total_page) {
        //   echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        //   echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        // } else {
        //   $link_next = ($page < $total_page) ? $page + 1 : $total_page;
        //   echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        //   echo '<li class="page-item halaman" id="' . $total_page . '"><a class="page-link" href="#">Last</a></li>';
        // }
        ?>
      </ul>
    </nav>    
  <?php endif ?>

  <?php if(isset($data['lecturer'])) : ?>
    <div class="container mt-3">
      <h1>Hello <?= $data['name'] ?></h1>
      <h5 class="pb-3"><?= count($data['project']); ?> Projects</h5>
      <div class="row">
        <?php for ($i=0; $i < count($data['project']); $i++) :?>
          <div class="col-lg-3 col-md-6 col-sm-12 d-flex justify-content-center">
            <div class="card border-secondary mb-3" style="max-width: 18rem; height: 18rem;" >
              <div class="card-body">
                <h4 class="card-title"><?= $data['project_name'][$i]; ?></h3>
                <h6 class="card-subtitle mb-2 text-muted"><?= $data['project_subject'][$i] ?></h6>
                <p class="card-text text-truncate-custom"><?= $data['project_description'][$i] ?></p>
                <div class="fixed-bottom position-absolute p-3">
                  <a href="<?= BASEURL ?>/Project/Details?id=<?= $data['project_id'][$i] ?>" class="btn btn-join w-100">Details</a>
                </div>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>

      <div>
        <button type='button' class='add-project' data-bs-toggle='modal' data-bs-target='#createProjectModal'>
          <div class='add-button'><i class='fa-solid fa-plus'></i></div>
        </button>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
          <form action="" method="POST">
            <div class="modal-header">
              <h5 class="modal-title">Create Project</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="lecturer_id" id="lecturer_id" value="<?= $data['lecturer_nidn'] ?>">
              <div class="mb-3">
                <label for="name" class="form-label">Project Name</label>
                <input type="text" class="form-control" name="name" id="name">
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Project Key</label>
                <input type="text" class="form-control" name="project_key" id="project_key">
              </div>
              <div class="mb-3">
                <div class="row">
                  <div class="col">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" id="start_date">
                  </div>
                  <div class="col">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" id="end_date">                    
                  </div>
                </div>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
              </div>
              <div class="mb-3">
                <label for="image" class='mb-2'>Subject</label>
                <select class="form-select" name="subject_id" id="gender">
                    <option disabled selected value>-- Select an option --</option>
                    <?php for ($i=0; $i < count($data['subject']); $i++) : ?>
                      <option value="<?= $data['subject_id'][$i] ?>"><?= $data['subject_name'][$i] ?></option>
                    <?php endfor; ?>
                </select>
              </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="submit" name="create_project" class="btn btn-join">Create Project</button>
            </div>
          </form>
        </div>
      </div>
    </div>          

    <nav class="mt-3 pt-3">
      <ul class="pagination justify-content-center">
        <?php
        $page = (int)$data['page'];
        $total_page = ceil((int)$data['projects_total'] / (int)$data['projects_limit']);
        $total_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
        $start_number = ($page > $total_number) ? $page - $total_number : 1;
        $end_number = ($page < ($total_page - $total_number)) ? $page + $total_number : $total_page;

        // if ($page == 1) {
        //   echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        //   echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        // } else {
        //   $link_prev = ($page > 1) ? $page - 1 : 1;
        //   echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
        //   echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
        // }

        for ($i = $start_number; $i <= $end_number; $i++) {
          $link_active = ($page == $i) ? ' active' : '';
          echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
        }

        // if ($page == $total_page) {
        //   echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        //   echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
        // } else {
        //   $link_next = ($page < $total_page) ? $page + 1 : $total_page;
        //   echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        //   echo '<li class="page-item halaman" id="' . $total_page . '"><a class="page-link" href="#">Last</a></li>';
        // }
        ?>
      </ul>
    </nav>
  <?php endif; ?>

