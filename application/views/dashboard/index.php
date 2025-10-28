<style>
  .dash-wrap{max-width:1200px;margin:0 auto;padding:12px 0}
  .eyebrow{color:#7ec8ff;font-weight:800;letter-spacing:.4px}
  .title{font-weight:800;font-size:clamp(22px,3.5vw,32px);margin:.15rem 0 .5rem}
  .muted{color:#a6bad1}

  /* summary cards */
  .grid{display:grid;gap:14px;grid-template-columns:repeat(12,1fr)}
  .card{
    background:#0a2140;border:1px solid rgba(255,255,255,.08);
    border-radius:14px;box-shadow:0 18px 40px rgba(0,0,0,.25);overflow:hidden;color:#e6eef8
  }
  .card-body{padding:16px}
  .kpi{display:flex;align-items:center;gap:12px}
  .kpi .ico{
    width:44px;height:44px;border-radius:12px;display:grid;place-items:center;
    background:#0f2f5a;color:#7ec8ff;border:1px solid #174c87;font-size:20px
  }
  .kpi .val{font-size:22px;font-weight:800}
  .kpi .lbl{color:#a6bad1;font-size:.95rem;margin-top:-2px}

  /* lists */
  .list-card .thumb{height:130px;background:#0e2a52;overflow:hidden}
  .list-card .thumb img{width:100%;height:100%;object-fit:cover;display:block}
  .badge{
    display:inline-block;background:#113a6e;color:#9fd3ff;border:1px solid #2b6cb0;
    padding:.18rem .55rem;border-radius:999px;font-size:.75rem;font-weight:700;letter-spacing:.3px
  }
  .link{color:#9fd3ff;text-decoration:none;font-weight:600}
  .link:hover{text-decoration:underline}

  /* grid spans */
  .span-4{grid-column:span 4}
  .span-6{grid-column:span 6}
  .span-12{grid-column:span 12}

  @media (max-width:990px){
    .span-4{grid-column:span 6}
    .span-6{grid-column:span 12}
  }
  @media (max-width:600px){
    .span-4{grid-column:span 12}
  }
</style>

<div class="dash-wrap">
  <div class="card" style="background:linear-gradient(180deg,#0a2c55,#0a2344);border-color:#134a85">
    <div class="card-body" style="display:flex;gap:16px;align-items:center;justify-content:space-between;flex-wrap:wrap">
      <div>
        <div class="eyebrow">DASHBOARD</div>
        <div class="title">Selamat datang di Samudra 🌊</div>
        <div class="muted">Ringkasan cepat aktivitas edukasi, event, dan kuis. Yuk lanjut belajar & beraksi!</div>
      </div>
      <div>
        <a href="<?= site_url('edukasi'); ?>" class="btn-primary-o" style="text-decoration:none">Mulai Belajar</a>
        <a href="<?= site_url('quiz'); ?>" class="btn-ghost" style="text-decoration:none">Coba Kuis</a>
      </div>
    </div>
  </div>

  <!-- KPI -->
  <div class="grid" style="margin-top:14px">
    <div class="card span-4">
      <div class="card-body kpi">
        <div class="ico"><i class="bi bi-journal-richtext"></i></div>
        <div>
          <div class="val"><?= (int)$total_articles; ?></div>
          <div class="lbl">Artikel Edukasi</div>
        </div>
      </div>
    </div>
    <div class="card span-4">
      <div class="card-body kpi">
        <div class="ico"><i class="bi bi-calendar-week"></i></div>
        <div>
          <div class="val"><?= (int)$total_events; ?></div>
          <div class="lbl">Event Tersedia</div>
        </div>
      </div>
    </div>
    <div class="card span-4">
      <div class="card-body kpi">
        <div class="ico"><i class="bi bi-clipboard2-check"></i></div>
        <div>
          <div class="val"><?= (int)$total_quizzes; ?></div>
          <div class="lbl">Kuis Aktif</div>
        </div>
      </div>
    </div>
  </div>

  <!-- 2 kolom: artikel & event -->
  <div class="grid" style="margin-top:6px">
    <!-- Artikel terbaru -->
    <div class="span-6">
      <div class="eyebrow">Edukasi Terbaru</div>
      <div class="grid" style="margin-top:8px">
        <?php if(!empty($articles)): foreach($articles as $a): ?>
          <article class="card span-6 list-card">
            <div class="thumb">
              <?php if(!empty($a->cover_blob)): ?>
                <img src="data:<?= $a->cover_mime ?>;base64,<?= base64_encode($a->cover_blob); ?>" alt="<?= html_escape($a->title); ?>">
              <?php else: ?>
                <img src="https://picsum.photos/seed/sea<?= $a->id; ?>/800/400" alt="">
              <?php endif; ?>
            </div>
            <div class="card-body">
              <div class="badge">Artikel</div>
              <h5 style="margin:.35rem 0 0;font-weight:700"><?= html_escape($a->title); ?></h5>
              <p class="muted" style="margin:.2rem 0 0"><?= character_limiter(strip_tags($a->excerpt ?: $a->content), 90); ?></p>
            </div>
            <div class="card-body" style="padding-top:0">
              <a class="link" href="<?= site_url('articles/view/'.$a->id); ?>">Baca selengkapnya →</a>
            </div>
          </article>
        <?php endforeach; else: ?>
          <div class="muted span-12" style="padding:10px">Belum ada artikel.</div>
        <?php endif; ?>
      </div>
    </div>

    <!-- Event terdekat -->
    <div class="span-6">
      <div class="eyebrow">Event Terdekat</div>
      <div class="grid" style="margin-top:8px">
        <?php if(!empty($events)): foreach($events as $e): ?>
          <article class="card span-12 list-card" style="display:flex;flex-direction:row;gap:0">
            <div class="thumb" style="width:40%;height:auto">
              <?php if(!empty($e->cover_blob)): ?>
                <img src="data:<?= $e->cover_mime ?>;base64,<?= base64_encode($e->cover_blob); ?>" alt="<?= html_escape($e->title); ?>">
              <?php else: ?>
                <img src="https://picsum.photos/seed/event<?= $e->id; ?>/800/400" alt="">
              <?php endif; ?>
            </div>
            <div style="flex:1">
              <div class="card-body">
                <div class="badge"><?= date('d M', strtotime($e->start_at)); ?></div>
                <h5 style="margin:.35rem 0 0;font-weight:700"><?= html_escape($e->title); ?></h5>
                <p class="muted" style="margin:.2rem 0 0"><?= html_escape($e->place ?? ''); ?></p>
              </div>
              <div class="card-body" style="padding-top:0">
                <a class="link" href="<?= site_url('event'); ?>">Lihat detail →</a>
              </div>
            </div>
          </article>
        <?php endforeach; else: ?>
          <div class="muted span-12" style="padding:10px">Belum ada event terjadwal.</div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <!-- Kuis -->
  <div class="eyebrow" style="margin-top:14px">Kuis Untukmu</div>
  <div class="grid" style="margin-top:8px">
    <?php if(!empty($quizzes)): foreach($quizzes as $q): ?>
      <article class="card span-4 list-card">
        <div class="thumb"><img src="https://picsum.photos/seed/quiz<?= $q->id; ?>/800/400" alt=""></div>
        <div class="card-body">
          <div class="badge">Kuis</div>
          <h5 style="margin:.35rem 0 0;font-weight:700"><?= html_escape($q->title); ?></h5>
          <p class="muted" style="margin:.2rem 0 0"><?= character_limiter(strip_tags($q->description), 80); ?></p>
        </div>
        <div class="card-body" style="padding-top:0">
          <a class="link" href="<?= site_url('quiz/start/'.$q->id); ?>">Mulai kuis →</a>
        </div>
      </article>
    <?php endforeach; else: ?>
      <div class="muted span-12" style="padding:10px">Belum ada kuis aktif.</div>
    <?php endif; ?>
  </div>
</div>
