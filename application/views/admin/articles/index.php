<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Artikel</h1>
  <a href="<?= site_url('admin/articles/create'); ?>" class="btn btn-primary">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="get" action="">
  <div class="col-auto">
    <input type="text" name="q" value="<?= html_escape($q); ?>" class="form-control" placeholder="Cari judul/kutipan...">
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-secondary">Cari</button>
  </div>
</form>

<div class="table-responsive">
<table class="table table-striped align-middle">
  <thead><tr>
    <th>#</th><th>Judul</th><th>Excerpt</th><th>Publikasi</th><th>Aksi</th>
  </tr></thead>
  <tbody>
  <?php foreach($rows as $i=>$r): ?>
    <tr>
      <td><?= $i+1; ?></td>
      <td><?= html_escape($r->title); ?></td>
      <td class="small text-muted"><?= html_escape(word_limiter($r->excerpt, 12)); ?></td>
      <td>
        <?php if($r->published): ?>
          <span class="badge bg-success">Published</span>
          <div class="small text-muted"><?= $r->published_at; ?></div>
        <?php else: ?>
          <span class="badge bg-secondary">Draft</span>
        <?php endif; ?>
      </td>
      <td>
        <a class="btn btn-sm btn-warning" href="<?= site_url('admin/articles/'.$r->id.'/edit'); ?>">Edit</a>
        <a class="btn btn-sm btn-danger" href="<?= site_url('admin/articles/'.$r->id.'/delete'); ?>" onclick="return confirm('Hapus artikel ini?')">Hapus</a>
      </td>
    </tr>
  <?php endforeach; if(empty($rows)): ?>
    <tr><td colspan="5">Belum ada artikel.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
</div>
