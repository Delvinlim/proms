<body>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-3">
        <div class="d-flex flex-row align-items-center mt-2">
          <a href="<?= BASEURL ?>/Project">
            <i class="fa fa-long-arrow-left" aria-hidden="true"></i>
            Go Back
          </a>
        </div>
      </div>
      <div class="col-md-6">
        <h1 class="text-center"><?= $data['project_name'] ?></h1>
      </div>
      <div class="col-md-3">
        <button class="btn btn-join w-100 mt-1" type="button" data-bs-toggle="modal" data-bs-target="#getProjectMember" <?= !isset($_GET['group']) ? "disabled" : "" ?> >Get Member List</button>
      </div>
      <hr>
      
      <div class="form-group">
        <div class="row mb-3">
          <label for="description" class="form-label"><h4>Description</h4></label>
          <textarea name="description" class="form-control" id="description" cols="30" rows="5" disabled>
            <?= $data['project_description'] ?>
          </textarea>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <label for="lecturer"><h4>Lecturer</h4></label>
            <input type="text" class="form-control" name="lecturer" id="lecturer" aria-describedby="lecturer" placeholder="" value="<?= $data['project_lecturer_name'] ?>" disabled>
          </div>
          <div class="col-md-6">
            <label for="subject"><h4>Subject</h4></label>
            <input type="text" class="form-control" name="subject" id`="`subject" placeholder="" value="<?= $data['project_subject_name'] ?>" disabled>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
          <label for="start_date"><h4>Start Date</h4></label>
            <input type="text" class="form-control" name="start_date" id`="`start_date" placeholder="" value="<?= $data['project_start_date'] ?>" disabled>            
          </div>
          <div class="col-md-6">
          <label for="end_date"><h4>End Date</h4></label>
            <input type="text" class="form-control" name="end_date" id`="`end_date" placeholder="" value="<?= $data['project_end_date'] ?>" disabled>            
          </div>
        </div>
        
      </div>
      
    </div>

    <div class="row">
      <?php if (isset($data['student'])) : ?>
        <div class="col-md-8">
          <h2>Project Task</h2>
        </div>
      <?php elseif(isset($data['lecturer'])) : ?>
        <div class="col-md-2">
          <h2>Project Task</h2>
        </div>
      <?php endif; ?>
      <?php if (isset($data['manager_privilege'])): ?>
        <div class="col-md-4">
          <button type="button" class="btn btn-join w-100" data-bs-toggle='modal' data-bs-target='#createProjectModal' >Create Task</button>
        </div>
      <?php endif; ?>
      <?php if (isset($data['lecturer'])) : ?>
        <?php $team_group = array_unique($data['team_group']); ?>
        <?php foreach ($team_group as $team) :?>
          <div class="col-md-2">
            <a href="<?= BASEURL ?>/Project/Details?id=<?= $data['project_id'] ?>&group=<?= $team ?>" class="btn btn-join w-100" >Group <?= $team ?></a>
          </div>          
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="table-responsive">
      <table class="table table-hover text-center">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Title</th>
            <th scope="col">Deadline</th>
            <th scope="col">Level</th>
            <th scope="col">Status</th>
            <th scope="col">Responsible</th>
            <?php if (isset($data['student'])) : ?>
              <th scope="col">Action</th>
            <?php endif; ?>
            <th scope="col">Task Details</th>
          </tr>
        </thead>
        <tbody>
          <?php if (isset($data['task'])): ?>
            <?php for ($i=0; $i < count($data['task']); $i++): ?>
              <tr class="
                <?php if ($data['task_approval_status'][$i] == "Accepted" ) {
                  echo "background-task-completed";
                } else {
                  echo "";
                }
                ?>
              ">
                <th scope="row"><?= $i + 1 ?></th>
                <td class=""><?= $data['task_title'][$i] ?></td>
                <td><?= $data['task_end_date'][$i] ?></td>
                <td><?= $data['task_level'][$i] ?></td>
                <td><?= $data['task_available_status'][$i] == false ? $data['task_available_status'][$i] = "Taken" : $data['task_available_status'][$i] = "Available" ?></td>
                <td>
                  <?php if (isset($data['student'])) : ?>
                    <?php if ($data['task_responsible'][$i] != $data['student_id']) : ?>
                      <a href="<?= BASEURL ?>/Profile/Student?npm=<?= $data['task_responsible'][$i] ?>"><?= $data['task_responsible'][$i] ?></a>
                    <?php elseif ($data['task_responsible'][$i] == $data['student_id']) : ?>
                      <?= $data['task_responsible'][$i] ?>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if (isset($data['lecturer'])) : ?>
                    <?= $data['task_responsible'][$i] ?>
                  <?php endif; ?>
                </td>
                <form action='' method='POST'>
                  <?php if (isset($data['student'])) : ?>
                  <input type="hidden" class="form-control" name="student_id" value="<?= $data['student_id']; ?>">
                  <?php endif; ?>
                  <input type="hidden" class="form-control" name="id" value="<?= $data['task_id'][$i]; ?>">
                  <?php if (isset($data['student'])) : ?>
                    <?php if ($data['task_available_status'][$i] == "Available"): ?>
                        <td><button type="submit" name="get_task" class="btn btn-success">Take</button></td>
                    <?php else: ?>
                        <td><button type="submit" name="drop_task" class='btn btn-danger' <?= $data['task_responsible'][$i] != $_SESSION['S_NPM'] || $data['task_approval_status'][$i] == "Waiting For Confirmation" || $data['task_approval_status'][$i] ==  "Accepted" ? "disabled" : "" ?> >Drop</button></td>
                    <?php endif; ?>
                  <?php endif; ?>
                </form>
                <td><button type="button" class="btn btn-join" data-bs-toggle='modal' data-bs-target='#getTaskDetails<?= $data['task_id'][$i] ?>'>Details</button></td>
              </tr>
            <?php endfor; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <?php if (isset($data['task'])) : ?>
      <?php if (count($data['task']) > 0): ?>
        <?php if (isset($_GET['group'])) : ?>
          <div class="d-flex">
            <a href="<?= BASEURL ?>/Project/Task?id=<?= $_GET['id'] ?>&group=<?= $_GET['group'] ?>" class="btn btn-details">
              <span>More Task</span>
              <svg viewBox='0 0 13 10' height='10px' width='15px'>
                <path d='M1,5 L11,5'></path>
                <polyline points='8 1 12 5 8 9'></polyline>
              </svg>
            </a>
          </div>
        <?php endif; ?>
      <?php elseif (count($data['task']) <= 0) : ?>
        <div class="d-flex justify-content-center">
          <h3 class="mt-3">
            No Available Task for a moment, please wait until project leader create a task.
          </h3>
        </div>
      <?php endif; ?>
    <?php endif; ?>
    
    <!-- Modal -->
    <!-- Create Task -->
    <div class="modal fade" id="createProjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
          <form action="" method="POST">
            <div class="modal-header">
              <h5 class="modal-title">New Task</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Task title" autocomplete="off" required>                
              </div>

              <input type="hidden" class="form-control" name="groups" placeholder="Groups" value="<?= $_GET['group']; ?>" autocomplete="off" required>
              <input type="hidden" class="form-control" name="project_id" placeholder="Groups" value="<?= $_GET['id']; ?>" autocomplete="off" required>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date" placeholder="Start Date" autocomplete="off" required> 
                  </div>    
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" class="form-control" name="end_date" placeholder="End Date" autocomplete="off" required>
                  </div>    
                </div>
              </div>

              <div class="mb-3">
                <label for="level" class="form-label">Level</label>
                <select class="form-select" name="level" id="level">
                  <option value="Easy">Easy</option>
                  <option value="Medium">Medium</option>
                  <option value="Hard">Hard</option>
                </select>
              </div>              

              <!-- Later can use php to loop through the team member and display it as selection, default to be null -->
              <div class="mb-3">
                <label for="student_id" class="form-label">Assign to</label>
                <select class="form-select" name="student_id" id="student_id">
                  <?php if (count($data['team_member']) > 0) : ?>
                    <option value="" selected>-- Select an option --</option>
                    <?php for ($i=0; $i < count($data['team_member']); $i++) :?>
                    <option value="<?= $data['team_member_npm'][$i] ?>"><?= $data['team_member'][$i] ?></option>
                    <?php endfor; ?>
                  <?php endif; ?>
                </select>
                <!-- <input type="text" class="form-control" name="student_id" placeholder="Assign to" autocomplete="off"> -->
              </div>              

              <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Task Description"></textarea>
                <!-- <input type="text-area" class="form-control" name="description" placeholder="Task title" autocomplete="off" required>                 -->
              </div>              
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="submit" name="create_task" class="btn btn-join">Create Task</button>
            </div>

          </form>
        </div>
      </div>
    </div>    

    <!-- Get Task Details -->
    <?php if(isset($data['task'])): ?>
      <?php for ($i=0; $i < count($data['task']); $i++): ?>
        <div class="modal fade" id="getTaskDetails<?= $data['task_id'][$i] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
            <div class="modal-content">
              <form action="" method="POST">
                <div class="modal-header">
                  <h5 class="modal-title"><?= $data['task_title'][$i] ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
  
                <div class="modal-body">
                  <input type="hidden" class="form-control" name="id" placeholder="Groups" value="<?= $data['task_id'][$i] ?>" autocomplete="off" required>
                  <!-- <input type="hidden" class="form-control" name="groups" placeholder="Groups" value="<?= $_GET['group']; ?>" autocomplete="off" required>
                  <input type="hidden" class="form-control" name="project_id" placeholder="Groups" value="<?= $_GET['id']; ?>" autocomplete="off" required> -->
                  <div class="row mb-3">
                    <div class="col d-flex flex-column">
                      <h4 class="text-center">Description</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_description'][$i] ?></p>
                      </div>
                    </div>
                  </div>
  
                  <div class="row mb-3">
                    <div class="col d-flex flex-column">
                      <h4>Start Date</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_start_date'][$i] ?></p>
                      </div>                    
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Deadline</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_end_date'][$i] ?></p>
                      </div>
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Taken Date</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_taken_date'][$i] ?></p>
                      </div>                    
                    </div>                  
                  </div>
  
                  <div class="row mb-3">
                    <div class="col d-flex flex-column">
                      <h4>Level</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_level'][$i] ?></p>
                      </div>                    
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Status</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_available_status'][$i] ?></p>
                      </div>                    
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Responsible</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_responsible'][$i] ?></p>
                      </div>
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Progress Status</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_progress_status'][$i] ?></p>
                      </div>                    
                    </div>                  
                  </div>
  
                  <div class="row mb-3">
                    <div class="col d-flex flex-column">
                      <h4>Completed Date</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_completed_date'][$i] ?></p>
                      </div>                    
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Submission Link</h4>
                      <div class="mb-3">
                        <textarea class="form-control" id="description" name="submission_link" rows="3" placeholder="Please provide your task result link" <?= $data['task_submission_link'][$i] != null ? "disabled" : "" ?> ><?= $data['task_submission_link'][$i] ?></textarea>
                      </div>                     
                    </div>
  
                    <div class="col d-flex flex-column">
                      <h4>Approval Status</h4>
                      <div class="task-modal-data">
                        <p class="p-3 pt-4 text-center"><?= $data['task_approval_status'][$i] ?></p>
                      </div>
                    </div>
  
                  </div>
                </div>
  
                <?php if (isset($data['student'])) : ?>
                <div class="modal-footer d-flex justify-content-center">
                  <div class="row w-100">
                    <button type="submit" name="complete_task" class="btn btn-lg btn-join w-100" <?= $data['task_submission_link'][$i] != null || $data['task_responsible'][$i] != $_SESSION['S_NPM'] ? "disabled" : "" ?> >Submit Task</button>
                  </div>
                  <?php if (isset($data['manager_privilege'])) : ?>
                    <input type="hidden" name="student_id" value="<?= $_COOKIE['npm'] ?>">
                    <div class="row d-flex w-100">
                      <div class="col-md-6">
                        <button type="submit" name="approve_task" class="btn btn-success w-100 mt-3" <?= $data['task_submission_link'][$i] == null ? "disabled" : "" ?> >Approve Task</button>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" name="reject_task" class="btn btn-danger w-100 mt-3" <?= $data['task_submission_link'][$i] == null ? "disabled" : "" ?> >Reject Task</button>
                      </div>
                    </div>
                  <?php endif; ?>                
                </div>
                <?php endif; ?>
              </form>
            </div>
          </div>
        </div>
      <?php endfor; ?>
    <?php endif; ?>

    <!-- Get Project Member List -->
    <div class="modal fade" id="getProjectMember" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen-sm-down modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Member List</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body text-center">
            <h2>Leader</h2>
            <h6><?= isset($data['team_manager']) ? $data['team_manager'] : "No Leader Yet" ?></h6>
            <hr>
            <h2>Member</h2>
            <?php if (count($data['team_member']) > 0) : ?>
              <?php for ($i=0; $i < count($data['team_member']); $i++) :?>
                <h6><?= $data['team_member'][$i] ?></h6>
              <?php endfor;  ?>
            <?php elseif (count($data['team_member']) <= 0 ) : ?>
              <h6 class="">No Member Yet</h6>
            <?php endif; ?>
          </div>
          <!-- <div class="modal-footer"> -->
            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->

            <!-- <button type="submit" name="create_task" class="btn btn-join">Create Task</button> -->
          <!-- </div> -->
        </div>
      </div>
    </div>     

  </div>
</body>