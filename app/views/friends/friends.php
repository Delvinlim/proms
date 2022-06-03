    <!-- <div class="table-responsive mt-3"> -->
    <table class="table text-center mt-3">
      <tr>
        <th>No</th>
        <th>Name</th>
        <th>NPM</th>
        <th>Details</th>
        <th>Delete</th>
      </tr>
      <?php for ($i=0; $i < count($data['requester_name']); $i++) : ?>
        <tr>
            <th scope="row"><?= $data['friends_no']++; ?></th>
            <td><?= $data['requester_name'][$i] ?></td>
            <td><?= $data['requester_npm'][$i] ?></td>
            <td><a href="<?= BASEURL ?>/Profile/Student?npm=<?= $data['requester_npm'][$i] ?>" class="btn btn-success w-100">Details</a></td>
            <td><a href="<?= BASEURL ?>/Friends/Delete?npm=<?= $data['requester_npm'][$i] ?>" class="btn btn-danger w-100">Delete</a></td>
        </tr>
      <?php endfor; ?>
      <?php if (count((array)$data['requester_name']) <= 0) :?>
        <tr>
          <td colspan="4"><h3 class="mt-3">You don't have any friends</h3></td>
        </tr>          
      <?php endif; ?>
    </table>

    <nav class="mb-5">
      <ul class="pagination justify-content-end">
        <?php
        $page = (int)$data['page'];
        $total_page = ceil((int)$data['friends_total'] / (int)$data['friends_limit']);
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
    <!-- </div> -->