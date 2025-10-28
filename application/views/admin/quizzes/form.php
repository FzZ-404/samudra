<h1 class="h3 mb-3"><?= $title; ?></h1>

<!-- FORM KUIS -->
<form method="post" action="<?= isset($row)? site_url('admin/quizzes/'.$row->id.'/update') : site_url('admin/quizzes/store'); ?>" class="mb-4">
  <div class="mb-3">
    <label class="form-label">Judul Kuis</label>
    <input type="text" name="title" class="form-control" required value="<?= html_escape($row->title ?? ''); ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control"><?= html_escape($row->description ?? ''); ?></textarea>
  </div>
  <div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="published" value="1" id="pub"
      <?= (isset($row)? (int)$row->published : 0) ? 'checked':''; ?>>
    <label for="pub" class="form-check-label">Published</label>
  </div>
  <button class="btn btn-primary">Simpan Kuis</button>
  <a href="<?= site_url('admin/quizzes'); ?>" class="btn btn-secondary">Kembali</a>
</form>

<?php if(isset($row)): ?>
<hr>

<?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('success')): ?>
  <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<!-- FORM TAMBAH PERTANYAAN (MANUAL SATU-SATU) -->
<h4 class="mt-4 mb-3">Tambah Pertanyaan</h4>
<form method="post" action="<?= site_url('admin/quizzes/add_question/'.$row->id); ?>" class="border rounded p-3 bg-light mb-4">
  <div class="mb-3">
    <label class="form-label">Pertanyaan</label>
    <textarea name="question" class="form-control" rows="2" required placeholder="Tulis pertanyaan..."></textarea>
  </div>

  <label class="form-label">Opsi Jawaban</label>
  <div class="row g-2">
    <?php for($i=0;$i<4;$i++): ?>
    <div class="col-md-6">
      <div class="input-group mb-2">
        <div class="input-group-text">
          <input class="form-check-input mt-0" type="radio" name="correct_index" value="<?= $i; ?>" title="Tandai sebagai jawaban benar">
        </div>
        <input type="text" name="choices[<?= $i; ?>]" class="form-control" placeholder="Opsi <?= $i+1; ?>">
      </div>
    </div>
    <?php endfor; ?>
  </div>
  <small class="text-muted d-block mb-2">Centang bulatan di kiri untuk menandai jawaban yang benar. Minimal 2 opsi harus diisi.</small>

  <button class="btn btn-success">+ Tambah Pertanyaan</button>
</form>

<!-- DAFTAR PERTANYAAN YANG SUDAH ADA -->
<h4 class="mb-3">Daftar Pertanyaan</h4>
<table class="table table-bordered align-middle">
  <thead class="table-light">
    <tr>
      <th style="width:60px">#</th>
      <th>Pertanyaan & Opsi</th>
      <th style="width:130px">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $i=1;
    foreach($questions as $q):
  ?>
    <tr>
      <td><?= $i++; ?></td>
      <td>
        <div class="fw-semibold mb-2"><?= html_escape($q['question']); ?></div>
        <?php if(!empty($q['choices'])): ?>
          <ul class="mb-0">
            <?php foreach($q['choices'] as $c): ?>
              <li>
                <?php if((int)$c['is_correct']===1): ?>
                  <span class="badge bg-success me-1">Benar</span>
                <?php else: ?>
                  <span class="badge bg-secondary me-1">Opsi</span>
                <?php endif; ?>
                <?= html_escape($c['text']); ?>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else: ?>
          <em class="text-muted">Belum ada opsi.</em>
        <?php endif; ?>
      </td>
      <td>
        <a href="<?= site_url('admin/quizzes/'.$row->id.'/delete_question/'.$q['id']); ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('Hapus pertanyaan ini?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach; if(empty($questions)): ?>
    <tr><td colspan="3" class="text-center text-muted">Belum ada pertanyaan.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
<?php endif; ?>
