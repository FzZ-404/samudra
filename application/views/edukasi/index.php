<style>
  .edu-hero{width:100%;background:
    radial-gradient(1000px 260px at 10% -10%, rgba(126,200,255,.20), transparent 60%),
    linear-gradient(180deg, #0a2c55 0%, #0a2344 60%);
    color:#e6eef8;border:1px solid rgba(255,255,255,.08);border-left:0;border-right:0}
  .edu-hero-inner{max-width:1200px;margin:0 auto;padding:28px 16px}
  .e-title{font-weight:800;font-size:clamp(22px,3.5vw,30px)}
  .e-sub{color:#a6bad1;margin-top:6px}
  .e-search{display:flex;gap:10px;margin-top:14px}
  .e-search input{flex:1;padding:.7rem .9rem;border-radius:.6rem;border:1px solid #134a85;background:#0b2549;color:#e6eef8}
  .e-search button{padding:.7rem 1rem;border-radius:.6rem;border:1px solid #2b6cb0;background:#2b6cb0;color:#fff;font-weight:600}

  .wrap{max-width:1200px;margin:0 auto;padding:18px 16px}
  .grid{display:grid;gap:16px;grid-template-columns:repeat(12,1fr)}
  .card{grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;color:#e6eef8;box-shadow:0 16px 40px rgba(0,0,0,.25);overflow:hidden;display:flex;flex-direction:column;min-height:100%}
  .thumb{height:170px;background:#0e2a52;overflow:hidden}
  .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .body{padding:14px}
  .title{font-weight:700;margin:0 0 6px}
  .muted{color:#a6bad1}
  .foot{padding:12px 14px;border-top:1px solid rgba(255,255,255,.08);margin-top:auto}
  .btn{display:inline-block;text-decoration:none;font-weight:700;border-radius:.6rem}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff;padding:.55rem .9rem}
  .badge{display:inline-block;background:#113a6e;color:#9fd3ff;border:1px solid #2b6cb0;padding:.18rem .55rem;border-radius:999px;font-size:.75rem;font-weight:700;letter-spacing:.3px}
  @media (max-width:990px){ .card{grid-column:span 6} }
  @media (max-width:600px){ .card{grid-column:span 12} }

  /* featured */
  .featured{
    display:grid;gap:16px;grid-template-columns:1.2fr .8fr;align-items:stretch;
    background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;overflow:hidden;
    box-shadow:0 20px 60px rgba(0,0,0,.28);margin-top:16px
  }
  .featured .img{background:#0e2a52;min-height:240px}
  .featured .img img{width:100%;height:100%;object-fit:cover;display:block}
  .featured .info{padding:16px}
  .featured .info h3{margin:0 0 8px;font-weight:800}
  .featured .info p{color:#a6bad1;margin:0}
  .featured .actions{margin-top:12px}
  @media (max-width:900px){ .featured{grid-template-columns:1fr} }
</style>

<section class="edu-hero">
  <div class="edu-hero-inner">
    <div class="e-title">Edukasi Konservasi Laut</div>
    <div class="e-sub">Materi ringkas, ilustrasi menarik, dan mudah dipahami — dari dasar hingga lanjutan.</div>

    <form class="e-search" method="get" action="<?= site_url('edukasi'); ?>">
      <input type="text" name="q" value="<?= html_escape($keyword ?? ''); ?>" placeholder="Cari materi (misal: terumbu karang, lamun, mikroplastik)…">
      <button type="submit"><i class="bi bi-search"></i> Cari</button>
    </form>

    <?php if($featured): ?>
      <div class="featured">
        <div class="img">
          <?php if(!empty($featured->cover_blob)): ?>
            <img src="data:<?= $featured->cover_mime ?>;base64,<?= base64_encode($featured->cover_blob); ?>" alt="<?= html_escape($featured->title); ?>">
          <?php else: ?>
            <img src="https://picsum.photos/seed/edu<?= $featured->id; ?>/1000/600" alt="">
          <?php endif; ?>
        </div>
        <div class="info">
          <span class="badge">Unggulan</span>
          <h3><?= html_escape($featured->title); ?></h3>
          <p><?= character_limiter(strip_tags($featured->excerpt ?: $featured->content), 180); ?></p>
          <div class="actions">
            <a class="btn btn-primary" href="<?= site_url('edukasi/view/'.$featured->id); ?>">Baca sekarang →</a>
          </div>
        </div>
      </div>
    <?php endif; ?>
  </div>
</section>

<div class="wrap">
  <h4 style="color:#7ec8ff;font-weight:800;letter-spacing:.4px;margin-bottom:10px">Semua Materi</h4>
  <div class="grid">
    <?php if(!empty($articles)): foreach($articles as $i=>$a): if($featured && $i===0) continue; ?>
      <article class="card">
        <a class="thumb" href="<?= site_url('edukasi/view/'.$a->id); ?>">
          <?php if(!empty($a->cover_blob)): ?>
            <img src="data:<?= $a->cover_mime ?>;base64,<?= base64_encode($a->cover_blob); ?>" alt="<?= html_escape($a->title); ?>">
          <?php else: ?>
            <img src="https://picsum.photos/seed/a<?=$a->id?>/800/400" alt="">
          <?php endif; ?>
        </a>
        <div class="body">
          <span class="badge">Artikel</span>
          <h5 class="title"><?= html_escape($a->title); ?></h5>
          <p class="muted"><?= character_limiter(strip_tags($a->excerpt ?: $a->content), 110); ?></p>
        </div>
        <div class="foot">
          <a class="btn btn-primary" href="<?= site_url('edukasi/view/'.$a->id); ?>">Baca selengkapnya →</a>
        </div>
      </article>
    <?php endforeach; else: ?>
      <?php for($i=1;$i<=6;$i++): ?>
      <article class="card">
        <div class="thumb"><img src="https://picsum.photos/seed/placeholder<?=$i?>/800/400" alt=""></div>
        <div class="body">
          <span class="badge">Artikel</span>
          <h5 class="title">Belum ada konten</h5>
          <p class="muted">Konten edukasi akan muncul setelah admin mempublikasikan materi.</p>
        </div>
        <div class="foot"><span class="muted">—</span></div>
      </article>
      <?php endfor; ?>
    <?php endif; ?>
  </div>
</div>
