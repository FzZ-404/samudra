<h2 class="mb-4">Signup</h2>
<?php if($this->session->flashdata('success')): ?>
<div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<form method="post" class="col-md-6">
  <div class="mb-3">
    <label class="form-label">Nama</label>
    <input type="text" name="name" class="form-control" required>
    <?= form_error('name','<small class="text-danger">','</small>'); ?>
  </div>
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
  <button class="btn btn-primary">Daftar</button>
</form>
