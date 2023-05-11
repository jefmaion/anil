<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= env('APP_NAME') ?: '' ?> - Meus Exames</title>
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
								<h4>Meus Exames</h4>
							</div>
							<div class="card-body">

								<div class="row">
				
									<div class="col">

									<?php if ($company && isset($company->photo)) : ?>

										
											<img alt="image" height="200px" src="<?= imageProfile(($company) ? $company->photo : null) ?>" class="img-fluid mx-auto d-block">

									<?php endif; ?>


										<?php if ($files) : ?>


											<div class="table-responsive">
												<table class="table table-striped w-100">
													<thead class="thead-light">
														<tr>
															<th>Arquivo</th>
															<th>Data do Upload</th>
															<th>Tamanho</th>
															<th width="20%">Ações</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($files as $file) : ?>
															<tr>
																<td>
																	<i class="fa fa-file" aria-hidden="true"></i>
																	<?= $file->name ?>
																</td>
																<td><?= date('d/m/Y H:i:s', strtotime($file->created_at)) ?></td>
																<td><?= formatBytes($file->size) ?></td>
																<td>

																	<a name="" id="" class="btn btn-primary btn-sm" href="<?= base_url('exames/' . $file->id . '/download') ?>" role="button">
																		<i class="fas fa-download    "></i>
																		Download
																	</a>


																</td>
															</tr>
														<?php endforeach ?>
													</tbody>
												</table>
											</div>

											<hr>

										<?php else : ?>

											<h4 class="text-center">Nenhum arquivo encontrado!</h4>

										<?php endif; ?>
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
	<script>
		$('table').dataTable({
			pageLength: 10,
			lengthMenu: [
				[5, 10, 25, 50, -1],
				[5, 10, 25, 50, 'Tudo'],
			],
			columnDefs: [{
				className: "align-middle",
				targets: "_all"
			}, ],
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
			},
			deferRender: true,
			processing: true,
			responsive: true,
			pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',



		});
	</script>

</body>

</html>