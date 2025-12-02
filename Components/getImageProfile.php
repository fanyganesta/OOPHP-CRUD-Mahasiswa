<?php if($row['foto'] == null) : ?>
    <p><i> (Belum upload foto) </i></p>
<?php else : ?>
    <img src="Assets/img/<?=$row['foto']?>" alt="Foto Pengguna" width="150">
<?php endif ?>