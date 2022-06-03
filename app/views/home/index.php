<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="container"> 
    <!-- <div class="row">
      <div class="col-lg-6">
        <?= Flasher::flash() ?>
      </div>
    </div> -->
    
    <div class="row">
      <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-2 d-flex flex-column justify-content-center" data-aos="fade-up">
        <div>
          <h1>Feeling hard to organize your group projects?</h1>
          <h2>No worries, we are here to help you maintain your group project task</h2>
          <a href="#about" class="btn-get-started scrollto">Get Started</a>
        </div>
      </div>
      <div class="col-lg-6 order-1 order-lg-1 hero-img" data-aos="fade-left">
        <img src="assets/img/hero-img.svg" class="img-fluid" alt="Team">
      </div>
    </div>
  </div>
</section>
<!-- End Hero -->

<!-- Main Section -->
<main id="main">

  <!-- About Section -->
  <section id="about" class="about">
    <div class="container">
      <!-- Section Title -->
      <div class="section-title" data-aos="fade-up">
        <h2>About Us</h2>
        <p>We are team consist of 5 people which already an team from last semester, by that time we often encounter difficulty when its coming to manage our project, so we decide to build a project management system in purpose to manage our task easier, and to track down our task.</p>
      </div>

      <!-- Content -->
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center about-img">
          <img src="assets/img/about-img.svg" class="img-fluid" alt="About Us" data-aos="fade-right">
        </div>

        <div class="col-lg-6" data-aos="fade-up">
          <h2>Team<i class='bx bxs-hot' style="color: red;"></i></h2>
          <table width="100%" class="mt-4">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">NPM</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Augustino Sanduo</td>
                <td>2131040</td>
              </tr>
              <tr>
                <td>Delvin Lim</td>
                <td>2131035</td>
              </tr>
              <tr>
                <td>Jason Andrian</td>
                <td>2131050</td>
              </tr>
              <tr>
                <td>Jeffrey Andrian</td>
                <td>2131048</td>
              </tr>
              <tr>
                <td>Vincentius Junior Samudra</td>
                <td>2131042</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>  
  </section>
  <!-- End About Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container">
      <!-- Section Title -->
      <div class="section-title" data-aos="fade-up">
        <h2>Services</h2>
        <p>Project Management System provide services to an university so that they can consider to encourage their student to use this system to manage all their project. UTS project? UAS project? everyweek Assignment project? no problem all can be handle by the system.</p>
      </div>
      
      <!-- Content -->
      <div class="row">
        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in">
          <div class="icon-box icon-box-color">
            <div class="icon"><i class="bx bx-file"></i></div>
            <h4 class="title"><a href="">Project Management</a></h4>
            <p class="description">With this system you don't need to afraid of managing project task with your teammates</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="100">
          <div class="icon-box icon-box-color">
            <div class="icon"><i class="bx bx-desktop"></i></div>
            <h4 class="title"><a href="">Real Time Monitoring</a></h4>
            <p class="description">System support real time monitoring by the lecturer to watch student project progress</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="200">
          <div class="icon-box icon-box-color">
            <div class="icon"><i class="bx bx-tachometer"></i></div>
            <h4 class="title"><a href="">Fast Perfomance</a></h4>
            <p class="description">We do believe site performance is also very important, so don't worry about the performance!</p>
          </div>
        </div>

        <div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0" data-aos="zoom-in" data-aos-delay="300">
          <div class="icon-box icon-box-color">
            <div class="icon"><i class="bx bx-world"></i></div>
            <h4 class="title"><a href="">Easy Access</a></h4>
            <p class="description">We provide system with easy access, Access the system anywhere! anytime! no limitation! </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End Services Section -->

  <!-- ======= reviews Section ======= -->
  <section id="reviews" class="reviews">
    <div class="container">
      <!-- Section Title -->
      <div class="section-title" data-aos="fade-up">
        <h2>Student's Reviews</h2>
        <p>Those review are based on the data that we collect from student that already using our system to help them manage their project, and surely its pure honest review by them.</p>
      </div>
      <!-- Content -->
      <div class="reviews-slider swiper-container" data-aos="fade-up" data-aos-delay="100">
        <div class="swiper-wrapper">
          <?php for ($i=0; $i < count($data['reviewer_name']); $i++) :?>
              <div class="swiper-slide">
                <div class="reviews-item">
                  <p><?= $data['reviewer_comment'][$i] ?></p>
                  <img src="assets/img/reviews/<?= $data['reviewer_image'][$i] ?>" class="reviews-img" alt="Student">
                  <h3><?= $data['reviewer_name'][$i] ?></h3>
                  <h4><?= $data['reviewer_job'][$i] ?></h4>
                </div>
              </div>
          <?php endfor; ?>
        </div>
        <!-- Pagination Bullet -->
        <div class="swiper-pagination"></div>
      </div>
      <!-- Reviews Button -->
      <div class="d-gap mt-3 mx-auto w-75" data-aos="fade-up">
        <button class="btn btn-reviews btn-lg mt-3 w-100" type="button"data-bs-toggle="modal" data-bs-target="#reviewsModal">Add Reviews</button>
      </div>
      <!-- Bootstrap Modal -->
      <div class="modal fade" id="reviewsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Reviews</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" enctype="multipart/form-data" method="post">
              <div class="modal-body">
                <!-- <input type="hidden" name="id" id="id"> -->
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input type="text" class="form-control" name="name" id="name" required>
                </div>
                <div class="mb-3">
                  <label for="name" class="form-label">Job</label>
                  <input type="text" class="form-control" name="job" id="job" required>
                </div>
                <div class="mb-3">
                  <label for="comment" class="form-label">Comment</label>
                  <textarea class="form-control" name="comment" id="comment" rows="3" required></textarea>
                  <!-- {/* <input type="text" class="form-control" name="comment" id="comment" /> */} -->
                </div>
                <label for="image" class='mb-2'>Profile Image</label>
                <div class="form-group">
                  <input type="file" class="form-control-file" name="image" id="image" required>
                </div>                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-reviews">Save changes</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End reviews Section -->

</main>
<!-- End Main -->