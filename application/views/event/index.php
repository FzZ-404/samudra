<h2 class="mb-4">Event Mendatang</h2>
<ul class="list-group">
<?php foreach($events as $e): ?>
  <li class="list-group-item d-flex justify-content-between align-items-center">
    <span><?= html_escape($e->title) ?></span>
    <span class="badge bg-primary rounded-pill"><?= date('d M Y H:i', strtotime($e->start_at)) ?></span>
  </li>
<?php endforeach; if(empty($events)): ?>
  <li class="list-group-item">Belum ada event.</li>
<?php endif; ?>
</ul>
