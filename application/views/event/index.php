<div class="container py-4">
  <h1 class="mb-4 text-center text-primary"><?= $title; ?></h1>

  <?php if(empty($events)): ?>
    <p class="text-center text-muted">Belum ada event yang akan datang.</p>
  <?php else: ?>
    <div class="row g-4">
      <?php foreach($events as $e): ?>
        <div class="col-lg-4 col-md-6">
          <div class="card h-100 shadow-sm">
            <?php if(!empty($e->cover_blob)): ?>
              <img src="data:<?= $e->cover_mime ?>;base64,<?= base64_encode($e->cover_blob); ?>"
                   class="card-img-top" style="height:200px;object-fit:cover;">
            <?php endif; ?>
            <div class="card-body">
              <div class="small text-muted mb-1">
                <?= date('D, d M Y H:i', strtotime($e->start_at)); ?> — <?= date('H:i', strtotime($e->end_at)); ?>
              </div>
              <h5 class="card-title"><?= html_escape($e->title); ?></h5>
              <?php if(!empty($e->place)): ?>
                <div class="mb-2"><span class="badge bg-info text-dark">Lokasi: <?= html_escape($e->place); ?></span></div>
              <?php endif; ?>
              <p class="card-text text-muted"><?= character_limiter(strip_tags($e->description ?? ''), 120); ?></p>
            </div>
            <div class="card-footer bg-white border-0">
              <a href="#" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
