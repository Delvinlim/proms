<body>
  <div class="lecturer">
    <div class="d-flex">
      <a href="<?= BASEURL ?>/Auth">
        <i class="fa fa-long-arrow-left mt-3 pe-2" aria-hidden="true"></i>
      </a>
      <p>Admin's</p>
    </div>
    <div class="container">
      <form action="" method="post">
        <div class="form-content">
          <!-- Sign Up Form -->
          <div class="signup-form">
            <div class="title">Sign Up</div>
            <div class="input-boxes">
              <!-- Name -->
              <div class="input-box">
                <i class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="Enter your name" required>
              </div>
              <!-- Email -->
              <div class="input-box">
                <i class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Enter your email" required>
              </div>
              <!-- Password -->
              <div class="input-box">
                <i class="fa-solid fa-key"></i>
                <input type="password" name="password" placeholder="Enter your password" required>
              </div>
              <!-- Confirm Password -->
              <!-- <div class="input-box">
                <i class="fa-solid fa-key"></i>
                <input type="password" placeholder="Re-enter your password" required>
              </div> -->
              <!-- Submit Button -->
              <div class="button-input-box">
                <!-- <button type="submit" >Register</button> -->
                <input type="submit" name="submit" value="Register">
              </div>
              <div class="text">Already have an account? <a href="<?= BASEURL ?>/AdminAuth/Login">Log in Now</a></div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>