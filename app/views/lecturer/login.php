<body>
  <div class="role">
    <div class="d-flex">
      <a href="<?= BASEURL ?>/Auth">
        <i class="fa fa-long-arrow-left mt-3 pe-2" aria-hidden="true"></i>
      </a>
      <p>Lecturer's</p>
    </div>
    <div class="container">
      <form action="" method="POST">
        <div class="form-content">
          <!-- Login Form -->
          <div class="login-form">
            <div class="title">Login</div>
            <!-- Email -->
            <div class="input-boxes">
              <div class="input-box">
                <i class="fa-solid fa-id-card"></i>
                <input type="text" name="nidn" placeholder="Enter your NIDN" required>
              </div>
              <!-- Password -->
              <div class="input-box">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
              <div class="text"><a href="#">Forget Password?</a></div>
              <!-- Submit Button -->
              <div class="button-input-box">
                <input type="submit" name="submit" value="Sign In">
              </div>
              <div class="text">Don't have an account? <a href="<?= BASEURL ?>/lecturerAuth/Register">Sign Up Now </a></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>