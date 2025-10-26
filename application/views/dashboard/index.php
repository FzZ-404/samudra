<h2>Dashboard</h2>
<p>Halo, <?= html_escape($this->session->userdata('user')['name'] ?? 'Pengguna'); ?>.</p>
