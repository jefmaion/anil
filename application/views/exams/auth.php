<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Otika - Admin Dashboard Template</title>
  <!-- General CSS Files -->
  <?php $this->load->view('template/parts/header') ?>
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">

</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row align-items-center vh-100">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
            <div class="card">

              <div class="card-body">
                <?php if ($company->photo) : ?>
                  <img alt="image" height="200px" src="<?= base_url('public/img/' . $company->photo) ?>" class="img-fluid mx-auto d-block">
                <?php endif; ?>

                <br>

                <form method="POST" action="<?= base_url('exames/auth') ?>" class="needs-validation" novalidate="">

                  <div class="form-group">
                    <label for="email">Usuário</label>
                    <input id="email" type="folder" class="form-control" value="<?= $this->input->get('usr') ?>" name="folder" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Por favor, digite o usuário
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Senha</label>
                      <div class="float-right">
                        <!-- <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a> -->
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      Por favor, digite a senha
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div> -->

                  <div class="text-center">
                    <?php $this->load->view('template/parts/alerts') ?>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Acessar Exames
                    </button>
                  </div>
                </form>



              </div>
            </div>
            <!-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> -->
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php $this->load->view('template/parts/scripts') ?>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>