<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($title)? $title.' | Samudra Admin' : 'Samudra Admin'; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --sidebar-width: 250px;
      --sidebar-bg: #0a192f;
      --sidebar-color: #cbd5e1;
      --accent: #00b4d8;
    }
    body {
      min-height: 100vh;
      display: flex;
      background-color: #f8fafc;
      font-family: "Inter", sans-serif;
    }
    .sidebar {
      width: var(--sidebar-width);
      background: var(--sidebar-bg);
      color: var(--sidebar-color);
      display: flex;
      flex-direction: column;
      position: fixed;
      top: 0; bottom: 0; left: 0;
    }
    .sidebar .brand {
      padding: 1rem;
      font-weight: 600;
      font-size: 1.25rem;
      color: white;
      border-bottom: 1px solid #1e293b;
      text-align: center;
      background: #112240;
    }
    .sidebar a {
      color: var(--sidebar-color);
      text-decoration: none;
      display: block;
      padding: .75rem 1rem;
      transition: all .2s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: #1e3a8a;
      color: #fff;
    }
    .main-content {
      margin-left: var(--sidebar-width);
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    .topbar {
      background: white;
      border-bottom: 1px solid #e2e8f0;
      padding: .75rem 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 99;
    }
    .topbar h1 {
      font-size: 1.25rem;
      margin: 0;
      font-weight: 600;
    }
    .topbar .user {
      display:flex;
      align-items:center;
      gap:10px;
      font-weight: 500;
      color: #475569;
    }
    .logout-btn {
      display:inline-flex;
      align-items:center;
      gap:6px;
      background: var(--accent);
      color:#fff !important;
      border-radius:8px;
      padding:6px 12px;
      text-decoration:none;
      font-weight:600;
      transition:.2s;
    }
    .logout-btn:hover { background:#0090b8; color:#fff !important; }
    .content-area {
      padding: 1.5rem;
      flex: 1;
      background: #f1f5f9;
    }
    .btn-accent {
      background: var(--accent);
      color: #fff;
      border: none;
    }
    .btn-accent:hover { opacity: 0.9; color: #fff; }
    @media (max-width: 768px){
      .sidebar { position: fixed; transform: translateX(-100%); transition: transform .3s; }
      .sidebar.show { transform: translateX(0); }
      .main-content { margin-left: 0; }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="brand">
      <i class="bi bi-water"></i> SAMUDRA
    </div>
    <a href="<?= site_url('admin/dashboard'); ?>" class="<?= uri_string()=='admin/dashboard'?'active':''; ?>"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a>
    <a href="<?= site_url('admin/articles'); ?>" class="<?= strpos(uri_string(),'articles')!==false?'active':''; ?>"><i class="bi bi-file-earmark-text me-2"></i> Artikel</a>
    <a href="<?= site_url('admin/events'); ?>" class="<?= strpos(uri_string(),'events')!==false?'active':''; ?>"><i class="bi bi-calendar-event me-2"></i> Event</a>
    <a href="<?= site_url('admin/quizzes'); ?>" class="<?= strpos(uri_string(),'quizzes')!==false?'active':''; ?>"><i class="bi bi-question-circle me-2"></i> Kuis</a>
    <a href="<?= site_url('logout'); ?>"><i class="bi bi-box-arrow-right me-2"></i> Keluar</a>
  </div>

  <!-- Main Content -->
  <div class="main-content">
    <div class="topbar">
      <button class="btn btn-sm d-md-none" id="toggleSidebar"><i class="bi bi-list fs-4"></i></button>
      <h1><?= isset($title)? $title:'Admin'; ?></h1>
      <div class="user">
        <i class="bi bi-person-circle"></i>
        <span><?= $this->session->userdata('user')['name'] ?? 'Admin'; ?></span>
        <a href="<?= site_url('logout'); ?>" class="logout-btn">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </div>
    </div>
    <div class="content-area">
