<?php $this->load->view('admin/layout/header', ['title'=>'Dashboard']); ?>

<style>
  .grid{display:grid;gap:14px;grid-template-columns:repeat(12,1fr)}
  .card{
    background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;color:#e6eef8;
    box-shadow:0 18px 40px rgba(0,0,0,.25);overflow:hidden
  }
  .card-body{padding:16px}
  .span-4{grid-column:span 4}
  .span-6{grid-column:span 6}
  .span-12{grid-column:span 12}
  .kpi{display:flex;gap:12px;align-items:center}
  .ico{width:44px;height:44px;border-radius:12px;display:grid;place-items:center;background:#0f2f5a;color:#7ec8ff;border:1px solid #174c87;font-size:20px}
  .val{font-size:22px;font-weight:800}
  .lbl{color:#a6bad1}
  @media (max-width:990px){ .span-4{grid-column:span 6} .span-6{grid-column:span 12} }
  @media (max-width:600px){ .span-4{grid-column:span 12} }
  .btn-accent{background:#00b4d8;border:none;color:#fff}
</style>

<div class="grid">
  <!-- Welcome -->
  <div class="card span-12" style="background:linear-gradient(180deg,#0a2c55,#0a2344)">
    <div class="card-body" style="display:flex;justify-content:space-between;gap:12px;flex-wrap:wrap">
      <div>
        <div style="color:#7ec8ff;font-weight:800;letter-spacing:.4px">ADMIN DASHBOARD</div>
        <h3 style="margin:.2rem 0 .4rem;font-weight:800">Halo, Admin 👋</h3>
        <div style="color:#a6bad1">Kelola artikel, event, dan kuis dengan cepat dari sini.</div>
      </div>
      <div class="d-flex gap-2">
        <a href="<?= site_url('admin/articles/create'); ?>" class="btn btn-accent">+ Artikel</a>
        <a href="<?= site_url('admin/events/create'); ?>" class="btn btn-accent">+ Event</a>
        <a href="<?= site_url('admin/quizzes/create'); ?>" class="btn btn-accent">+ Kuis</a>
      </div>
    </div>
  </div>

  <!-- KPI -->
  <div class="card span-4"><div class="card-body kpi"><div class="ico"><i class="bi bi-journal-text"></i></div><div><div class="val"><?= $this->db->count_all_results('articles'); ?></div><div class="lbl">Artikel</div></div></div></div>
  <div class="card span-4"><div class="card-body kpi"><div class="ico"><i class="bi bi-calendar-event"></i></div><div><div class="val"><?= $this->db->count_all_results('events'); ?></div><div class="lbl">Event</div></div></div></div>
  <div class="card span-4"><div class="card-body kpi"><div class="ico"><i class="bi bi-question-circle"></i></div><div><div class="val"><?= $this->db->count_all_results('quizzes'); ?></div><div class="lbl">Kuis</div></div></div></div>

  <!-- Quick links -->
  <div class="card span-6">
    <div class="card-body">
      <h5 style="font-weight:800;margin-bottom:10px">Akses Cepat</h5>
      <div class="d-grid gap-2">
        <a class="btn btn-outline-light" href="<?= site_url('admin/articles'); ?>"><i class="bi bi-newspaper me-2"></i>Kelola Artikel</a>
        <a class="btn btn-outline-light" href="<?= site_url('admin/events'); ?>"><i class="bi bi-calendar3 me-2"></i>Kelola Event</a>
        <a class="btn btn-outline-light" href="<?= site_url('admin/quizzes'); ?>"><i class="bi bi-ui-checks-grid me-2"></i>Kelola Kuis</a>
      </div>
    </div>
  </div>

  <!-- Tips -->
  <div class="card span-6">
    <div class="card-body">
      <h5 style="font-weight:800;margin-bottom:10px">Tips Publikasi</h5>
      <ul class="mb-0" style="color:#a6bad1">
        <li>Centang <strong>Published</strong> agar konten tampil di user.</li>
        <li>Event tampil di beranda jika tanggalnya ≥ hari ini.</li>
        <li>Kuis bisa dibuat 1-langkah di <em>Tambah Kuis</em>.</li>
      </ul>
    </div>
  </div>
</div>

<?php $this->load->view('admin/layout/footer'); ?>
