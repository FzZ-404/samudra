<style>
  .wrap{max-width:1000px;margin:0 auto}
  .hero-img{width:100%;aspect-ratio:16/7;background:#0e2a52;border:1px solid rgba(255,255,255,.1);border-radius:14px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.28)}
  .hero-img img{width:100%;height:100%;object-fit:cover;display:block}
  .title{font-weight:800;font-size:clamp(22px,3.5vw,32px);margin:14px 0 6px}
  .meta{color:#a6bad1;font-size:.95rem}
  .content{margin-top:12px;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;padding:18px;box-shadow:0 16px 40px rgba(0,0,0,.25);line-height:1.75;color:#e6eef8}
  .content h2,.content h3{margin-top:1.2em}
  .share{display:flex;gap:10px;align-items:center;margin-top:10px}
  .share a{display:inline-grid;place-items:center;width:38px;height:38px;border-radius:10px;background:#0b2549;border:1px solid rgba(255,255,255,.12);color:#9fd3ff;text-decoration:none}
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
    <?php if(!empty($article->cover_blob)): ?>
      <img src="data:<?= $article->cover_mime ?>;base64,<?= base64_encode($article->cover_blob); ?>" alt="<?= html_escape($article->title); ?>">
    <?php else: ?>
      <img src="https://picsum.photos/seed/hero<?= $article->id; ?>/1200/600" alt="">
    <?php endif; ?>
  </div>

  <h1 class="title"><?= html_escape($article->title); ?></h1>
  <div class="meta">
    Dipublikasikan: <?= !empty($article->created_at) ? date('d M Y', strtotime($article->created_at)) : '—'; ?>
  </div>

  <div class="share">
    <span class="meta">Bagikan:</span>
    <?php $u = urlencode(current_url()); $t=urlencode($article->title); ?>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?= $u; ?>" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>
    <a href="https://twitter.com/intent/tweet?url=<?= $u; ?>&text=<?= $t; ?>" target="_blank" title="X"><i class="bi bi-twitter-x"></i></a>
    <a href="mailto:?subject=<?= $t; ?>&body=<?= $u; ?>" title="Email"><i class="bi bi-envelope"></i></a>
  </div>

  <article class="content">
    <?= !empty($article->content) ? $article->content : '<p class="meta">Konten belum tersedia.</p>'; ?>
  </article>

  <?php if(!empty($related)): ?>
  <h4 class="related-title">Bacaan Lainnya</h4>
  <div class="grid">
    <?php foreach($related as $r): ?>
    <a class="card" href="<?= site_url('edukasi/view/'.$r->id); ?>" style="text-decoration:none">
      <div class="thumb">
        <?php if(!empty($r->cover_blob)): ?>
          <img src="data:<?= $r->cover_mime ?>;base64,<?= base64_encode($r->cover_blob); ?>" alt="<?= html_escape($r->title); ?>">
        <?php else: ?>
          <img src="https://picsum.photos/seed/rel<?=$r->id?>/800/400" alt="">
        <?php endif; ?>
      </div>
      <div class="body">
        <div style="font-weight:700"><?= html_escape($r->title); ?></div>
      </div>
    </a>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</div>
