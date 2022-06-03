<body>
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Title</th>
        <th scope="col">Deadline</th>
        <th scope="col">Level</th>
        <!-- <th scope="col">Status</th> -->
        <!-- <th scope="col">Responsible</th> -->
        <!-- <th scope="col">Action</th> -->
        <th scope="col">Task Details</th>
        <!-- <th scope="col">Approval Status</th> -->
      </tr>
    </thead>
    <tbody>
      <?php if ($data['tasks']) : ?>
        <?php for ($i = 0; $i < count($data['tasks']); $i++) : ?>
          <tr class="
            <?php if ($data['task_approval_status'][$i] == "Accepted") {
              echo "background-task-completed";
            } else {
              echo "";
            }
            ?>
          ">
            <th scope="row"><?= $data['task_no']++ ?></th>
            <td class=""><?= $data['task_title'][$i] ?></td>
            <td><?= $data['task_end_date'][$i] ?></td>
            <td><?= $data['task_level'][$i] ?></td>
            <!-- <td><?= $data['task_available_status'][$i] == false ? $data['task_available_status'][$i] = "Taken" : $data['task_available_status'][$i] = "Available" ?></td> -->
            <!-- <td><?= $data['task_responsible'][$i] ?></td> -->
            <!-- <?= $data['task_available_status'][$i] == "Available" ? "<td><button class='btn btn-success'>Take</button></td>" : "<td><button class='btn btn-danger'>Drop</button></td>" ?> -->

            <td><button type="button" class="btn btn-join" data-bs-toggle='modal' data-bs-target='#getTaskDetails<?= $data['task_id'][$i] ?>'>Details</button></td>
          </tr>
        <?php endfor; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <?php for ($i = 0; $i < count($data['tasks']); $i++) : ?>
    <div class="modal fade" id="getTaskDetails<?= $data['task_id'][$i] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
          <form action="" method="POST">
            <div class="modal-header">
              <h5 class="modal-title"><?= $data['task_title'][$i] ?></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <!-- <input type="hidden" class="form-control" name="id" placeholder="Groups" value="<?= $data['task_id'][$i] ?>" autocomplete="off" required>               -->
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
                    <textarea class="form-control" id="description" name="submission_link" rows="3" placeholder="Please provide your task result link" <?= $data['task_submission_link'][$i] != null ? "disabled" : "" ?>><?= $data['task_submission_link'][$i] ?></textarea>
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

            <div class="modal-footer d-flex justify-content-center">
              <div class="row w-100">
                <button type="submit" name="complete_task" class="btn btn-lg btn-join w-100" <?= $data['task_submission_link'][$i] != null ? "disabled" : "" ?>>Submit Task</button>
              </div>
              <?php if (isset($data['manager_privilege'])) : ?>
                <!-- <div class="row mt-3"> -->
                <div class="row d-flex w-100">
                  <div class="col-md-6">
                    <button type="submit" name="approve_task" class="btn btn-success w-100 mt-3" <?= $data['task_submission_link'][$i] == null ? "disabled" : "" ?>>Approve Task</button>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" name="reject_task" class="btn btn-danger w-100 mt-3" <?= $data['task_submission_link'][$i] == null ? "disabled" : "" ?>>Reject Task</button>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </div>
    </div>
  <?php endfor; ?>

  <nav class="mb-5">
    <ul class="pagination justify-content-end">
      <?php
      $page = (int)$data['page'];
      $total_page = ceil((int)$data['task_total'] / (int)$data['task_limit']);
      $total_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
      $start_number = ($page > $total_number) ? $page - $total_number : 1;
      $end_number = ($page < ($total_page - $total_number)) ? $page + $total_number : $total_page;

      if ($page == 1) {
        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      } else {
        $link_prev = ($page > 1) ? $page - 1 : 1;
        echo '<li class="page-item halaman" id="1"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item halaman" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      }

      for ($i = $start_number; $i <= $end_number; $i++) {
        $link_active = ($page == $i) ? ' active' : '';
        echo '<li class="page-item halaman ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
      }

      if ($page == $total_page) {
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
      } else {
        $link_next = ($page < $total_page) ? $page + 1 : $total_page;
        echo '<li class="page-item halaman" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item halaman" id="' . $total_page . '"><a class="page-link" href="#">Last</a></li>';
      }
      ?>
    </ul>
  </nav>
</body>