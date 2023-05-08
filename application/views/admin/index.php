<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>:: Anil ::</title>
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

				<?php $this->load->view('template/parts/alerts') ?>

				<section class="section-">
					<div class="section-body-">

						<div class="row">
							<div class="col-12 col-sm-6 col-md-6 col-lg-3 col-xl-3  d-flex">
								<div class="card card-primary flex-fill">
									<div class="card-header">
										<h4>Logotipo</h4>
									</div>
									<div class="card-body text-center">
										<div class="suser-item">


											<img alt="image" heighdt="200px" src="<?= imageProfile(($company) ? $company->photo : null) ?>" class="mb-4 img-fluid">

											<div class="user-details">

												<div class="user-cta">
													<!-- <button class="btn btn-primary following-btn" data-toggle="modal" data-target="#modal-company">Alterar Imagem</button> -->
													<button class="btn btn-primary following-btn" id="change-photo">Alterar Imagem</button>
												</div>

												<form enctype="multipart/form-data" action="<?= ($company) ? base_url('admin/company/' . $company->id . '/update') : base_url('admin/company/create');  ?>" method="post">
													<input type="file" name="photo" id="photo" class="d-none">
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="col d-flex">

								<div class="row flex-fill">
									<div class="col-6">
										<div class="card card-primary">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h1><?= $count ?></h1>
													</div>
													<div class="col text-right">
														<h1>
															<i class="fa fa-folder" aria-hidden="true"></i>
														</h1>
													</div>
												</div>
												<p>Pasta(s) criada(s)</p>

											</div>
										</div>
									</div>

									<div class="col-6">
										<div class="card card-primary">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h1><?= $files ?></h1>
													</div>
													<div class="col text-right">
														<h1>
															<i class="fa fa-file    "></i>
														</h1>
													</div>
												</div>
												<p>Arquivo(s)</p>
											</div>
										</div>
									</div>

									<div class="col-6 d-flex">
										<div class="card card-primary flex-fill">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h1><?= $downloads ?></h1>
													</div>
													<div class="col text-right">
														<h1>
															<i class="fa fa-download    "></i>
														</h1>
													</div>
												</div>
												<p>Downloads</p>
											</div>
										</div>
									</div>

									<div class="col-6 d-flex">
										<div class="card card-primary flex-fill">
											<div class="card-body">
												<div class="row">
													<div class="col">
														<h4><?= formatBytes($size) ?></h4>
													</div>
													<div class="col text-right">
														<h1>
															<i class="fa fa-chart-pie    "></i>
														</h1>
													</div>
												</div>
												<p>Espaço Utilizado</p>

											</div>
										</div>
									</div>
								</div>

							</div>
						</div>




						<!-- add content here -->
						<div class="row">

							<div class="col-12">
								<div class="card card-primary">
									<div class="card-header">
										<h4>Gerenciamento de Pastas</h4>
									</div>
									<div class="card-body">




										<!-- Button trigger modal -->
										<button type="button" class="btn btn-success btn-lg mb-4" data-toggle="modal" data-target="#modelId">
											<i class="fas fa-folder-plus    "></i>
											Gerar pastas
										</button>



										<a name="" id="" class="btn btn-primary btn-lg mb-4" href="<?= base_url('admin/folder/export') ?>" role="button">
											<i class="fas fa-file-export    "></i>
											Exportar em Excel
										</a>

										<button type="button" class="btn btn-warning pull-right btn-lg mb-4" data-toggle="modal" data-target="#modal-reset">
											<i class="fas fa-sync    "></i>
											Redefinir Tudo
										</button>


										<div class="table-responsive">
											<table class="table table-ssm table-striped w-100">
												<thead class="thead-light">
													<tr>
														<th>Usuário/Diretorio</th>
														<th>Senha</th>
														<th>Tamanho</th>
														<th>Arquivos</th>
														<th>URL</th>
														<th width="20%">Ações</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>

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
	<script src="<?= base_url('public/js/admin.js?t=' . date('s')) ?>"></script>
	<script>
		$('#change-photo').click(function(e) {
			e.preventDefault();
			$('#photo').click();
		});

		$('#photo').change(function(e) {
			e.preventDefault();
			$(this).closest('form').submit();
		});
	</script>


	<!-- Modal -->
	<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">

			<div class="modal-content">
				<form action="<?= base_url('admin/folder/create') ?>" method="post">
					<div class="modal-header">
						<h5 class="modal-title">Gerar Pastas</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<label for="">Número de pastas</label>
						<input type="text" class="form-control" name="num_folders" id="" aria-describedby="helpId" placeholder="">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fa fa-times" aria-hidden="true"></i> Fechar</button>
						<button type="submit" class="btn btn-primary"> <i class="fas fa-check    "></i> Gerar</button>
					</div>
				</form>
			</div>

		</div>
	</div>




	<!-- Modal -->
	<div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Redefinir</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Deseja redefinir tudo? Todas as pastas e arquivos serão removidos!
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i>
						Fechar</button>
					<a name="" id="" class="btn btn-primary" href="<?= base_url('admin/folder/reset') ?>" role="button">
						<i class="fas fa-sync    "></i>

						Redefinir Tudo
					</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="modal-company" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<form action="<?= ($company) ? base_url('admin/company/' . $company->id . '/update') : base_url('admin/company/create');  ?>" method="post">
					<div class="modal-header">
						<h5 class="modal-title">Dados do Cliente</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<label for="">Nome da Clínica</label>
						<input type="text" class="form-control" name="name" value="<?= ($company) ? $company->name : '' ?>" id="" aria-describedby="helpId" placeholder="">
					</div>
					<div class="modal-footer">

						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							<i class="fa fa-times" aria-hidden="true"></i>
							Fechar
						</button>

						<button type="submit" class="btn btn-primary" href="#" role="button">
							<i class="fas fa-sync    "></i>
							Salvar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>