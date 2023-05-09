<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= $this->config->item('env_app_name') ?: '' ?> :: Arquivos</title>
	<?php $this->load->view('template/parts/header') ?>
	<style>

.modal {
  z-index: 10000000000 !important;
}
	</style>
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
								<h4><?= $folder->name ?> - Arquivos</h4>
							</div>
							<div class="card-body">
							<?php //echo $error;?>
							
							

								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-lg mb-4" id="btn-upload">
									<i class="fas fa-file-upload    "></i>
									Adicionar Arquivos
								</button>

								<form id="form-upload" action="<?= base_url('admin/folder/'.$folder->id.'/upload') ?>" method="post" enctype='multipart/form-data'>
									<input type="file" name="files[]" id="files" class="d-none" multiple />
								</form>

								

								<div class="table-responsive">
									<table class="table table-striped w-100">
										<thead class="thead-light">
											<tr>
												<th>Arquivo</th>
												<th>Data do Upload</th>
												<th>Tamanho</th>
												<th>Downloads</th>
												<th width="20%">Ações</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($files as $file) : ?>
												<tr>
													<td>
														<i class="fa fa-file" aria-hidden="true"></i> 
														<?= $file->name ?>
													</td>
													<td><?= date('d/m/Y H:i:s', strtotime($file->created_at)) ?></td>
													<td><?= formatBytes($file->size) ?></td>
													<td><?= $file->num_downloads ?></td>
													<td>

														<a name="" id="" class="btn btn-primary btn-sm" href="<?= base_url('admin/file/'.$file->id.'/download') ?>" role="button">
															<i class="fas fa-download    "></i>
															Download
														</a>


														<?= deleteButton($file->id, base_url('admin/file/'.$file->id.'/delete')) ?>

														
													</td>
												</tr>
											<?php endforeach ?>
										</tbody>
									</table>
								</div>

								<hr>


								<a name="" id="" class="btn btn-light" href="<?= base_url('admin') ?>" role="button"> <i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
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

		$('#btn-upload').click(function (e) { 
			e.preventDefault();
			$('#files').trigger('click');
		});

		$('#files').change(function (e) { 
			$('#form-upload').submit();
		});

		$('table').dataTable({
			pageLength: 10,
			lengthMenu: [
				[5,10, 25, 50, -1],
				[5,10, 25, 50, 'Tudo'],
			],
			columnDefs: [
				{ className: "align-middle", targets: "_all" },
			],
			language: {
				url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
			},
			deferRender:true,
			processing:true,
			responsive:true,
			pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',

		
			
		});

	</script>

</body>

</html>