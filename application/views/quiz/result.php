<style>
  .wrap{max-width:860px;margin:0 auto}
  .card{background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:14px;color:#e6eef8;box-shadow:0 18px 40px rgba(0,0,0,.25);padding:20px;text-align:center}
  .title{font-weight:800;font-size:clamp(20px,3.5vw,28px);margin-bottom:6px}
  .muted{color:#a6bad1}
  .circle{width:160px;height:160px;border-radius:50%;display:grid;place-items:center;margin:16px auto;background:conic-gradient(#2b6cb0 <?= (int)$percent; ?>%, #10335f 0)}
  .circle-inner{width:130px;height:130px;border-radius:50%;background:#0a2140;border:1px solid rgba(255,255,255,.08);display:grid;place-items:center;color:#9fd3ff;font-weight:800;font-size:28px}
  .btn{display:inline-block;padding:.7rem 1rem;border-radius:.7rem;font-weight:700;text-decoration:none;margin:6px}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff}
  .btn-ghost{background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.18);color:#e6eef8}
</style>

<div class="wrap">
  <div class="card">
    <div class="title">Hasil Kuis: <?= html_escape($quiz->title); ?></div>
    <div class="muted">Skor kamu dari <?= (int)$total; ?> pertanyaan</div>

    <div class="circle">
      <div class="circle-inner"><?= (int)$percent; ?>%</div>
    </div>

    <div class="muted" style="margin-top:4px">
      Benar: <strong><?= (int)$score; ?></strong> • Salah: <strong><?= (int)($total-$score); ?></strong>
    </div>

    <div style="margin-top:10px">
      <a class="btn btn-primary" href="<?= site_url('quiz'); ?>">Kembali ke Daftar Kuis</a>
      <a class="btn btn-ghost" href="<?= site_url('quiz/start/'.$quiz->id); ?>">Coba Lagi</a>
    </div>
  </div>
</div>
