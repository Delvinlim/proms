<body>
  <div class="container mt-3">
    <h1>Reviews</h1>
    <div class="table-responsive" id="data"></div>    
  </div>

  <!-- Jquery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

  <script>
    $(document).ready(() => {
      load_reviews();

      function load_reviews(page) {
        $.ajax({
          url: "<?= BASEURL ?>/Reviews/List",
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