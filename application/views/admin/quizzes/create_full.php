<h1 class="h3 mb-3"><?= $title; ?></h1>

<?php if($this->session->flashdata('error')): ?>
  <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
<?php endif; ?>
<?php if($this->session->flashdata('success')): ?>
  <div class="alert alert-success"><?= $this->session->flashdata('success'); ?></div>
<?php endif; ?>

<form method="post" action="<?= site_url('admin/quizzes/store'); ?>" id="quizForm">
  <div class="card mb-4 shadow-sm">
    <div class="card-body">
      <div class="mb-3">
        <label class="form-label">Judul Kuis</label>
        <input type="text" name="title" class="form-control" required placeholder="Misal: Kuis Konservasi Laut Dasar">
      </div>
      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" rows="3" class="form-control" placeholder="Ringkasan kuis, target, dll."></textarea>
      </div>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" name="published" value="1" id="pub">
        <label for="pub" class="form-check-label">Published</label>
      </div>
    </div>
  </div>

  <!-- BUILDER PERTANYAAN -->
  <div id="questionsWrapper"></div>

  <div class="d-flex gap-2 mb-4">
    <button type="button" class="btn btn-outline-primary" id="addQuestionBtn">+ Tambah Pertanyaan</button>
  </div>

  <div class="d-flex gap-2">
    <a href="<?= site_url('admin/quizzes'); ?>" class="btn btn-secondary">Batal</a>
    <button class="btn btn-primary">Simpan Kuis & Pertanyaan</button>
  </div>
</form>

<!-- Template hidden -->
<template id="questionTemplate">
  <div class="card mb-3 shadow-sm question-block">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center">
        <h5 class="mb-3">Pertanyaan <span class="q-number"></span></h5>
        <button type="button" class="btn btn-sm btn-outline-danger remove-question">Hapus Pertanyaan</button>
      </div>

      <div class="mb-3">
        <label class="form-label">Teks Pertanyaan</label>
        <textarea class="form-control q-text" rows="2" placeholder="Tulis pertanyaan..." required></textarea>
      </div>

      <label class="form-label">Opsi Jawaban</label>
      <div class="choices"></div>

      <div class="mt-2 d-flex gap-2">
        <button type="button" class="btn btn-sm btn-outline-secondary add-choice">+ Tambah Opsi</button>
        <small class="text-muted">Pilih salah satu radio sebagai jawaban benar.</small>
      </div>
    </div>
  </div>
</template>

<template id="choiceTemplate">
  <div class="input-group mb-2 choice-item">
    <div class="input-group-text">
      <input class="form-check-input mt-0 choice-correct" type="radio" title="Tandai benar">
    </div>
    <input type="text" class="form-control choice-text" placeholder="Tulis opsi jawaban" required>
    <button type="button" class="btn btn-outline-danger remove-choice">×</button>
  </div>
</template>

<script>
/* UX Builder pertanyaan + opsi (tanpa dep eksternal) */
(function(){
  const qWrap = document.getElementById('questionsWrapper');
  const qTpl  = document.getElementById('questionTemplate');
  const cTpl  = document.getElementById('choiceTemplate');
  const addQ  = document.getElementById('addQuestionBtn');

  let qIndex = 0;

  function renumber(){
    [...qWrap.querySelectorAll('.question-block')].forEach((blk,i)=>{
      blk.dataset.qIndex = i;
      blk.querySelector('.q-number').textContent = i+1;
      // rename fields sesuai index
      blk.querySelectorAll('.choice-item').forEach((ci,j)=>{
        const radio = ci.querySelector('.choice-correct');
        radio.name = `questions[${i}][correct]`;  // group radio per pertanyaan
        radio.value = j;                           // index opsi
      });
    });
  }

  function addChoice(block){
    const node = cTpl.content.cloneNode(true);
    block.querySelector('.choices').appendChild(node);
    renumber();
  }

  function addQuestion(){
    const node = qTpl.content.cloneNode(true);
    qWrap.appendChild(node);
    const block = qWrap.lastElementChild;

    // default 4 opsi kosong
    for(let i=0;i<4;i++) addChoice(block);

    // set name binding on input each time we type/modify
    bind(block);
    renumber();
  }

  function bind(block){
    const choicesEl = block.querySelector('.choices');

    // tambah opsi
    block.querySelector('.add-choice').addEventListener('click', ()=>{
      addChoice(block);
      // focus ke opsi terakhir
      const last = choicesEl.lastElementChild.querySelector('.choice-text');
      last && last.focus();
    });

    // hapus pertanyaan
    block.querySelector('.remove-question').addEventListener('click', ()=>{
      block.remove();
      renumber();
    });

    // hapus opsi (delegation)
    choicesEl.addEventListener('click', (e)=>{
      if(e.target.classList.contains('remove-choice')){
        const itm = e.target.closest('.choice-item');
        itm && itm.remove();
        renumber();
      }
    });
  }

  // serialize sebelum submit -> mapping ke name fields CI
  document.getElementById('quizForm').addEventListener('submit', (e)=>{
    // bersihkan hidden inputs lama
    qWrap.querySelectorAll('input[name^="questions["], textarea[name^="questions["]').forEach(n=>n.remove());

    [...qWrap.querySelectorAll('.question-block')].forEach((blk,i)=>{
      const qText = blk.querySelector('.q-text').value.trim();
      const qTa = document.createElement('textarea');
      qTa.name = `questions[${i}][text]`;
      qTa.hidden = true;
      qTa.value = qText;
      blk.appendChild(qTa);

      const choices = [...blk.querySelectorAll('.choice-item')];
      choices.forEach((ci,j)=>{
        const cInp = document.createElement('input');
        cInp.type = 'hidden';
        cInp.name = `questions[${i}][choices][${j}]`;
        cInp.value = ci.querySelector('.choice-text').value.trim();
        blk.appendChild(cInp);
      });

      // correct
      const checked = blk.querySelector('.choice-correct:checked');
      if(checked){
        const cIdx = document.createElement('input');
        cIdx.type = 'hidden';
        cIdx.name = `questions[${i}][correct]`;
        cIdx.value = checked.value;
        blk.appendChild(cIdx);
      }
    });
  });

  // default tampilkan 1 pertanyaan awal biar tidak kosong
  addQ.addEventListener('click', addQuestion);
  addQuestion();
})();
</script>
