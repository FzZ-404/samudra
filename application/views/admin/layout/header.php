<!doctype html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title><?= isset($title)? $title.' — ' : '' ?>Admin • SAMUDRA</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
  <div class="container">
    <a class="navbar-brand" href="<?= site_url('admin'); ?>">Admin SAMUDRA</a>
    <div class="ms-auto">
      <a class="btn btn-sm btn-outline-light" href="<?= site_url(''); ?>">Lihat Situs</a>
      <a class="btn btn-sm btn-warning" href="<?= site_url('auth/logout'); ?>">Logout</a>
    </div>
  </div>
</nav>
<div class="container py-4">
<?php if($this->session->flashdata('success')): ?>
  <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>
