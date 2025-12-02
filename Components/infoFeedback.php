<?php if(isset($_GET['error'])) :?>
    <p class="error"> <?= $_GET['error']?></p>
<?php elseif(isset($_GET['message'])) : ?>
    <p class="message"><?= $_GET['message']?></p>
<?php endif ?>