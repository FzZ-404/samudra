<style>
  .wrap{max-width:1000px;margin:0 auto}
  .head{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}
  .title{font-weight:800;font-size:clamp(20px,3.5vw,28px);color:#e6eef8}
  .muted{color:#a6bad1}

  .progress-wrap{position:sticky;top:62px;z-index:5;padding:8px 0}
  .bar{height:8px;background:#10335f;border-radius:999px;overflow:hidden}
  .bar>span{display:block;height:100%;background:#2b6cb0;width:0%}

  .qbox{background:#0a2140;border:1px solid rgba(255,255,255,.08);border-radius:12px;padding:14px;margin:12px 0;box-shadow:0 16px 40px rgba(0,0,0,.25)}
  .qtext{font-weight:700;margin-bottom:8px}
  .opt{display:flex;gap:10px;align-items:flex-start;background:#0b2549;border:1px solid rgba(255,255,255,.1);padding:10px;border-radius:10px;margin:8px 0;cursor:pointer}
  .opt input{margin-top:6px}
  .opt:hover{background:#0d2b54}
  .submitbar{position:sticky;bottom:12px;display:flex;justify-content:flex-end}
  .btn{display:inline-block;padding:.7rem 1rem;border-radius:.7rem;font-weight:700;text-decoration:none}
  .btn-primary{background:#2b6cb0;border:1px solid #2b6cb0;color:#fff}
</style>

<div class="wrap">
  <div class="head">
    <div class="title"><?= html_escape($quiz->title); ?></div>
    <div class="muted"><?= count($questions); ?> pertanyaan</div>
  </div>

  <div class="progress-wrap">
    <div class="bar"><span id="pbar"></span></div>
  </div>

  <form method="post" action="<?= site_url('quiz/submit/'.$quiz->id); ?>" id="quizForm">
    <?php foreach($questions as $i=>$q): ?>
      <div class="qbox">
        <div class="qtext"><?= ($i+1).'. '.html_escape($q['question']); ?></div>
        <?php foreach($q['choices'] as $c): ?>
          <label class="opt">
            <input type="radio" name="q<?= $q['id']; ?>" value="<?= $c['id']; ?>" required>
            <div><?= html_escape($c['choice_text']); ?></div>
          </label>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>

    <div class="submitbar">
      <button class="btn btn-primary">Kirim Jawaban</button>
    </div>
  </form>
</div>

<script>
  // Progress bar berdasarkan jumlah jawaban terpilih
  (function(){
    const total = <?= (int)count($questions); ?>;
    const pbar  = document.getElementById('pbar');
    const form  = document.getElementById('quizForm');
    const update = () => {
      const answered = new Set([...form.querySelectorAll('input[type="radio"]:checked')].map(i => i.name)).size;
      const pct = total ? Math.round((answered/total)*100) : 0;
      pbar.style.width = pct + '%';
    };
    form.addEventListener('change', update);
    update();
  })();
</script>
