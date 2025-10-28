<style>
  * { box-sizing: border-box; }
  body {
    background: radial-gradient(circle at top, #092a56, #071a35 60%);
    font-family: 'Poppins', sans-serif;
    margin: 0; color: #e6eef8;
  }
  .auth-wrapper {
    min-height: 100vh;
    display: flex; align-items: center; justify-content: center;
    padding: 20px;
  }
  .auth-card {
    width: 100%; max-width: 420px;
    background: linear-gradient(180deg,#0b2345 0%,#081b34 100%);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 16px;
    padding: 30px 24px;
    box-shadow: 0 20px 80px rgba(0,0,0,.45);
    animation: fadeIn .6s ease-out;
  }
  @keyframes fadeIn {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform:none;}
  }
  h2 {text-align:center;font-weight:800;color:#9fd3ff;margin-bottom:4px}
  .auth-sub {text-align:center;color:#a6bad1;font-size:.9rem;margin-bottom:22px}
  .form-group {margin-bottom:16px}
  label {display:block;font-weight:600;color:#7ec8ff;margin-bottom:6px}
  input {
    width: 100%;
    padding: .7rem .85rem;
    border-radius: .7rem;
    border: 1px solid rgba(255,255,255,.15);
    background: #0d274f;
    color: #e6eef8;
    font-size: .95rem;
    transition: .25s;
  }
  input:focus {
    border-color: #2b6cb0; outline: none;
    box-shadow: 0 0 0 3px rgba(43,108,176,.25);
  }
  button {
    width: 100%;
    padding: .8rem;
    border: none; border-radius: .7rem;
    background: #2b6cb0; color: #fff;
    font-weight: 700; font-size: 1rem;
    cursor: pointer; transition: .25s;
  }
  button:hover { background:#3b82d0; }
  .alt {text-align:center;margin-top:14px;font-size:.9rem}
  .alt a {color:#9fd3ff;text-decoration:none}
  .alt a:hover {text-decoration:underline}
  .flash {
    background:#00b89420;padding:.5rem;
    border-radius:.5rem;color:#00b894;
    text-align:center;margin-bottom:10px;
  }
</style>

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Buat Akun Baru</h2>
    <div class="auth-sub">Gabung & jelajahi dunia konservasi laut 🌊</div>

    <?php if($this->session->flashdata('success')): ?>
      <div class="flash"><?= $this->session->flashdata('success'); ?></div>
    <?php endif; ?>

    <form method="post" action="<?= site_url('auth/do_register'); ?>">
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="name" placeholder="Nama lengkap kamu" required>
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" placeholder="contoh: kamu@email.com" required>
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" placeholder="Minimal 6 karakter" required>
      </div>
      <button type="submit">Daftar</button>
    </form>

    <div class="alt">
      Sudah punya akun? <a href="<?= site_url('login'); ?>">Login</a>
    </div>
  </div>
</div>
