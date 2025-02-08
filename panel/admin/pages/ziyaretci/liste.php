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
 


<!-- Ana Kart -->
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="row align-items-center">
            <div class="col">
                <h5 class="mb-0">Ziyaretçi Geçmişi</h5>
            </div>
            <div class="col-auto">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#yeniZiyaretciModal">
                    <i class="fas fa-plus me-2"></i>Yeni Ziyaretçi Ekle
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <!-- Filtreler -->
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Ziyaretçi Ara...">
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option value="">Tüm Daireler</option>
                    <option value="1">Daire 1</option>
                    <option value="2">Daire 2</option>
                    <!-- Diğer daireler -->
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control">
            </div>
            <div class="col-md-3">
                <button class="btn btn-outline-primary w-100">
                    <i class="fas fa-filter me-2"></i>Filtrele
                </button>
            </div>
        </div>

        <!-- Ziyaretçi Tablosu -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Tarih</th>
                        <th>Ziyaretçi Adı</th>
                        <th>Ziyaret Edilen Daire</th>
                        <th>Giriş Saati</th>
                        <th>Çıkış Saati</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>15.03.2024</td>
                        <td>Ahmet Yılmaz</td>
                        <td>Daire 5</td>
                        <td>14:30</td>
                        <td>16:45</td>
                        <td><span class="badge bg-success">Tamamlandı</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>15.03.2024</td>
                        <td>Mehmet Demir</td>
                        <td>Daire 12</td>
                        <td>15:00</td>
                        <td>-</td>
                        <td><span class="badge bg-warning text-dark">Devam Ediyor</span></td>
                        <td>
                            <button class="btn btn-sm btn-outline-success me-1">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-primary me-1">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sayfalama -->
        <nav class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</div>

<!-- Yeni Ziyaretçi Modal -->
<div class="modal fade" id="yeniZiyaretciModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Yeni Ziyaretçi Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Ziyaretçi Adı</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Ziyaret Edilen Daire</label>
                        <select class="form-select" required>
                            <option value="">Seçiniz</option>
                            <option value="1">Daire 1</option>
                            <option value="2">Daire 2</option>
                            <!-- Diğer daireler -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giriş Saati</label>
                        <input type="time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Not (Opsiyonel)</label>
                        <textarea class="form-control" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">İptal</button>
                <button type="button" class="btn btn-primary">Kaydet</button>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS ve Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>