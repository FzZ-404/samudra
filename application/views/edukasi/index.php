<h2 class="mb-4">Materi Edukasi</h2>
<div class="row g-3">
  <?php foreach($articles as $a): ?>
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-dark">
        <h5 class="card-title"><?= html_escape($a->title) ?></h5>
        <p class="card-text small text-muted"><?= html_escape($a->excerpt) ?></p>
      </div>
    </div>
  </div>
  <?php endforeach; if(empty($articles)): ?>
    <p class="text-secondary">Belum ada artikel.</p>
  <?php endif; ?>
</div>
