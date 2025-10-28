<div class="d-flex justify-content-between mb-3">
  <h1 class="h3">Quiz</h1>
  <a href="<?= site_url('admin/quizzes/create'); ?>" class="btn btn-primary">+ Tambah</a>
</div>

<table class="table table-striped">
<thead><tr><th>#</th><th>Judul</th><th>Waktu</th><th>Status</th><th>Aksi</th></tr></thead>
<tbody>
<?php foreach($rows as $i=>$r): ?>
  <tr>
    <td><?= $i+1; ?></td>
    <td><?= html_escape($r->title); ?></td>
    <td><?= $r->time_limit_sec ? $r->time_limit_sec.' dtk' : 'Tak dibatasi'; ?></td>
    <td><?= $r->published?'<span class="badge bg-success">Publish</span>':'<span class="badge bg-secondary">Draft</span>'; ?></td>
    <td>
      <a href="<?= site_url('admin/quizzes/'.$r->id.'/edit'); ?>" class="btn btn-sm btn-warning">Edit</a>
      <a href="<?= site_url('admin/quizzes/'.$r->id.'/delete'); ?>" onclick="return confirm('Hapus quiz ini?')" class="btn btn-sm btn-danger">Hapus</a>
    </td>
  </tr>
<?php endforeach; if(empty($rows)): ?>
  <tr><td colspan="5">Belum ada quiz.</td></tr>
<?php endif; ?>
</tbody>
</table>
