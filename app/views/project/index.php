<body>
  <div id="data"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
    $(document).ready(() => {
      load_projects();

      function load_projects(page) {
        $.ajax({
          // console.log('hello')
          url: "<?= BASEURL ?>/Project/List",
          method: "POST",
          data: {page: page},
          success: (data) => {
            $('#data').html(data);
          }
        }).then(console.log('ajax'))
      }

      $(document).on('click', '.halaman', function(){
        var page = $(this).attr("id");
        load_projects(page);
      });
    })
  </script>
</body>
</html>