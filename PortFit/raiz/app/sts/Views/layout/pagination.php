<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<?php if(isset($this->data['pagination'])): ?>
    <div class="pagination">

        <!-- PARA PAGINACAO PARA TRAS -->
        <?php if(isset($this->data['pagination']['prev'])): ?>
            <a href="<?= $this->data['link'] ?>">Primeira</a>

            <?php foreach($this->data['pagination']['prev'] as $prev): ?>
                <a href="<?= $this->data['link'] ?><?= checkGet() ?>page=<?= $prev ?>">
                    <?= $prev ?>
                </a>
            <?php endforeach ?>
        <?php endif ?>
        
        
        <!-- pagina atual -->
        <?php if(isset($this->data['pagination']['current'])): ?>
            <strong><?= $this->data['pagination']['current'] ?></strong>
        <?php endif ?>
        
        
        <!-- PARA PAGINACAO PARA FRENTE CASO HOUVER -->
        <?php if(isset($this->data['pagination']['next'])): ?>
            <?php foreach($this->data['pagination']['next'] as $next): ?>
                <a href="<?= $this->data['link'] ?><?= checkGet() ?>page=<?= $next ?>">
                    <?= $next ?>
                </a>
            <?php endforeach ?>
    
            <a href="<?= $this->data['link'] ?><?= checkGet() ?>page=<?= $this->data['pagination']['last'] ?>">
                Última
            </a>
        <?php endif ?>


    </div><!-- fim div . pagination -->
<?php endif ?>

