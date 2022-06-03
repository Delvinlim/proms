<body>
  <div class="container mt-3">
    <div class="row">
      <div class="col-md-10">
        <h1>Subjects</h1>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-join" data-bs-toggle="modal" data-bs-target="#createSubject">Create Subject</button>
      </div>
    </div>
    <div class="table-responsive mt-3" id="data"></div>    

    <div class="modal fade" id="createSubject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
          <form action="" method="POST">
            <div class="modal-header">
              <h5 class="modal-title">New Subject</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="name" class="form-label">Subject Name</label>
                <input type="text" class="form-control" name="name" placeholder="Subject Name" autocomplete="off" required>                
              </div>
  
              <div class="mb-3">
                <label for="lecturer_id" class="form-label">Lecturer</label>
                <select class="form-select" name="lecturer_id" id="lecturer_id">
                  <?php for ($i=0; $i < count($data['lecturer_name']); $i++) :?>
                  <option value="<?= $data['lecturer_nidn'][$i] ?>"><?= $data['lecturer_name'][$i] ?></option>
                  <?php endfor; ?>
                </select>
              </div>              
            </div>
            <div class="modal-footer d-flex justify-content-center">
              <button type="submit" name="create_subject" class="btn btn-join">Create Subject</button>
            </div>
  
          </form>
        </div>
      </div>
    </div> 
  </div>


  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(() => {
      load_subject();

      function load_subject(page) {
        $.ajax({
          url: "<?= BASEURL ?>/Subject/List",
          method: "POST",
          data : {page: page},
          success: (data) => {
            $('#data').html(data)
          }
        })
      }

      $(document).on('click', '.halaman', function(){
        var page = $(this).attr("id");
        load_data(page);
      });
    })
  </script>
</body>