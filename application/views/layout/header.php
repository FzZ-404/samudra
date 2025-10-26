<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title)? $title.' — ' : '' ?>SAMUDRA</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root{ --nav-bg:#0b2038; --nav-accent:#1e5aa8; }
    body{ background:#071a2c; color:#dbe7ff; }
    .navbar-samudra{ background:var(--nav-bg); border-bottom:3px solid var(--nav-accent); }
    .navbar .nav-link, .navbar .navbar-brand{ color:#dbe7ff !important; }
    .dropdown-menu{ background:#0f2642; }
    .dropdown-item{ color:#dbe7ff; }
    .dropdown-item:hover{ background:#153255; }
  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-samudra sticky-top">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="<?= base_url(); ?>">
      <img src="<?= base_url('assets/logo-samudra.svg'); ?>" alt="SAMUDRA" height="26" class="me-2">
      SAMUDRA
    </a>

    <button class="navbar-toggler text-light" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link <?= isset($active)&&$active=='home'?'active':'' ?>" href="<?= base_url(); ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link <?= isset($active)&&$active=='dashboard'?'active':'' ?>" href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link <?= isset($active)&&$active=='edukasi'?'active':'' ?>" href="<?= site_url('edukasi'); ?>">Edukasi</a></li>
        <li class="nav-item"><a class="nav-link <?= isset($active)&&$active=='event'?'active':'' ?>" href="<?= site_url('event'); ?>">Event</a></li>
        <li class="nav-item"><a class="nav-link <?= isset($active)&&$active=='quiz'?'active':'' ?>" href="<?= site_url('quiz'); ?>">Quiz</a></li>
      </ul>

      <ul class="navbar-nav ms-auto align-items-center gap-2">
        <li class="nav-item"><a class="nav-link" href="<?= site_url('search'); ?>"><i class="bi bi-search"></i></a></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="langDD" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-globe"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDD">
            <li><a class="dropdown-item" href="#">Indonesia</a></li>
            <li><a class="dropdown-item" href="#">English</a></li>
          </ul>
        </li>

        <?php if($this->session->userdata('user')): ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
              <li><a class="dropdown-item" href="<?= site_url('auth/logout'); ?>">Logout</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i class="bi bi-list"></i></a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="<?= site_url('auth/login'); ?>">Login</a></li>
              <li><a class="dropdown-item" href="<?= site_url('auth/signup'); ?>">Signup</a></li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
