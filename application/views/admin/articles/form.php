<h1 class="h3 mb-3"><?= html_escape($title); ?></h1>
<form method="post" action="<?= isset($row)? site_url('admin/articles/'.$row->id.'/update') : site_url('admin/articles/store'); ?>">
  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" value="<?= html_escape($row->title ?? set_value('title')); ?>" required>
    <?= form_error('title','<small class="text-danger">','</small>'); ?>
  </div>
  <div class="mb-3">
    <label class="form-label">Excerpt (ringkasan)</label>
    <textarea name="excerpt" class="form-control" rows="2"><?= html_escape($row->excerpt ?? set_value('excerpt')); ?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label">Cover URL (opsional)</label>
    <input type="url" name="cover_url" class="form-control" value="<?= html_escape($row->cover_url ?? set_value('cover_url')); ?>">
  </div>
  <div class="mb-3">
    <label class="form-label">Konten</label>
    <textarea name="content" class="form-control" rows="10" required><?= html_escape($row->content ?? set_value('content')); ?></textarea>
    <?= form_error('content','<small class="text-danger">','</small>'); ?>
  </div>
  <div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="published" value="1" id="pub" <?= (isset($row)? (int)$row->published : (int)set_value('published')) ? 'checked':''; ?>>
    <label for="pub" class="form-check-label">Published</label>
  </div>
  <a href="<?= site_url('admin/articles'); ?>" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary">Simpan</button>
</form>
