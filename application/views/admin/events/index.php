<div class="d-flex justify-content-between mb-3">
  <h1 class="h3">Daftar Event</h1>
  <a href="<?= site_url('admin/events/create'); ?>" class="btn btn-primary">+ Tambah</a>
</div>

<form class="row g-2 mb-3" method="get">
  <div class="col-auto">
    <input type="text" name="q" value="<?= html_escape($q); ?>" class="form-control" placeholder="Cari...">
  </div>
  <div class="col-auto"><button class="btn btn-outline-secondary">Cari</button></div>
</form>

<table class="table table-striped">
  <thead><tr><th>#</th><th>Judul</th><th>Tempat</th><th>Waktu</th><th>Status</th><th>Aksi</th></tr></thead>
  <tbody>
    <?php foreach($rows as $i=>$r): ?>
      <tr>
        <td><?= $i+1; ?></td>
        <td><?= html_escape($r->title); ?></td>
        <td><?= html_escape($r->place); ?></td>
        <td><?= date('d M H:i',strtotime($r->start_at)); ?></td>
        <td><?= $r->published ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-secondary">Draft</span>'; ?></td>
        <td>
          <a href="<?= site_url('admin/events/'.$r->id.'/edit'); ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="<?= site_url('admin/events/'.$r->id.'/delete'); ?>" onclick="return confirm('Hapus event ini?')" class="btn btn-sm btn-danger">Hapus</a>
        </td>
      </tr>
    <?php endforeach; if(empty($rows)): ?>
      <tr><td colspan="6">Belum ada event.</td></tr>
    <?php endif; ?>
  </tbody>
</table>
