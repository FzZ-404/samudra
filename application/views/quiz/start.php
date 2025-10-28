<div class="container py-4">
  <h1 class="text-center mb-4"><?= html_escape($quiz->title); ?></h1>
  <form method="post" action="<?= site_url('quiz/submit/'.$quiz->id); ?>" class="border rounded p-4 bg-light shadow-sm">
    <?php foreach($questions as $i=>$q): ?>
      <div class="mb-4">
        <div class="fw-bold"><?= ($i+1).'. '.html_escape($q['question']); ?></div>
        <?php foreach($q['choices'] as $c): ?>
          <div class="form-check">
            <input class="form-check-input" type="radio" name="q<?= $q['id']; ?>" value="<?= $c['id']; ?>" required>
            <label class="form-check-label"><?= html_escape($c['choice_text']); ?></label>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
    <button class="btn btn-success w-100">Kirim Jawaban</button>
  </form>
</div>
