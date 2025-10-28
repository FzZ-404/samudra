<style>
  .quiz-hero{width:100%;background:
    radial-gradient(1000px 260px at 10% -10%, rgba(126,200,255,.20), transparent 60%),
    linear-gradient(180deg, #0a2c55 0%, #0a2344 60%);
    color:#e6eef8;border:1px solid rgba(255,255,255,.08);border-left:0;border-right:0}
  .quiz-hero-inner{max-width:1200px;margin:0 auto;padding:28px 16px}
  .q-title{font-weight:800;font-size:clamp(22px,3.5vw,30px)}
  .q-sub{color:#a6bad1;margin-top:6px}
  .q-search{display:flex;gap:10px;margin-top:14px}
  .q-search input{flex:1;padding:.7rem .9rem;border-radius:.6rem;border:1px solid #134a85;background:#0b2549;color:#e6eef8}
  .q-search button{padding:.7rem 1rem;border-radius:.6rem;border:1px solid #2b6cb0;background:#2b6cb0;color:#fff;font-weight:600}

  .wrap{max-width:1200px;margin:0 auto;padding:18px 16px}
  .grid{display:grid;gap:16px;grid-template-columns:repeat(12,1fr)}
  .card{grid-column:span 4;background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;color:#e6eef8;box-shadow:0 16px 40px rgba(0,0,0,.25);overflow:hidden;display:flex;flex-direction:column;min-height:100%}
  .thumb{height:160px;background:#0e2a52}
  .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .body{padding:14px}
  .title{font-weight:700;margin:0 0 6px}
  .muted{color:#a6bad1}
  .meta{display:flex;gap:10px;margin-top:6px}
  .badge{display:inline-block;background:#113a6e;color:#9fd3ff;border:1px solid #2b6cb0;padding:.18rem .55rem;border-radius:999px;font-size:.75rem;font-weight:700;letter-spacing:.3px}
  .foot{padding:12px 14px;border-top:1px solid rgba(255,255,255,.08);margin-top:auto}
  .btn{display:inline-block;text-decoration:none;font-weight:700;border-radius:.6rem}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff;padding:.55rem .9rem}
  @media (max-width:990px){ .card{grid-column:span 6} }
  @media (max-width:600px){ .card{grid-column:span 12} }
</style>

<section class="quiz-hero">
  <div class="quiz-hero-inner">
    <div class="q-title">Kuis Edukasi Laut</div>
    <div class="q-sub">Uji pengetahuanmu tentang konservasi laut. Pilih kuis dan mulai sekarang!</div>

    <form class="q-search" method="get" action="<?= site_url('quiz'); ?>">
      <input type="text" name="q" value="<?= html_escape($keyword ?? ''); ?>" placeholder="Cari kuis (misal: terumbu karang, pesisir, plastik)…">
      <button type="submit"><i class="bi bi-search"></i> Cari</button>
    </form>
  </div>
</section>

<div class="wrap">
  <div class="grid">
    <?php if(!empty($quizzes)): foreach($quizzes as $q): ?>
      <article class="card">
        <div class="thumb"><img src="https://picsum.photos/seed/quiz<?= $q->id; ?>/800/400" alt=""></div>
        <div class="body">
          <span class="badge">Kuis</span>
          <h5 class="title"><?= html_escape($q->title); ?></h5>
          <p class="muted"><?= character_limiter(strip_tags($q->description), 110); ?></p>
          <div class="meta">
            <span class="muted">Soal: <?= (int)($q->questions_count ?? 0); ?></span>
          </div>
        </div>
        <div class="foot">
          <a class="btn btn-primary" href="<?= site_url('quiz/start/'.$q->id); ?>">Mulai Kuis →</a>
        </div>
      </article>
    <?php endforeach; else: ?>
      <div class="muted">Belum ada kuis yang dipublikasikan.</div>
    <?php endif; ?>
  </div>
</div>
