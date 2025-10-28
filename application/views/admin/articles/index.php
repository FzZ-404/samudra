<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0"><?= $title; ?></h1>
  <a href="<?= site_url('admin/articles/create'); ?>" class="btn btn-primary">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="get" action="">
  <div class="col-auto">
    <input type="text" name="q" value="<?= html_escape($q ?? ''); ?>" 
           class="form-control" placeholder="Cari judul atau isi...">
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-secondary">Cari</button>
  </div>
</form>

<table class="table table-striped align-middle">
  <thead class="table-light">
    <tr>
      <th>#</th>
      <th>Gambar</th>
      <th>Judul</th>
      <th>Status</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $i=>$r): ?>
    <tr>
      <td><?= $i+1; ?></td>
      <td>
        <?php if(!empty($r->cover_blob)): ?>
          <img src="data:<?= $r->cover_mime ?>;base64,<?= base64_encode($r->cover_blob); ?>" 
               alt="cover" style="height:60px;width:auto;border-radius:4px;">
        <?php else: ?>
          <span class="text-muted">-</span>
        <?php endif; ?>
      </td>
      <td><?= html_escape($r->title); ?></td>
      <td><?= $r->published ? '<span class="badge bg-success">Published</span>' : '<span class="badge bg-secondary">Draft</span>'; ?></td>
      <td>
        <a href="<?= site_url('admin/articles/'.$r->id.'/edit'); ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="<?= site_url('admin/articles/'.$r->id.'/delete'); ?>" 
           onclick="return confirm('Yakin ingin menghapus artikel ini?')" 
           class="btn btn-sm btn-danger">Hapus</a>
      </td>
    </tr>
  <?php endforeach; if(empty($rows)): ?>
    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada artikel.</td></tr>
  <?php endif; ?>
  </tbody>
</table>
