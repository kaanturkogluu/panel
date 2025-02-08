<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    /* Sol Menü Stilleri */
    .sidebar {
        width: 280px;
        background: #2c3e50;
        min-height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        padding: 1rem;
        transition: all 0.3s ease;
    }

    .sidebar-link {
        color: #ecf0f1;
        padding: 0.75rem 1rem;
        display: flex;
        align-items: center;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        transition: all 0.3s ease;
    }

    .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
    }

    .sidebar-link.active {
        background: #3498db;
        color: #fff;
    }

    .sidebar-link i {
        width: 24px;
        margin-right: 8px;
    }

    /* Ana İçerik Alanı */
    .main-content {
        margin-left: 280px;
        padding: 2rem;
    }

    /* Üst Navbar */
    .top-navbar {
        background: #fff;
        border-bottom: 1px solid #e9ecef;
        padding: 1rem 2rem;
        margin-bottom: 2rem;
    }

    /* Kartlar için gölge ve hover efekti */
    .card {
        border: none;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }

    /* Tablo stilleri */
    .table {
        vertical-align: middle;
    }

    .table thead th {
        background: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    /* Butonlar için hover efekti */
    .btn {
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    /* İstatistik kartları */
    .stat-card {
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .stat-card i {
        font-size: 2rem;
        opacity: 0.8;
    }

    /* Mobil uyumluluk */
    @media (max-width: 992px) {
        .sidebar {
            transform: translateX(-100%);
            z-index: 1000;
        }

        .sidebar.show {
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
        }
    }
</style>
 

  
<?php 
echo "<pre>";
print_r($_SESSION);
?>
  <!-- İstatistik Kartları -->
  <div class="row mb-4">
    <div class="col-md-3">
      <div class="stat-card bg-primary text-white">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0">Bugünkü Ziyaretçiler</h6>
            <h3 class="mb-0">24</h3>
          </div>
          <i class="fas fa-users"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card bg-success text-white">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0">Aktif Ziyaretçiler</h6>
            <h3 class="mb-0">8</h3>
          </div>
          <i class="fas fa-user-check"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card bg-warning text-white">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0">Bekleyen Onaylar</h6>
            <h3 class="mb-0">3</h3>
          </div>
          <i class="fas fa-clock"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="stat-card bg-info text-white">
        <div class="d-flex justify-content-between align-items-center">
          <div>
            <h6 class="mb-0">Toplam Daire</h6>
            <h3 class="mb-0">42</h3>
          </div>
          <i class="fas fa-home"></i>
        </div>
      </div>
    </div>
  </div>
 