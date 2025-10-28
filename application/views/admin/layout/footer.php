</div> <!-- end content-area -->
    <footer class="text-center py-3 bg-white border-top small text-muted">
      © <?= date('Y'); ?> Samudra Edukasi Laut | <i class="bi bi-heart-fill text-danger"></i> by FzZ-404
    </footer>
  </div> <!-- end main-content -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById('toggleSidebar')?.addEventListener('click',()=>{
      document.getElementById('sidebar').classList.toggle('show');
    });
  </script>
</body>
</html>
