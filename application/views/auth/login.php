<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title><?= env('APP_NAME') ?: '' ?> :: Admin</title>
	<!-- General CSS Files -->
	<?php $this->load->view('template/parts/header') ?>
</head>

<body>
	<div class="loader"></div>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row align-items-center vh-100">
					<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
						<div class="card card-primary">
							<div class="card-header">
								<h4>Login</h4>
							</div>
							<div class="card-body">
								<form method="POST" action="<?= base_url('auth/login') ?>" class="needs-validation" novalidate="">
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

									<div class="text-center">
										<?php $this->load->view('template/parts/alerts') ?>
									</div>

									<div class="form-group">
										<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
											Login
										</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('template/parts/scripts') ?>
</body>
</html>