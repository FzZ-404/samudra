</main>

<footer style="background:#06162b;border-top:2px solid #124b86;color:#c7d6e6">
  <div style="max-width:1200px;margin:0 auto;padding:28px 16px;display:grid;gap:18px;grid-template-columns:1.1fr .9fr .9fr">
    <div>
      <div style="font-weight:700;color:#7ec8ff;letter-spacing:.4px;margin-bottom:8px">SAMUDRA</div>
      <div style="font-size:.95rem;color:#9fb3c8;line-height:1.6">
        Edukasi konservasi laut untuk semua. Jelajahi pengetahuan, jaga ekosistem, cintai samudra Indonesia 🌊
      </div>
    </div>
    <div>
      <div style="font-weight:600;margin-bottom:8px">Navigasi</div>
      <div style="display:flex;flex-direction:column;gap:.35rem">
        <a href="<?= site_url(); ?>" style="color:#c7d6e6;text-decoration:none">Home</a>
        <a href="<?= site_url('edukasi'); ?>" style="color:#c7d6e6;text-decoration:none">Edukasi</a>
        <a href="<?= site_url('event'); ?>" style="color:#c7d6e6;text-decoration:none">Event</a>
        <a href="<?= site_url('quiz'); ?>" style="color:#c7d6e6;text-decoration:none">Quiz</a>
      </div>
    </div>
    <div>
      <div style="font-weight:600;margin-bottom:8px">Ikuti Kami</div>
      <div style="display:flex;gap:10px">
        <a href="#" title="Instagram" style="color:#c7d6e6"><i class="bi bi-instagram"></i></a>
        <a href="#" title="YouTube" style="color:#c7d6e6"><i class="bi bi-youtube"></i></a>
        <a href="#" title="Email" style="color:#c7d6e6"><i class="bi bi-envelope"></i></a>
      </div>
      <div style="margin-top:10px">
        <form action="<?= site_url('newsletter/subscribe'); ?>" method="post" style="display:flex;gap:8px">
          <input name="email" type="email" placeholder="Email kamu" required
                 style="flex:1;padding:.55rem .7rem;border-radius:.5rem;border:1px solid #133c66;background:#0a2140;color:#e6eef8">
          <button style="padding:.55rem .9rem;border-radius:.5rem;border:1px solid #2b6cb0;background:#2b6cb0;color:#fff">Subscribe</button>
        </form>
      </div>
    </div>
  </div>
  <div style="background:#051225;color:#8aa3be;text-align:center;padding:10px 12px;font-size:.9rem">
    © <?= date('Y'); ?> SAMUDRA • Dibuat dengan <span style="color:#ff6b6b">♥</span>
  </div>
</footer>

<script>
  // dropdown login/signup
  (function(){
    const userMenu = document.getElementById('userMenu');
    const btn = userMenu?.querySelector('.burger-toggle');
    const panel = userMenu?.querySelector('.dropdown-panel');

    btn?.addEventListener('click', (e)=>{
      e.stopPropagation();
      userMenu.classList.toggle('open');
      btn.setAttribute('aria-expanded', userMenu.classList.contains('open') ? 'true' : 'false');
    });
    document.addEventListener('click', (e)=>{
      if(!userMenu.contains(e.target)) userMenu.classList.remove('open');
    });
  })();

  // mobile nav
  (function(){
    const burger = document.getElementById('mainBurger');
    const panel = document.getElementById('mobilePanel');
    burger?.addEventListener('click', ()=>{
      panel.classList.toggle('show');
    });
  })();
</script>

</body>
</html>
