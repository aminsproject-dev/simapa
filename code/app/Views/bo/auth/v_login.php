<?= session()->getFlashdata('alert'); ?>
<!-- Page content -->
<div class="page-content mt-5">
  <!-- Main content -->
  <div class="content-wrapper">
    <!-- Inner content -->
    <div class="content-inner">
      <!-- Content area -->
      <div class="content d-flex justify-content-center align-items-center">
        <!-- Login form -->
        <form class="login-form" id="login-form" action="<?= url_to('auth/proseslogin'); ?>" method="post">
          <?= csrf_field(); ?>
          <?php $validation = \Config\Services::validation(); ?>
          <div class="card mb-0">
            <div class="card-body">
              <div class="text-center mb-3">
                <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                  <img src="<?= base_url('showLogoApp'); ?>" class="h-48px" alt="" />
                </div>
                <h5 class="mb-0"><?= $title; ?></h5>
                <span class="d-block text-muted">Masukkan Username dan Password</span>
              </div>

              <?php if (session()->getFlashdata('error') !== null) {
              ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error'); ?></div>
              <?php } ?>


              <div class="mb-3">
                <label class="form-label">Username</label>
                <div class="form-control-feedback form-control-feedback-start">
                  <input type="text" class="form-control" placeholder="Masukkan Username" name="username" value="<?= old('username'); ?>" required />
                  <div class="form-control-feedback-icon">
                    <i class="ph-user-circle text-muted"></i>
                  </div>
                </div>
                <?= (session()->has('errors.username')) ? '<label class="text-danger">' . session()->get('errors.username') . '</label>' : ''; ?>
              </div>

              <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="form-control-feedback form-control-feedback-start">
                  <input type="password" id="password" class="form-control" placeholder="•••••••••••" name="password" required />
                  <div class="form-control-feedback-icon">
                    <i class="ph-lock text-muted"></i>
                  </div>
                </div>
                <?= (session()->has('errors.username')) ? '<label class="text-danger">' . session()->get('errors.password') . '</label>' : ''; ?>
              </div>

              <div class="d-flex align-items-center mb-3">
                <label class="form-check form-check-inline">
                  <input type="checkbox" class="form-check-input" onclick="showpassword()">
                  <span class="form-check-label">Show Password</span>
                </label>

              </div>

              <?php if ($validation->getError('g-recaptcha-response')) { ?>
                <div class='text-danger mt-2'>
                  * <?= $validation->getError('g-recaptcha-response'); ?>
                </div>
              <?php } ?>

              <div class="mb-3">
                <div class="g-recaptcha" data-size="normal" data-sitekey="<?= getenv('GOOGLE_RECAPTCHA_SITEKEY') ?>" data-action="LOGIN"></div>
              </div>

              <div class="mb-3">
                <button type="submit" class="btn btn-primary w-100">Masuk</button>
              </div>

            </div>
          </div>
        </form>
        <!-- /login form -->
      </div>
      <!-- /content area -->


      <script>
        function showpassword() {
          var x = document.getElementById("password");
          if (x.type === "password") {
            x.type = "text";
          } else {
            x.type = "password";
          }
        }
      </script>