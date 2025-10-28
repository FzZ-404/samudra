<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title.' | SAMUDRA' : 'SAMUDRA'; ?></title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --nav-bg:#081b33;
      --nav-line:#1971c2;
      --nav-hover:#0e2a52;
      --text:#dbeafe;
      --muted:#9fb3c8;
      --brand:#7ec8ff;
      --accent:#3ea6ff;
    }
    body{margin:0;background:#071a2b;color:#e2e8f0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Open Sans','Helvetica Neue',sans-serif}

    /* ===== NAVBAR ===== */
    .nav-wrap{
      width:100%;
      background:var(--nav-bg);
      border-bottom:2px solid var(--nav-line);
      box-shadow:0 6px 16px rgba(0,0,0,.25);
      position:sticky;top:0;z-index:1000;
    }
    .nav{
      display:flex;align-items:center;justify-content:space-between;
      width:100%;
      padding:.65rem 2.5rem;
    }

    .brand{
      display:flex;align-items:center;gap:.5rem;text-decoration:none;
      color:var(--brand);font-weight:700;letter-spacing:.5px;
    }
    .brand svg{width:28px;height:28px;display:block}

    .nav-center{display:flex;gap:1.4rem;align-items:center}
    .nav-link{
      color:var(--text);text-decoration:none;font-weight:500;
      padding:.35rem .6rem;border-radius:.5rem;
      transition:background .2s,color .2s,transform .15s;
    }
    .nav-link:hover{background:var(--nav-hover);transform:translateY(-1px)}
    .nav-link.active{outline:2px solid var(--accent);outline-offset:2px}

    .nav-right{display:flex;align-items:center;gap:.6rem}
    .icon-btn{
      width:36px;height:36px;border-radius:.6rem;display:grid;place-items:center;
      color:var(--text);text-decoration:none;border:1px solid rgba(255,255,255,.08);
      background:rgba(255,255,255,.03);
      transition:background .2s,transform .15s,border-color .2s;
    }
    .icon-btn:hover{background:rgba(255,255,255,.08);transform:translateY(-1px)}

    /* dropdown login/signup + bahasa */
    .menu-dropdown{position:relative}
    .dropdown-panel{
      position:absolute;right:0;top:120%;
      min-width:160px;background:#0a2344;border:1px solid rgba(255,255,255,.08);
      border-radius:.6rem;padding:.35rem;display:none;
      box-shadow:0 12px 30px rgba(0,0,0,.35);
      flex-direction:column;
    }
    .dropdown-panel a{
      display:block;padding:.55rem .7rem;border-radius:.45rem;text-decoration:none;
      color:#e6eef8;transition:background .18s;
    }
    .dropdown-panel a:hover{background:rgba(255,255,255,.08)}
    .menu-dropdown.open .dropdown-panel{display:flex}

    .nav-underline{
      height:2px;background:linear-gradient(90deg,transparent,var(--nav-line) 20%,var(--nav-line) 80%,transparent);
    }

    /* RESPONSIVE */
    .burger{display:none}
    @media (max-width:960px){
      .nav{padding:.6rem 1rem}
      .nav-center{display:none}
      .burger{display:block}
    }
    .mobile-panel{
      display:none;background:#071c34;border-bottom:1px solid rgba(255,255,255,.08);
    }
    .mobile-panel.show{display:block}
    .mobile-list{list-style:none;margin:0;padding:.5rem}
    .mobile-list a{display:block;color:var(--text);text-decoration:none;padding:.6rem .75rem;border-radius:.45rem}
    .mobile-list a:hover{background:var(--nav-hover)}
  </style>
</head>
<body>

<header class="nav-wrap">
  <nav class="nav" aria-label="Main navigation">
    <a class="brand" href="<?= site_url(); ?>">
      <svg viewBox="0 0 64 64" fill="none" aria-hidden="true">
        <path d="M6,36 C14,28 22,44 32,36 C42,28 50,44 58,36" stroke="#7ec8ff" stroke-width="4" stroke-linecap="round"/>
      </svg>
      SAMUDRA
    </a>

    <div class="nav-center" role="menubar">
      <a class="nav-link <?= uri_string()==''?'active':''; ?>" href="<?= site_url(); ?>">Home</a>
      <a class="nav-link <?= strpos(uri_string(),'dashboard')!==false?'active':''; ?>" href="<?= site_url('dashboard'); ?>">Dashboard</a>
      <a class="nav-link <?= strpos(uri_string(),'edukasi')!==false?'active':''; ?>" href="<?= site_url('edukasi'); ?>">Edukasi</a>
      <a class="nav-link <?= strpos(uri_string(),'event')!==false?'active':''; ?>" href="<?= site_url('event'); ?>">Event</a>
      <a class="nav-link <?= strpos(uri_string(),'quiz')!==false?'active':''; ?>" href="<?= site_url('quiz'); ?>">Quiz</a>
    </div>

    <div class="nav-right">
      <a class="icon-btn" href="<?= site_url('search'); ?>" title="Cari"><i class="bi bi-search"></i></a>

      <!-- Dropdown Bahasa -->
      <div class="menu-dropdown" id="langMenu">
        <button class="icon-btn" type="button" title="Pilih Bahasa"><i class="bi bi-globe2"></i></button>
        <div class="dropdown-panel">
          <a href="<?= site_url('language/switch/indonesian'); ?>">🇮🇩 Indonesia</a>
          <a href="<?= site_url('language/switch/english'); ?>">🇬🇧 English</a>
        </div>
      </div>

      <!-- Dropdown User -->
      <div class="menu-dropdown" id="userMenu">
        <button class="icon-btn burger-toggle" type="button" title="Menu"><i class="bi bi-list"></i></button>
        <div class="dropdown-panel">
          <?php if($this->session->userdata('user')): ?>
            <a href="<?= site_url('dashboard'); ?>"><i class="bi bi-person"></i> Dashboard</a>
            <a href="<?= site_url('logout'); ?>"><i class="bi bi-box-arrow-right"></i> Logout</a>
          <?php else: ?>
            <a href="<?= site_url('login'); ?>"><i class="bi bi-box-arrow-in-right"></i> Login</a>
            <a href="<?= site_url('signup'); ?>"><i class="bi bi-person-plus"></i> Signup</a>
          <?php endif; ?>
        </div>
      </div>

      <button class="icon-btn burger" id="mainBurger" aria-label="Menu Navigasi"><i class="bi bi-three-dots"></i></button>
    </div>
  </nav>

  <div class="nav-underline"></div>

  <!-- Mobile -->
  <div class="mobile-panel" id="mobilePanel">
    <ul class="mobile-list">
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
      <li><a href="<?= site_url('edukasi'); ?>">Edukasi</a></li>
      <li><a href="<?= site_url('event'); ?>">Event</a></li>
      <li><a href="<?= site_url('quiz'); ?>">Quiz</a></li>
      <li><hr style="border-color:rgba(255,255,255,.08)"></li>
      <?php if($this->session->userdata('user')): ?>
        <li><a href="<?= site_url('logout'); ?>">Logout</a></li>
      <?php else: ?>
        <li><a href="<?= site_url('login'); ?>">Login</a></li>
        <li><a href="<?= site_url('signup'); ?>">Signup</a></li>
      <?php endif; ?>
    </ul>
  </div>
</header>

<main style="min-height:60vh;padding:18px;">

<script>
  const dropdowns = document.querySelectorAll('.menu-dropdown');
  dropdowns.forEach(menu=>{
    const btn = menu.querySelector('button');
    btn.addEventListener('click', e=>{
      e.stopPropagation();
      dropdowns.forEach(m=>{ if(m!==menu) m.classList.remove('open'); });
      menu.classList.toggle('open');
    });
  });

  document.addEventListener('click', ()=>dropdowns.forEach(m=>m.classList.remove('open')));

  const mainBurger=document.getElementById('mainBurger');
  const mobilePanel=document.getElementById('mobilePanel');
  mainBurger.addEventListener('click',()=>mobilePanel.classList.toggle('show'));
</script>
