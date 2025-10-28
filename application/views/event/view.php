<style>
  .wrap{max-width:1000px;margin:0 auto}
  .hero-img{width:100%;aspect-ratio:16/7;background:#0e2a52;border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.28)}
  .hero-img img{width:100%;height:100%;object-fit:cover;display:block}
  .title{font-weight:800;font-size:clamp(22px,3.5vw,32px);margin:14px 0 6px}
  .meta{color:#a6bad1;font-size:.95rem}
  .desc{margin-top:12px;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px;box-shadow:0 16px 40px rgba(0,0,0,.25);line-height:1.75;color:#e6eef8}
  .btn{display:inline-block;padding:.7rem 1rem;border-radius:.7rem;font-weight:700;text-decoration:none;margin-top:10px}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff}
  .related-title{color:#7ec8ff;font-weight:800;letter-spacing:.4px;margin:18px 0 10px}
  .grid{display:grid;gap:14px;grid-template-columns:repeat(12,1fr)}
  .card{grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;color:#e6eef8;box-shadow:0 16px 40px rgba(0,0,0,.25);overflow:hidden}
  .card .thumb{height:140px;background:#0e2a52}
  .card .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .card .body{padding:12px}
  @media (max-width:900px){ .card{grid-column:span 6} }
  @media (max-width:600px){ .card{grid-column:span 12} }
</style>

<div class="wrap">
  <div class="hero-img">
    <?php if(!empty($event->cover_blob)): ?>
      <img src="data:<?= $event->cover_mime ?>;base64,<?= base64_encode($event->cover_blob); ?>" alt="<?= html_escape($event->title); ?>">
    <?php else: ?>
      <img src="https://picsum.photos/seed/view<?=$event->id?>/1200/600" alt="">
    <?php endif; ?>
  </div>

  <h1 class="title"><?= html_escape($event->title); ?></h1>
  <div class="meta">
    <i class="bi bi-calendar-week"></i> <?= date('d M Y', strtotime($event->start_at)); ?>
    <?php if(!empty($event->place)): ?> • <i class="bi bi-geo-alt"></i> <?= html_escape($event->place); ?><?php endif; ?>
  </div>

  <article class="desc">
    <?= !empty($event->description) ? $event->description : '<p class="meta">Deskripsi belum tersedia.</p>'; ?>
  </article>

  <a class="btn btn-primary" href="<?= site_url('event'); ?>">← Kembali ke Daftar Event</a>

  <?php if(!empty($related)): ?>
  <h4 class="related-title">Event Lainnya</h4>
  <div class="grid">
    <?php foreach($related as $r): ?>
    <a class="card" href="<?= site_url('event/view/'.$r->id); ?>" style="text-decoration:none">
      <div class="thumb">
        <?php if(!empty($r->cover_blob)): ?>
          <img src="data:<?= $r->cover_mime ?>;base64,<?= base64_encode($r->cover_blob); ?>" alt="<?= html_escape($r->title); ?>">
        <?php else: ?>
          <img src="https://picsum.photos/seed/rel<?=$r->id?>/800/400" alt="">
        <?php endif; ?>
      </div>
      <div class="body">
        <div style="font-weight:700"><?= html_escape($r->title); ?></div>
        <div class="meta"><?= date('d M Y', strtotime($r->start_at)); ?></div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
