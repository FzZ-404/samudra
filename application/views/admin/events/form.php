<h1 class="h3 mb-3"><?= $title; ?></h1>
<form method="post" enctype="multipart/form-data"
      action="<?= isset($row)? site_url('admin/events/'.$row->id.'/update') : site_url('admin/events/store'); ?>">

  <div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control" required value="<?= html_escape($row->title ?? set_value('title')); ?>">
  </div>

  <div class="row g-3 mb-3">
    <div class="col-md-6">
      <label class="form-label">Mulai</label>
      <input type="datetime-local" name="start_at" class="form-control" required
             value="<?= isset($row->start_at) ? date('Y-m-d\TH:i',strtotime($row->start_at)) : set_value('start_at'); ?>">
    </div>
    <div class="col-md-6">
      <label class="form-label">Selesai</label>
      <input type="datetime-local" name="end_at" class="form-control" required
             value="<?= isset($row->end_at) ? date('Y-m-d\TH:i',strtotime($row->end_at)) : set_value('end_at'); ?>">
    </div>
  </div>

  <div class="mb-3">
    <label class="form-label">Tempat</label>
    <input type="text" name="place" class="form-control" value="<?= html_escape($row->place ?? set_value('place')); ?>">
  </div>

  <div class="mb-3">
    <label class="form-label">Banner (gambar)</label>
    <?php if(!empty($row->cover_blob)): ?>
      <div class="mb-2">
        <img src="data:<?= $row->cover_mime ?>;base64,<?= base64_encode($row->cover_blob); ?>" class="img-thumbnail" style="max-height:200px">
      </div>
    <?php endif; ?>
    <input type="file" name="banner" accept="image/*" class="form-control">
    <small class="text-muted">Gambar disimpan langsung di database (max ~2MB).</small>
  </div>

  <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="6" class="form-control"><?= html_escape($row->description ?? set_value('description')); ?></textarea>
  </div>

  <div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" name="published" value="1" id="pub"
      <?= (isset($row)? (int)$row->published : (int)set_value('published')) ? 'checked':''; ?>>
    <label for="pub" class="form-check-label">Published</label>
  </div>

  <a href="<?= site_url('admin/events'); ?>" class="btn btn-secondary">Kembali</a>
  <button class="btn btn-primary">Simpan</button>
</form>
