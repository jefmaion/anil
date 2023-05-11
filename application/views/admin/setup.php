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
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Configurações Iniciais</h4>
                                <span class="pull-right">
                                    (<a href="<?= base_url('setup/logout') ?>" >Encerrar Sessão</a>)
                                </span>
                            </div>
                            <div class="card-body">

                                <?php $this->load->view('template/parts/alerts') ?>

                                <form method="POST" action="<?= base_url('setup/store') ?>">
                                    <p><b>Ambiente</b></p>
                                    <div class="form-group">
                                        <select class="form-control" name="env_environment" id="">
                                            <option value="development" <?= ($this->config->item('env_environment') === 'development') ? 'selected' : '' ?>>Desenvolvimento</option>
                                            <option value="production" <?= ($this->config->item('env_environment') === 'production') ? 'selected' : '' ?>>Produção</option>
                                        </select>
                                    </div>

                                    <p><b>Nome da Aplicação/Cliente</b></p>

                                    <div class="row">
                                        <div class="form-group col-12">
                                            <input type="text" class="form-control" name="env_app_name" value="<?= env('APP_NAME') ?: '' ?>">
                                        </div>
                                    </div>

                                    
                                    <p><b>Banco de dados</b></p>

                                    <div class="row">
                                        <div class="form-group col-6">
                                            <label for="label" class="control-label">Servidor</label>
                                            <input type="text" class="form-control" name="env_db_server" value="<?= $this->config->item('env_db_server') ?>">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="label" class="control-label">Nome do Banco de dados</label>
                                            <input type="text" class="form-control" name="env_db_name" value="<?= $this->config->item('env_db_name') ?>">
                                        </div>


                                        <div class="form-group col-6">
                                            <label for="label" class="control-label">Usuário</label>
                                            <input type="text" class="form-control" name="env_db_user" value="<?= $this->config->item('env_db_user') ?>">
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="label" class="control-label">Senha</label>
                                            <input type="password" class="form-control" name="env_db_pass" value="<?= $this->config->item('env_db_pass') ?>">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="mt-2 ml-0">
                                            <input type="checkbox" name="run_migration"  class="custom-switch-input">
                                            <span class="custom-switch-indicator"></span>
                                            <span class="custom-switch-description">Recriar as tabelas do banco de dados (Os dados serão apagados!)</span>
                                        </label>
                                    </div>


                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Salvar Alterações
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