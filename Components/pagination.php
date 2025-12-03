<?php if($jumlahHalaman > 1) : ?>
    <tr>
        <td colspan="9" class="ct">
            <?php if($halamanAktif > 1) : ?>
                <a href="?halaman=<?= $halamanAktif-1?><?php echo (isset($_GET['cari'])) ? "&cari={$_GET['cari']}" : null?>"> &laquo;</a>
            <?php endif ?>
            <?php if($halamanAktif >= 3) : ?>
                <a href="?halaman=1<?php echo (isset($_GET['cari'])) ? "&cari={$_GET['cari']}" : null?>">1</a>
                <?php if($halamanAktif >= 4) : ?>
                    <p style="display:inline"> ... </p>
                <?php endif ?>
            <?php endif ?>
            <?php for($j = 1; $j <= $jumlahHalaman; $j++) : ?>
                <?php if($j == $halamanAktif) : ?>
                    <p style="display:inline; font-size: 17px"><b><?=$j?></b></p>
                <?php else : ?>
                    <?php if($j <= $halamanAktif+2 && $j > $halamanAktif - 2) :?>
                        <a href="?halaman=<?=$j?><?php echo (isset($_GET['cari'])) ? "&cari={$_GET['cari']}" : null?>"><?=$j?></a>
                    <?php endif ?>
                <?php endif ?>
            <?php endfor ?>
            <?php if($jumlahHalaman > 4 && $halamanAktif < $jumlahHalaman-2) :?>
                <?php if($halamanAktif != $jumlahHalaman-2 ) : ?>
                    <p style="display:inline"> ... </p>
                <?php endif ?>
                <a href="?halaman=<?= $jumlahHalaman?><?php echo (isset($_GET['cari'])) ? "&cari={$_GET['cari']}" : null?>"><?= $jumlahHalaman ?></a>
            <?php endif ?>
            <?php if($halamanAktif < $jumlahHalaman) : ?>
                <a href="?halaman=<?= $halamanAktif + 1 ?><?php echo (isset($_GET['cari'])) ? "&cari={$_GET['cari']}" : null?>"> &raquo; </a>
            <?php endif ?>
        </td>
    </tr>
<?php endif ?>