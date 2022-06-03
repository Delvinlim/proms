<body>
  <div class="container mt-3">
    <div class="row mb-3">
      <div class="col">
        <h1><?= $data['name']?> Task's</h1>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-lg btn-join w-100 filter_all" >All Task</button>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-lg btn-join w-100 filter_progress" >Progress Task</button>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-lg btn-join w-100 filter_complete" >Completed Task</button>
      </div>
    </div>
    <div class="table-responsive" id="data"></div>    
  </div>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(() => {
      load_data();

      function load_data(page) {
        $.ajax({
          url: "<?= BASEURL ?>/Task/List",
          method: "POST",
          data: {page: page},
          success: (data) => {
            $('#data').html(data);
          }
        })
      } 
      
      function completed_data(page) {
        $.ajax({
          url: "<?= BASEURL ?>/Task/Completed",
          method: "POST",
          data: {page: page},
          success: (data) => {
            $('#data').html(data);
          }
        })
      }

      function progress_data(page) {
        $.ajax({
          url: "<?= BASEURL ?>/Task/Progress",
          method: "POST",
          data: {page: page},
          success: (data) => {
            $('#data').html(data);
          }
        })
      }      

      $('.filter_complete').on('click', () => {
        completed_data();
      })

      $('.filter_progress').on('click', () => {
        progress_data();
      })

      $('.filter_all').on('click', () => {
        load_data();
      }) 
      
      $(document).on('click', '.halaman', function(){
        var page = $(this).attr("id");
        load_data(page);
      });
      $(document).on('click', '.halaman_completed', function(){
        var page = $(this).attr("id");
        completed_data(page);
      });
      $(document).on('click', '.halaman_progress', function(){
        var page = $(this).attr("id");
        progress_data(page);
      });
    })

  </script>
</body>