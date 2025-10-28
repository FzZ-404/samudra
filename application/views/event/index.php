<style>
  .event-hero{
    width:100%;background:
      radial-gradient(1000px 260px at 10% -10%, rgba(126,200,255,.20), transparent 60%),
      linear-gradient(180deg, #0a2c55 0%, #0a2344 60%);
    color:#e6eef8;border:1px solid rgba(255,255,255,.08);border-left:0;border-right:0
  }
  .hero-inner{max-width:1200px;margin:0 auto;padding:28px 16px}
  .title{font-weight:800;font-size:clamp(22px,3.5vw,30px)}
  .sub{color:#a6bad1;margin-top:6px}
  .search{display:flex;gap:10px;margin-top:14px}
  .search input{flex:1;padding:.7rem .9rem;border-radius:.6rem;border:1px solid #134a85;background:#0b2549;color:#e6eef8}
  .search button{padding:.7rem 1rem;border-radius:.6rem;border:1px solid #2b6cb0;background:#2b6cb0;color:#fff;font-weight:600}

  .wrap{max-width:1200px;margin:0 auto;padding:18px 16px}
  .grid{display:grid;gap:16px;grid-template-columns:repeat(12,1fr)}
  .card{grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;color:#e6eef8;box-shadow:0 16px 40px rgba(0,0,0,.25);overflow:hidden;display:flex;flex-direction:column}
  .thumb{height:180px;background:#0e2a52;overflow:hidden}
  .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .body{padding:14px}
  .badge{display:inline-block;background:#113a6e;color:#9fd3ff;border:1px solid #2b6cb0;padding:.18rem .55rem;border-radius:999px;font-size:.75rem;font-weight:700}
  .event-title{font-weight:700;margin:4px 0}
  .muted{color:#a6bad1}
  .foot{padding:12px 14px;border-top:1px solid rgba(255,255,255,.08);margin-top:auto}
  .btn{display:inline-block;text-decoration:none;font-weight:700;border-radius:.6rem}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff;padding:.55rem .9rem}
  @media (max-width:990px){ .card{grid-column:span 6} }
  @media (max-width:600px){ .card{grid-column:span 12} }
</style>

<section class="event-hero">
  <div class="hero-inner">
    <div class="title">Event Konservasi Laut</div>
    <div class="sub">Ikuti kegiatan nyata untuk menjaga laut kita — dari bersih pantai hingga transplantasi karang.</div>

    <form class="search" method="get" action="<?= site_url('event'); ?>">
      <input type="text" name="q" value="<?= html_escape($keyword ?? ''); ?>" placeholder="Cari event (misal: bersih pantai, seminar, karang)…">
      <button type="submit"><i class="bi bi-search"></i> Cari</button>
    </form>
  </div>
</section>

<div class="wrap">
  <div class="grid">
    <?php if(!empty($events)): foreach($events as $e): ?>
      <article class="card">
        <div class="thumb">
          <?php if(!empty($e->cover_blob)): ?>
            <img src="data:<?= $e->cover_mime ?>;base64,<?= base64_encode($e->cover_blob); ?>" alt="<?= html_escape($e->title); ?>">
          <?php else: ?>
            <img src="https://picsum.photos/seed/event<?=$e->id?>/800/400" alt="">
          <?php endif; ?>
        </div>
        <div class="body">
          <span class="badge"><?= date('d M Y', strtotime($e->start_at)); ?></span>
          <h5 class="event-title"><?= html_escape($e->title); ?></h5>
          <p class="muted"><?= character_limiter(strip_tags($e->description), 110); ?></p>
          <p class="muted"><i class="bi bi-geo-alt"></i> <?= html_escape($e->place ?? ''); ?></p>
        </div>
        <div class="foot">
          <a class="btn btn-primary" href="<?= site_url('event/view/'.$e->id); ?>">Lihat Detail →</a>
        </div>
      </article>
    <?php endforeach; else: ?>
      <div class="muted">Belum ada event yang dijadwalkan.</div>
    <?php endif; ?>
  </div>
</div>
