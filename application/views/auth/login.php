<h2 class="mb-4">Login</h2>
<?php if($this->session->flashdata('error')): ?>
<div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<form method="post" class="col-md-5">
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email" class="form-control" required>
    <?= form_error('email','<small class="text-danger">','</small>'); ?>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control" required>
    <?= form_error('password','<small class="text-danger">','</small>'); ?>
  </div>
  <button class="btn btn-primary">Masuk</button>
</form>
