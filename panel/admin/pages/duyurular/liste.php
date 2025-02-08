<?php
require_once(dirname(__FILE__) . "/../../classes/announcement.php");
require_once(dirname(__FILE__) . "/../../classes/vt.php");

$d = new Announcement();
$announcements =  $d->getAnnouncement();

?>

<style>
    /* Tablo hücrelerinde metin taşmasını engellemek için */
    .truncate {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Tablo hücrelerinde metin taşmasını engellemek için */
    td,
    th {
        vertical-align: middle;
    }
</style>
<div class="card">

    <div class="card-body">

        <div class="card-title d-flex align-items-center justify-content-between">

            <h2>Duyurular</h2>
            <a href="<?= Helper::goDashboardPage('duyurular/ekle') ?>" class="btn btn-primary btn-sm">Ekle</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Başlık</th>
                    <th scope="col">Tür</th>
                    <th scope="col">Tarih</th>
                    <th scope="col">Saat</th>
                    <th scope="col">İçerik</th>
                    <th scope="col">Düzenle</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($announcements): ?>
                    <?php foreach ($announcements as $announcement): ?>
                        <tr>
                            <td class="truncate"><?php echo htmlspecialchars($announcement['title']); ?></td>
                            <td><?php echo ucfirst($announcement['announcement_type']); ?></td>
                            <td><?php echo $announcement['announcement_date']; ?></td>
                            <td><?php echo $announcement['announcement_time'] ?: 'Belirtilmemiş'; ?></td>
                            <td class="truncate"><?php echo nl2br(htmlspecialchars($announcement['content'])); ?></td>
                            <td> <a href="">Düzenle</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-warning">Henüz duyuru bulunmamaktadır.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>