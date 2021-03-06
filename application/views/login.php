<div class="container">

  <style>
    .bg-login-image {
      background: url('<?= base_url() ?>assets/img/log-back.jpg');
      background-position: center;
      background-size: cover;
    }
  </style>
  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <!-- Nested Row within Card Body -->
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                </div>

                <?= $this->session->flashdata('message') ?>
                <form class="user" action="<?= base_url('Started') ?>" method="POST">
                  <div class="form-group">
                    <input type="email" name="email" id="email" class="form-control form-control-user" value="<?= set_value('email') ?>" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    <?= form_error('email', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control form-control-user" placeholder="Password">
                    <?= form_error('password', '<small class="text-danger pl-3">', '</small>') ?>
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small">
                      <input type="checkbox" class="custom-control-input" id="customCheck">
                      <label class="custom-control-label" for="customCheck">Remember Me</label>
                    </div>
                  </div>
                  <button name="submit" type="submit" class="btn btn-primary btn-user btn-block">
                    Login
                  </button>
                  <hr>
                  <a href="index.html" class="btn btn-google btn-user btn-block">
                    <i class="fab fa-google fa-fw"></i> Login with Google
                  </a>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="<?= base_url('Started/forgotpassword') ?>">Forgot Password?</a>
                </div>
                <div class="text-center">
                  <a class="small" href="<?= base_url('Started/registration') ?>">Create an Account!</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>