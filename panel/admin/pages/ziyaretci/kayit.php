<div class="card">
    <div class="card-header">
        <h2 class="mb-0">
            <i class="fas fa-user-plus"></i>
            Yeni Ziyaretçi Kaydı
        </h2>
        <p class="mb-0">Ziyaretçi bilgilerini eksiksiz doldurunuz</p>
    </div>
    <div class="card-body">
        <form class="visitor-form">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="visitor-name" class="form-label">
                            <i class="fas fa-user"></i>
                            Ad Soyad
                        </label>
                        <input type="text" id="visitor-name" class="form-control" placeholder="Ziyaretçinin adı ve soyadı" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tc-number" class="form-label">
                            <i class="fas fa-id-card"></i>
                            TC Kimlik No
                        </label>
                        <input type="text" id="tc-number" class="form-control" maxlength="11" placeholder="11 haneli TC kimlik no" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="apartment" class="form-label">
                            <i class="fas fa-home"></i>
                            Ziyaret Edilecek Daire
                        </label>
                        <select id="apartment" class="form-select" required>
                            <option value="">Daire seçiniz</option>
                            <option>1. Kat - Daire 1</option>
                            <option>1. Kat - Daire 2</option>
                            <option>2. Kat - Daire 3</option>
                            <option>2. Kat - Daire 4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="visit-reason" class="form-label">
                            <i class="fas fa-info-circle"></i>
                            Ziyaret Sebebi
                        </label>
                        <input type="text" id="visit-reason" class="form-control" placeholder="Ziyaret sebebi" required>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="entry-time" class="form-label">
                            <i class="fas fa-clock"></i>
                            Giriş Saati
                        </label>
                        <input type="time" id="entry-time" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="exit-time" class="form-label">
                            <i class="fas fa-clock"></i>
                            Tahmini Çıkış Saati
                        </label>
                        <input type="time" id="exit-time" class="form-control">
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="note" class="form-label">
                    <i class="fas fa-sticky-note"></i>
                    Not
                </label>
                <textarea id="note" class="form-control" rows="3" placeholder="Eklemek istediğiniz notlar..."></textarea>
            </div>

            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-undo"></i> Temizle
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Kaydet
                </button>
            </div>
        </form>
    </div>
</div>