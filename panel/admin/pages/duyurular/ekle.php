<div class="container py-5">
    <h1 class="mb-4">Duyuru Ekle</h1>

    <!-- Duyuru Tipi Seçimi -->
    <form action="<?= Helper::routers('announcement') ?>" method="post">
        <div class="mb-4">
            <label for="announcement-type" class="form-label">Duyuru Tipi</label>
            <select name="announcement-type" class="form-select" required>
                <option value="">Duyuru tipi seçiniz</option>
                <option value="meeting">Apartman Toplantısı</option>
                <option value="maintenance">Bina Bakımı</option>
                <option value="security">Yeni Güvenlik Sistemi</option>
            </select>
        </div>

        <!-- Başlık ve Tarih -->
        <div class="mb-4">
            <label for="announcement-title" class="form-label">Duyuru Başlığı</label>
            <input type="text" name="announcement-title" class="form-control" placeholder="Duyuru başlığını giriniz" required>
        </div>

        <div class="mb-4">
            <label for="announcement-date" class="form-label">Tarih</label>
            <input type="date" name="announcement-date" class="form-control" required>
        </div>

        <!-- Saat (Opsiyonel) -->
        <div class="mb-4" id="time-field">
            <label for="announcement-time" class="form-label">Saat</label>
            <input type="time" name="announcement-time" class="form-control">
        </div>

        <!-- Duyuru İçeriği -->
        <div class="mb-4">
            <label for="announcement-content" class="form-label">Duyuru İçeriği</label>
            <textarea name="announcement-content" class="form-control" rows="4" placeholder="Duyuru içeriğini giriniz" required></textarea>
        </div>

        <!-- Duyuru Tipine Göre Etiket -->
        <!-- <div class="mb-4">
            <label for="announcement-tag" class="form-label">Etiket</label>
            <input type="text" name="announcement-tag" class="form-control" placeholder="Toplantı, Bakım, Güvenlik vb." required>
        </div> -->

        <input type="hidden" name="mode" value="insert">
        <!-- Ekle Butonu -->
        <button type="submit" class="btn btn-primary">Duyuruyu Ekle</button>
    </form>
</div>

<script>
    // Duyuru tipi seçildiğinde saat alanının görünürlüğünü güncelle
    document.getElementById('announcement-type').addEventListener('change', function() {
        var timeField = document.getElementById('time-field');
        var announcementType = this.value;
        if (announcementType === 'meeting' || announcementType === 'maintenance') {
            timeField.style.display = 'block';
        } else {
            timeField.style.display = 'none';
        }
    });
</script>