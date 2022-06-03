<body>
  <table class="table table-hover text-center">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Name</th>
        <th scope="col">Lecturer</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($data['subjects']) : ?>
        <?php for ($i = 0; $i < count($data['subjects']); $i++) : ?>
          <tr>
            <th scope="row"><?= $data['subjects_no']++ ?></th>
            <td class=""><?= $data['subject_name'][$i] ?></td>
            <td><?= $data['subject_lecturer'][$i] ?></td>
          </tr>
        <?php endfor; ?>
      <?php endif; ?>
    </tbody>
  </table>

  <nav class="mb-5">
    <ul class="pagination justify-content-end">
      <?php
      $page = (int)$data['page'];
      $total_page = ceil((int)$data['subjects_total'] / (int)$data['subjects_limit']);
      $total_number = 1; //jumlah halaman ke kanan dan kiri dari halaman yang aktif
      $start_number = ($page > $total_number) ? $page - $total_number : 1;
      $end_number = ($page < ($total_page - $total_number)) ? $page + $total_number : $total_page;

      if ($page == 1) {
        echo '<li class="page-item disabled"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      } else {
        $link_prev = ($page > 1) ? $page - 1 : 1;
        echo '<li class="page-item halaman_progress" id="1"><a class="page-link" href="#">First</a></li>';
        echo '<li class="page-item halaman_progress" id="' . $link_prev . '"><a class="page-link" href="#"><span aria-hidden="true">&laquo;</span></a></li>';
      }

      for ($i = $start_number; $i <= $end_number; $i++) {
        $link_active = ($page == $i) ? ' active' : '';
        echo '<li class="page-item halaman_progress ' . $link_active . '" id="' . $i . '"><a class="page-link" href="#">' . $i . '</a></li>';
      }

      if ($page == $total_page) {
        echo '<li class="page-item disabled"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item disabled"><a class="page-link" href="#">Last</a></li>';
      } else {
        $link_next = ($page < $total_page) ? $page + 1 : $total_page;
        echo '<li class="page-item halaman_progress" id="' . $link_next . '"><a class="page-link" href="#"><span aria-hidden="true">&raquo;</span></a></li>';
        echo '<li class="page-item halaman_progress" id="' . $total_page . '"><a class="page-link" href="#">Last</a></li>';
      }
      ?>
    </ul>
  </nav>
</body>