<h1 class="h3 mb-3">Dashboard Admin</h1>
<div class="row g-3">
  <div class="col-md-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <div class="fw-bold mb-2">Konten Edukasi</div>
        <p class="small text-muted">Kelola semua artikel edukasi konservasi laut.</p>
        <a href="<?= site_url('admin/articles'); ?>" class="btn btn-primary btn-sm">Kelola Artikel</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <div class="fw-bold mb-2">Event Konservasi</div>
        <p class="small text-muted">Tambahkan dan atur event kegiatan laut.</p>
        <a href="<?= site_url('admin/events'); ?>" class="btn btn-primary btn-sm">Kelola Event</a>
      </div>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card h-100 shadow-sm">
      <div class="card-body">
        <div class="fw-bold mb-2">Quiz Edukasi</div>
        <p class="small text-muted">Buat dan kelola quiz pembelajaran.</p>
        <a href="<?= site_url('admin/quizzes'); ?>" class="btn btn-primary btn-sm">Kelola Quiz</a>
      </div>
    </div>
  </div>
</div>
