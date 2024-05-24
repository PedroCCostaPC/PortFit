<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<?php if(!isset($this->data['title-dash']) && !isset($this->data['title-student'])): ?>
    <div id="main-btn-whatsapp" class="container">
        <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia!*">
            <i class="fa-brands fa-whatsapp"></i>
        </a>
    </div>
<?php endif ?>
