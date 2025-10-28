<div class="container py-4">
  <h1 class="text-center text-primary mb-4"><?= $title; ?></h1>
  <div class="row g-4">
    <?php foreach($quizzes as $q): ?>
    <div class="col-md-4 col-sm-6">
      <div class="card h-100 shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><?= html_escape($q->title); ?></h5>
          <p class="card-text text-muted"><?= character_limiter(strip_tags($q->description),100); ?></p>
        </div>
        <div class="card-footer bg-white border-0">
          <a href="<?= site_url('quiz/start/'.$q->id); ?>" class="btn btn-primary w-100">Mulai Kuis</a>
        </div>
      </div>
    </div>
    <?php endforeach; if(empty($quizzes)): ?>
      <p class="text-center text-muted">Belum ada kuis tersedia.</p>
    <?php endif; ?>
  </div>
</div>
