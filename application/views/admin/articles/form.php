<h1 class="h3 mb-3"><?= $title; ?></h1>
<form method="post" enctype="multipart/form-data"
      action="<?= isset($row)? site_url('admin/articles/'.$row->id.'/update') : site_url('admin/articles/store'); ?>">

  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" required
           value="<?= html_escape($row->title ?? set_value('title')); ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Ringkasan</label>
    <textarea name="excerpt" class="form-control" rows="2"><?= html_escape($row->excerpt ?? set_value('excerpt')); ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label">Gambar Cover</label>
    <?php if(!empty($row->cover_blob)): ?>
      <div class="mb-2">
        <img src="data:<?= $row->cover_mime ?>;base64,<?= base64_encode($row->cover_blob); ?>" 
             alt="cover" class="img-thumbnail" style="max-height:200px">
      </div>
    <?php endif; ?>
    <input type="file" name="cover" accept="image/*" class="form-control">
    <small class="text-muted">Gambar disimpan langsung di database (max 2MB)</small>
  </div>

  <div class="mb-3">
    <label class="form-label">Konten</label>
    <textarea name="content" class="form-control" rows="10"><?= html_escape($row->content ?? set_value('content')); ?></textarea>
  </div>

  <div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="published" value="1" id="pub"
      <?= (isset($row)? (int)$row->published : (int)set_value('published')) ? 'checked':''; ?>>
    <label for="pub" class="form-check-label">Published</label>
  </div>

  <a href="<?= site_url('admin/articles'); ?>" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary">Simpan</button>
</form>
