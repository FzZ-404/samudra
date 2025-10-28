<div class="container py-5 text-center">
  <h1 class="mb-4"><?= html_escape($quiz->title); ?></h1>
  <div class="card p-4 shadow-sm mx-auto" style="max-width:420px;">
    <h3>Skor Kamu</h3>
    <div class="display-4 text-primary mb-3"><?= $score; ?>/<?= $total; ?></div>
    <h4><?= $percent; ?>%</h4>
    <p class="<?= $percent>=70?'text-success':'text-danger'; ?>">
      <?= $percent>=70?'Hebat! Kamu Lulus 🎉':'Sayang sekali, coba lagi 😢'; ?>
    </p>
    <a href="<?= site_url('quiz'); ?>" class="btn btn-outline-primary mt-3">Kembali ke Daftar Kuis</a>
  </div>
</div>
