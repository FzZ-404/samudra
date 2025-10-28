<h1 class="h3 mb-3"><?= $title; ?></h1>
<form method="post" action="<?= isset($row)? site_url('admin/quizzes/'.$row->id.'/update') : site_url('admin/quizzes/store'); ?>">
  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" required value="<?= html_escape($row->title ?? set_value('title')); ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" class="form-control" rows="4"><?= html_escape($row->description ?? set_value('description')); ?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Batas Waktu (detik)</label>
    <input type="number" name="time_limit_sec" class="form-control" value="<?= html_escape($row->time_limit_sec ?? set_value('time_limit_sec')); ?>">
  </div>
  <div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="published" value="1" id="pub" <?= (isset($row)? (int)$row->published : (int)set_value('published')) ? 'checked':''; ?>>
    <label for="pub" class="form-check-label">Published</label>
  </div>
  <a href="<?= site_url('admin/quizzes'); ?>" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary">Simpan</button>
</form>
