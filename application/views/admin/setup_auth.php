<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= env('APP_NAME') ?: '' ?></title>
    <!-- General CSS Files -->
    <?php $this->load->view('template/parts/header') ?>
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">

</head>

<body class="">
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row align-items-center vh-100">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Configurações Iniciais</h4>
                            </div>
                            <div class="card-body">

                                <?php $this->load->view('template/parts/alerts') ?>

                                <form method="POST" action="<?= base_url('setup/auth') ?>">
                                    <div class="form-group">
                                        <label for="label" class="control-label">Senha</label>
                                        <input type="password" class="form-control" name="setup_pass" value="">
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Acessar
                                        </button>
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