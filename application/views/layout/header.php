<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= isset($title) ? $title.' | SAMUDRA' : 'SAMUDRA'; ?></title>

  <!-- Ikon (opsional, bisa dilepas jika tidak perlu) -->
  <link rel="preconnect" href="https://cdn.jsdelivr.net">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root{
      --nav-bg:#081b33;         /* biru tua */
      --nav-line:#1971c2;       /* garis accent */
      --nav-hover:#0e2a52;      /* hover item */
      --text:#dbeafe;           /* teks nav */
      --muted:#9fb3c8;          /* teks redup */
      --brand:#7ec8ff;          /* logo text */
      --accent:#3ea6ff;         /* efek fokus/active */
    }
    /* reset ringan */
    *{box-sizing:border-box}
    body{margin:0;background:#071a2b;color:#e2e8f0;font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu,'Open Sans','Helvetica Neue',sans-serif}

    /* ====== NAVBAR ====== */
    .nav-wrap{
      position:sticky;top:0;z-index:1000;
      background:var(--nav-bg);
      backdrop-filter:saturate(140%) blur(4px);
      border-bottom:2px solid var(--nav-line);
      box-shadow:0 6px 16px rgba(0,0,0,.25);
    }
    .nav{
      max-width:1200px;margin:0 auto;
      display:flex;align-items:center;justify-content:space-between;
      padding:.65rem 1rem;
    }

    /* brand */
    .brand{
      display:flex;align-items:center;gap:.5rem;text-decoration:none;
      color:var(--brand);font-weight:700;letter-spacing:.5px;
      transition:opacity .2s ease;
    }
    .brand:hover{opacity:.9}
    .brand svg{width:28px;height:28px;display:block}

    /* center menu */
    .nav-center{display:flex;gap:1.2rem;align-items:center}
    .nav-link{
      color:var(--text);text-decoration:none;font-weight:500;
      padding:.35rem .6rem;border-radius:.5rem;
      transition:background .2s, color .2s, transform .15s;
    }
    .nav-link:hover{background:var(--nav-hover);transform:translateY(-1px)}
    .nav-link.active{outline:2px solid var(--accent);outline-offset:2px}

    /* right icons */
    .nav-right{display:flex;align-items:center;gap:.6rem}
    .icon-btn{
      width:36px;height:36px;border-radius:.6rem;display:grid;place-items:center;
      color:var(--text);text-decoration:none;border:1px solid rgba(255,255,255,.08);
      background:rgba(255,255,255,.03);
      transition:background .2s,transform .15s,border-color .2s;
    }
    .icon-btn:hover{background:rgba(255,255,255,.08);transform:translateY(-1px)}
    .icon-btn:focus-visible{outline:2px solid var(--accent);outline-offset:2px}

    /* dropdown */
    .menu-dropdown{position:relative}
    .dropdown-panel{
      position:absolute;right:0;top:120%;
      min-width:160px;background:#0a2344;border:1px solid rgba(255,255,255,.08);
      border-radius:.6rem;padding:.35rem;display:none;box-shadow:0 12px 30px rgba(0,0,0,.35);
    }
    .dropdown-panel a{
      display:block;padding:.55rem .7rem;border-radius:.45rem;text-decoration:none;
      color:#e6eef8;transition:background .18s;
    }
    .dropdown-panel a:hover{background:rgba(255,255,255,.08)}
    .menu-dropdown.open .dropdown-panel{display:block}

    /* underline halus di bawah nav */
    .nav-underline{height:2px;background:linear-gradient(90deg,transparent, var(--nav-line) 20%, var(--nav-line) 80%, transparent);opacity:.75}

    /* ====== RESPONSIVE ====== */
    .burger{display:none}
    @media (max-width:960px){
      .nav{padding:.6rem .8rem}
      .nav-center{display:none}
      .burger{display:block}
    }

    /* mobile panel */
    .mobile-panel{
      display:none; background:#071c34;border-bottom:1px solid rgba(255,255,255,.08);
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
    <!-- left: brand -->
    <a class="brand" href="<?= site_url(); ?>">
      <!-- simple wave logo -->
      <svg viewBox="0 0 64 64" fill="none" aria-hidden="true">
        <path d="M6,36 C14,28 22,44 32,36 C42,28 50,44 58,36" stroke="#7ec8ff" stroke-width="4" stroke-linecap="round"/>
      </svg>
      SAMUDRA
    </a>

    <!-- center: menu -->
    <div class="nav-center" role="menubar">
      <a class="nav-link <?= uri_string()==''?'active':''; ?>" href="<?= site_url(); ?>">Home</a>
      <a class="nav-link <?= strpos(uri_string(),'dashboard')!==false?'active':''; ?>" href="<?= site_url('dashboard'); ?>">Dashboard</a>
      <a class="nav-link <?= strpos(uri_string(),'edukasi')!==false?'active':''; ?>" href="<?= site_url('edukasi'); ?>">Edukasi</a>
      <a class="nav-link <?= strpos(uri_string(),'event')!==false?'active':''; ?>" href="<?= site_url('event'); ?>">Event</a>
      <a class="nav-link <?= strpos(uri_string(),'quiz')!==false?'active':''; ?>" href="<?= site_url('quiz'); ?>">Quiz</a>
    </div>

    <!-- right: icons -->
    <div class="nav-right">
      <a class="icon-btn" href="<?= site_url('search'); ?>" title="Cari" aria-label="Cari"><i class="bi bi-search"></i></a>
      <a class="icon-btn" href="<?= site_url('lang'); ?>" title="Bahasa" aria-label="Bahasa"><i class="bi bi-globe2"></i></a>

      <div class="menu-dropdown" id="userMenu">
        <button class="icon-btn burger-toggle" type="button" aria-haspopup="true" aria-expanded="false" title="Menu">
          <i class="bi bi-list"></i>
        </button>
        <div class="dropdown-panel" role="menu" aria-label="User">
          <a href="<?= site_url('login'); ?>">Login</a>
          <a href="<?= site_url('register'); ?>">Signup</a>
        </div>
      </div>

      <!-- mobile burger for links -->
      <button class="icon-btn burger" id="mainBurger" aria-label="Menu Navigasi"><i class="bi bi-three-dots"></i></button>
    </div>
  </nav>
  <div class="nav-underline"></div>

  <!-- mobile panel -->
  <div class="mobile-panel" id="mobilePanel">
    <ul class="mobile-list">
      <li><a href="<?= site_url(); ?>">Home</a></li>
      <li><a href="<?= site_url('dashboard'); ?>">Dashboard</a></li>
      <li><a href="<?= site_url('edukasi'); ?>">Edukasi</a></li>
      <li><a href="<?= site_url('event'); ?>">Event</a></li>
      <li><a href="<?= site_url('quiz'); ?>">Quiz</a></li>
      <li><hr style="border-color:rgba(255,255,255,.08)"></li>
      <li><a href="<?= site_url('login'); ?>">Login</a></li>
      <li><a href="<?= site_url('register'); ?>">Signup</a></li>
    </ul>
  </div>
</header>

<!-- konten halaman -->
<main style="min-height:60vh; padding:18px;">
