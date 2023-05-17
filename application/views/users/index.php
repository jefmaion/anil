<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= env('APP_NAME') ?: '' ?> :: Meus Exames</title>
    <?php $this->load->view('template/parts/header') ?>

</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- navbar -->
            <?php $this->load->view('template/parts/navbar') ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section-">
                    <div class="section-body-">

                        <!-- add content here -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Usuários</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col">


                                        <?php $this->load->view('template/parts/alerts') ?>


                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#modelId">
                                            <i class="fas fa-user-plus    "></i> 
                                            Adicionar Usuário
                                        </button>

                                        <br>
                                        <br>

                                        <!-- Modal -->
                                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <form method="POST" action="<?= base_url('admin/users/store') ?>" class="needs-validation" novalidate="">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Adicionar Usuário</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        
                                                            <div class="form-group">
                                                                <label for="nome">Nome</label>
                                                                <input id="nome" type="text" class="form-control" value="" name="name" tabindex="1" required autofocus>
                                                                <div class="invalid-feedback">
                                                                    Por favor, digite seu nome
                                                                </div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="email">Email</label>
                                                                <input id="email" type="email" class="form-control" value="<?= $this->session->flashdata('auth_email') ?>" name="email" tabindex="1" required autofocus>
                                                                <div class="invalid-feedback">
                                                                    Por favor, digite seu email
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="d-block">
                                                                    <label for="password" class="control-label">Senha</label>
                                                                </div>
                                                                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                                                <div class="invalid-feedback">
                                                                    Por favor, digite sua senha
                                                                </div>
                                                            </div>

                                           


                                                        
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times-circle    "></i> Fechar</button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="fas fa-check    "></i>
                                                            Adicionar
                                                        </button>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($users) : ?>


                                            <div class="table-responsive">
                                                <table class="table table-striped w-100">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Nome</th>
                                                            <th>Email</th>
                                                            <th width="20%">Ações</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($users as $user) : ?>
                                                            <tr>
                                                                <td><?= $user->name ?></td>
                                                                <td><?= $user->email ?></td>
                                                                <td>
                                                                    <a name="" id="" class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal-reset-<?= $user->id ?>"> <i class="fas fa-trash-alt    "></i> Excluir</a>
                                                                    <div class="modal fade" id="modal-reset-<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">

                                                                            <div class="modal-content">
                                                                                <form action="<?= base_url('admin/users/'.$user->id.'/delete') ?>" method="post">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">Excluir usuário</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Deseja Excluir esse usuário
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle    "></i> Fechar</button>
                                                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt    "></i>  Excluir</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        <?php else : ?>

                                            <h4 class="text-center">Nenhum usuário encontrado</h4>

                                        <?php endif; ?>
                                        <hr>
								<a name="" id="" class="btn btn-light" href="<?= base_url('admin') ?>" role="button"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
                                    </div>
                                </div>





                            </div>
                        </div>

                    </div>
                </section>
            </div>
            <?php $this->load->view('template/parts/footer') ?>
        </div>
    </div>
    <?php $this->load->view('template/parts/scripts') ?>
    <script src="<?= base_url('public/template/assets/bundles/datatables/datatables.min.js') ?>"></script>
    <script src="<?= base_url('public/template/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>


</body>

</html>