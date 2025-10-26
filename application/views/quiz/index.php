<h2 class="mb-4">Daftar Quiz</h2>
<div class="list-group">
<?php foreach($quizzes as $q): ?>
  <a href="#" class="list-group-item list-group-item-action">
    <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1"><?= html_escape($q->title) ?></h5>
      <?php if($q->time_limit_sec): ?>
        <small class="text-muted"><?= (int)$q->time_limit_sec ?> dtk</small>
      <?php endif; ?>
    </div>
    <p class="mb-1"><?= html_escape($q->description) ?></p>
  </a>
<?php endforeach; if(empty($quizzes)): ?>
  <div class="list-group-item">Belum ada quiz.</div>
<?php endif; ?>
</div>
