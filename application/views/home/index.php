<style>
  /* ===== HERO FULL-WIDTH ===== */
  .home-hero{
    width:100%;
    background:
      radial-gradient(1200px 300px at 10% -10%, rgba(62,166,255,.20), transparent 60%),
      radial-gradient(900px 260px at 90% -10%, rgba(0,180,216,.15), transparent 60%),
      linear-gradient(180deg, #082243 0%, #071a2b 60%);
    color:#e6eef8;
    padding:72px 24px 56px;
    border-bottom:2px solid #124b86;
  }
  .hero-inner{
    max-width:1200px;margin:0 auto;
    display:grid;gap:18px;grid-template-columns:1.2fr .8fr;align-items:center;
  }
  .hero-title{font-size:clamp(28px,4vw,44px);font-weight:800;letter-spacing:.3px}
  .hero-sub{color:#b8c7da;font-size:clamp(14px,2vw,17px);line-height:1.7}
  .hero-actions{display:flex;gap:12px;margin-top:14px}
  .btn-primary-o{
    background:#2b6cb0;border:1px solid #2b6cb0;color:#fff;
    padding:.7rem 1.1rem;border-radius:.6rem;font-weight:600;text-decoration:none;
  }
  .btn-ghost{
    background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.18);color:#e6eef8;
    padding:.7rem 1.1rem;border-radius:.6rem;font-weight:600;text-decoration:none;
  }
  .hero-illu{
    aspect-ratio:4/3;border:1px solid rgba(255,255,255,.1);
    border-radius:14px;background:
      radial-gradient(400px 260px at 70% 10%, rgba(126,200,255,.25), transparent 60%),
      linear-gradient(160deg,#0a2c55,#0a2344);
    display:grid;place-items:center;color:#9fd3ff;
    box-shadow:0 30px 80px rgba(0,0,0,.45), inset 0 0 80px rgba(126,200,255,.07);
    font-weight:700;letter-spacing:.5px
  }

  /* ===== GRID SECTIONS ===== */
  .section{max-width:1200px;margin:0 auto;padding:28px 16px}
  .section-title{color:#7ec8ff;font-weight:800;letter-spacing:.4px;margin-bottom:14px}
  .muted{color:#92a7bf}

  .cards{display:grid;gap:16px;grid-template-columns:repeat(12,1fr)}
  .card{
    grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);
    border-radius:12px;overflow:hidden;color:#e6eef8;box-shadow:0 16px 40px rgba(0,0,0,.25);
    display:flex;flex-direction:column;min-height:100%;
  }
  .card .thumb{
    height:170px;background:#0e2a52;display:block;overflow:hidden
  }
  .card .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .card-body{padding:14px 14px 12px}
  .card-title{font-weight:700;margin:0 0 6px}
  .badge{
    display:inline-block;background:#113a6e;color:#9fd3ff;border:1px solid #2b6cb0;
    padding:.18rem .5rem;border-radius:999px;font-size:.75rem;font-weight:700;letter-spacing:.3px
  }
  .card-footer{padding:12px 14px;border-top:1px solid rgba(255,255,255,.08);margin-top:auto}
  .link{color:#9fd3ff;text-decoration:none;font-weight:600}
  .link:hover{text-decoration:underline}

  /* feature icons row */
  .feature-row{display:grid;gap:12px;grid-template-columns:repeat(12,1fr)}
  .feature{grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:16px;display:flex;gap:12px;align-items:flex-start}
  .f-ico{width:42px;height:42px;border-radius:10px;display:grid;place-items:center;background:#0f2f5a;color:#7ec8ff;border:1px solid #174c87}
  .f-title{font-weight:700;margin:0}
  .f-text{margin:4px 0 0;color:#a6bad1;font-size:.95rem}

  /* responsiveness */
  @media (max-width:990px){
    .hero-inner{grid-template-columns:1fr}
    .cards .card{grid-column:span 6}
    .feature-row .feature{grid-column:span 6}
  }
  @media (max-width:600px){
    .cards .card{grid-column:span 12}
    .feature-row .feature{grid-column:span 12}
  }
</style>

<!-- HERO -->
<section class="home-hero">
  <div class="hero-inner">
    <div>
      <div class="hero-title">Belajar & Jaga Laut Indonesia 🌊</div>
      <p class="hero-sub">Artikel edukasi, event konservasi, dan kuis interaktif — semua dalam satu platform yang elegan dan mudah dipakai.</p>
      <div class="hero-actions">
        <a href="<?= site_url('edukasi'); ?>" class="btn-primary-o">Jelajahi Edukasi</a>
        <a href="<?= site_url('quiz'); ?>" class="btn-ghost">Coba Kuis</a>
      </div>
    </div>
    <div class="hero-illu">SAMUDRA • OCEAN LEARNING</div>
  </div>
</section>

<!-- FEATURE STRIP -->
<section class="section">
  <div class="feature-row">
    <div class="feature">
      <div class="f-ico"><i class="bi bi-journal-richtext"></i></div>
      <div>
        <p class="f-title">Edukasi Terstruktur</p>
        <p class="f-text">Topik bertahap dari dasar hingga lanjutan, disusun untuk pemula sampai relawan.</p>
      </div>
    </div>
    <div class="feature">
      <div class="f-ico"><i class="bi bi-calendar2-week"></i></div>
      <div>
        <p class="f-title">Event Lapangan</p>
        <p class="f-text">Ikuti aksi nyata: bersih pantai, transplantasi karang, dan kampanye konservasi.</p>
      </div>
    </div>
    <div class="feature">
      <div class="f-ico"><i class="bi bi-clipboard2-check"></i></div>
      <div>
        <p class="f-title">Kuis Interaktif</p>
        <p class="f-text">Uji pemahamanmu, dapatkan skor & lencana pencapaian.</p>
      </div>
    </div>
  </div>
</section>

<!-- ARTIKEL TERBARU -->
<section class="section">
  <h3 class="section-title">Edukasi Terbaru</h3>
  <p class="muted">Rangkuman materi konservasi laut yang mudah dipahami.</p>

  <div class="cards" style="margin-top:10px">
    <?php if(!empty($articles)): foreach($articles as $a): ?>
      <article class="card">
        <a class="thumb" href="<?= site_url('articles/view/'.$a->id); ?>">
          <?php if(!empty($a->cover_blob)): ?>
            <img src="data:<?= $a->cover_mime ?>;base64,<?= base64_encode($a->cover_blob); ?>" alt="<?= html_escape($a->title); ?>">
          <?php else: ?>
            <img src="https://picsum.photos/seed/sea<?= $a->id; ?>/800/400" alt="">
          <?php endif; ?>
        </a>
        <div class="card-body">
          <div class="badge">Artikel</div>
          <h5 class="card-title"><?= html_escape($a->title); ?></h5>
          <p class="muted" style="margin:6px 0 0"><?= character_limiter(strip_tags($a->excerpt ?: $a->content), 110); ?></p>
        </div>
        <div class="card-footer">
          <a class="link" href="<?= site_url('articles/view/'.$a->id); ?>">Baca selengkapnya →</a>
        </div>
      </article>
    <?php endforeach; else: ?>
      <?php for($i=1;$i<=3;$i++): ?>
      <article class="card">
        <a class="thumb"><img src="https://picsum.photos/seed/placeholder<?=$i?>/800/400" alt=""></a>
        <div class="card-body">
          <div class="badge">Artikel</div>
          <h5 class="card-title">Belum ada artikel</h5>
          <p class="muted">Konten akan tampil di sini setelah admin mempublikasikan materi.</p>
        </div>
        <div class="card-footer"><span class="muted">—</span></div>
      </article>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</section>

<!-- EVENT TERDEKAT -->
<section class="section">
  <h3 class="section-title">Event Terdekat</h3>
  <p class="muted">Aksi nyata untuk laut yang lebih sehat.</p>

  <div class="cards" style="margin-top:10px">
    <?php if(!empty($events)): foreach($events as $e): ?>
    <article class="card">
      <div class="thumb">
        <?php if(!empty($e->cover_blob)): ?>
          <img src="data:<?= $e->cover_mime ?>;base64,<?= base64_encode($e->cover_blob); ?>" alt="<?= html_escape($e->title); ?>">
        <?php else: ?>
          <img src="https://picsum.photos/seed/event<?=$e->id?>/800/400" alt="">
        <?php endif; ?>
      </div>
      <div class="card-body">
        <div class="badge"><?= date('d M', strtotime($e->start_at)); ?></div>
        <h5 class="card-title"><?= html_escape($e->title); ?></h5>
        <p class="muted" style="margin:6px 0 0"><?= html_escape($e->place ?? ''); ?></p>
      </div>
      <div class="card-footer">
        <a class="link" href="<?= site_url('event'); ?>">Lihat detail →</a>
      </div>
    </article>
    <?php endforeach; else: ?>
      <?php for($i=1;$i<=3;$i++): ?>
      <article class="card">
        <div class="thumb"><img src="https://picsum.photos/seed/ev<?=$i?>/800/400" alt=""></div>
        <div class="card-body">
          <div class="badge">Soon</div>
          <h5 class="card-title">Belum ada event</h5>
          <p class="muted">Agenda terdekat akan tampil di sini.</p>
        </div>
        <div class="card-footer"><span class="muted">—</span></div>
      </article>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</section>

<!-- KUIS -->
<section class="section">
  <h3 class="section-title">Kuis Populer</h3>
  <p class="muted">Uji pengetahuanmu soal konservasi.</p>

  <div class="cards" style="margin-top:10px">
    <?php if(!empty($quizzes)): foreach($quizzes as $q): ?>
    <article class="card">
      <div class="thumb"><img src="https://picsum.photos/seed/quiz<?=$q->id?>/800/400" alt=""></div>
      <div class="card-body">
        <div class="badge">Kuis</div>
        <h5 class="card-title"><?= html_escape($q->title); ?></h5>
        <p class="muted" style="margin:6px 0 0"><?= character_limiter(strip_tags($q->description), 110); ?></p>
      </div>
      <div class="card-footer">
        <a class="link" href="<?= site_url('quiz/start/'.$q->id); ?>">Mulai kuis →</a>
      </div>
    </article>
    <?php endforeach; else: ?>
      <?php for($i=1;$i<=3;$i++): ?>
      <article class="card">
        <div class="thumb"><img src="https://picsum.photos/seed/q<?=$i?>/800/400" alt=""></div>
        <div class="card-body">
          <div class="badge">Kuis</div>
          <h5 class="card-title">Belum ada kuis</h5>
          <p class="muted">Kuis akan tampil setelah admin mempublikasi.</p>
        </div>
        <div class="card-footer"><span class="muted">—</span></div>
      </article>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</section>

<!-- CTA STRIP -->
<section class="section" style="padding-bottom:48px">
  <div style="background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px 18px 16px;display:flex;gap:12px;align-items:center;justify-content:space-between">
    <div>
      <div style="color:#7ec8ff;font-weight:800;letter-spacing:.4px">Gabung Relawan Samudra</div>
      <div class="muted">Ikut ambil bagian dalam aksi konservasi — dari pantai hingga dasar laut.</div>
    </div>
    <a class="btn-primary-o" href="<?= site_url('register'); ?>">Daftar Sekarang</a>
  </div>
</section>
