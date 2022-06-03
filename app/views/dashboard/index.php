<body>
  <div class="container">
    <div class="row">
      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Projects</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-kanban"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['project_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>

      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Subjects</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <!-- <i class="bi bi-cart"></i> -->
                <i class="bi bi-journal-text"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['subject_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>

      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Tasks</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <!-- <i class="bi bi-cart"></i> -->
                <i class="bi bi-list-task"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['task_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>

      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Students</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people-fill"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['student_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>

      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Lecturers</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-person-lines-fill"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['lecturer_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>

      <div class="col-xxl-2 col-md-6">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Reviews</span></h5>
    
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-star-fill"></i>
              </div>
              <div class="ps-3">
                <h6><?= $data['student_total'] ?></h6>
              </div>
            </div>
          </div>
    
        </div>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Students</h5>
            <!-- Bar Chart -->
            <canvas id="studentBarChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#studentBarChart'), {
                  type: 'bar',
                  data: {
                    labels: ['Male', 'Female', 'Undefined'],
                    datasets: [{
                      label: 'Students',
                      data: [<?= $data['male_students'] ?>, <?= $data['female_students'] ?>, <?= $data['undefined_students'] ?>],
                      backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                      ],
                      borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 99, 132)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Bar CHart -->

          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tasks</h5>
            <!-- Bar Chart -->
            <canvas id="projectBarChart" style="max-height: 400px;"></canvas>
            <script>
              document.addEventListener("DOMContentLoaded", () => {
                new Chart(document.querySelector('#projectBarChart'), {
                  type: 'bar',
                  data: {
                    labels: ['Easy', 'Medium', 'Hard'],
                    datasets: [{
                      label: 'Tasks',
                      data: [<?= $data['easy_tasks'] ?>, <?= $data['medium_tasks'] ?>, <?= $data['hard_tasks'] ?>],
                      backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 99, 132, 0.2)'
                      ],
                      borderColor: [
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(255, 99, 132)'
                      ],
                      borderWidth: 1
                    }]
                  },
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    }
                  }
                });
              });
            </script>
            <!-- End Bar CHart -->

          </div>
        </div>
      </div>
    </div>
  </div>
</body>