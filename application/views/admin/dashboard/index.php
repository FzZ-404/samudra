<?php $this->load->view('admin/layout/header', ['title'=>'Dashboard']); ?>
<div class="container-fluid">
  <div class="row g-3">
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-newspaper me-2"></i> Artikel</h5>
          <p class="card-text">Kelola artikel edukatif tentang konservasi laut.</p>
          <a href="<?= site_url('admin/articles'); ?>" class="btn btn-accent btn-sm">Kelola</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-calendar-week me-2"></i> Event</h5>
          <p class="card-text">Atur kegiatan dan acara edukasi laut.</p>
          <a href="<?= site_url('admin/events'); ?>" class="btn btn-accent btn-sm">Kelola</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title"><i class="bi bi-question-circle me-2"></i> Kuis</h5>
          <p class="card-text">Buat kuis interaktif untuk siswa atau pengunjung.</p>
          <a href="<?= site_url('admin/quizzes'); ?>" class="btn btn-accent btn-sm">Kelola</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('admin/layout/footer'); ?>
