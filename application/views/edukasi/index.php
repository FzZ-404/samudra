<div class="container py-4">
  <h1 class="mb-4 text-center text-primary"><?= $title; ?></h1>
  <div class="row g-4">
  <?php foreach($articles as $a): ?>
    <div class="col-md-4 col-sm-6">
      <div class="card h-100 shadow-sm">
        <?php if(!empty($a->cover_blob)): ?>
          <img src="data:<?= $a->cover_mime ?>;base64,<?= base64_encode($a->cover_blob); ?>" 
               class="card-img-top" style="height:200px;object-fit:cover;">
        <?php endif; ?>
        <div class="card-body">
          <h5 class="card-title"><?= html_escape($a->title); ?></h5>
          <p class="card-text text-muted"><?= character_limiter(strip_tags($a->excerpt ?: $a->content), 100); ?></p>
        </div>
        <div class="card-footer bg-white border-top-0">
          <a href="#" class="btn btn-outline-primary btn-sm">Baca Selengkapnya</a>
        </div>
      </div>
    </div>
  <?php endforeach; if(empty($articles)): ?>
    <p class="text-center text-muted">Belum ada artikel edukasi yang dipublikasikan.</p>
  <?php endif; ?>
  </div>
</div>
