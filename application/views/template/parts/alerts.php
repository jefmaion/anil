
<?php if($message = $this->session->flashdata('success')) : ?>
<div class="alert-dismiss alert alert-success" role="alert"> <i class="fas fa-check-circle    "></i> <?= $message ?></div>
<?php endif; ?>

<?php if($message = $this->session->flashdata('warning')) : ?>
<div class="alert-dismiss alert alert-warning" role="alert"> <i class="fa fa-exclamation-circle" aria-hidden="true"></i> <?= $message ?></div>
<?php endif; ?>

<?php if($message = $this->session->flashdata('error')) : ?>
<div class="alert-dismiss alert alert-danger" role="alert"> <i class="fa fa-times-circle" aria-hidden="true"></i> <?= $message ?></div>
<?php endif; ?>

