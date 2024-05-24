<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>


</main><!-- Tag main se inicia no arquivo header.php -->

<!-- BTN WHATSSAP -->
<?php if(!isset($this->data['page-login'])): ?>
    <?php require_once(dirname(__FILE__) . '/btnWhatsapp.php'); ?>
<?php endif ?>

<footer>
    <div class="container">

        <!-- //////////////// Logo //////////////// -->
        <div class="row">
            <div class="logo">
                <a href="<?= URL ?>">
                    <img src="<?= URL ?>/assets/img/logo.png" alt="<?= ACADEMY ?>"> Port <span>Fit</span>
                </a>
            </div>
        </div>

        <!-- //////////////// Mapa do site //////////////// -->
        <div class="row">
            <!-- Nossas Aulas -->
            <div class="col">
                <h3>Nossas Aulas</h3>

                <ul>
                    <?php foreach($modalitiesFooter as $modality): ?>
                        <li>
                            <a href="<?= URL ?>/modalidade?key=<?= $modality['id'] ?>">
                                <?= $modality['name'] ?>
                            </a>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>

            <!-- Institucional -->
            <div class="col">
                <h3>Institucional</h3>

                <ul>
                    <li>
                        <a href="<?= URL ?>/contato#contact">Fale Conosco</a>
                    </li>
                    <li>
                        <a href="<?= URL ?>/contato">Localização</a>
                    </li>
                    <li>
                        <a href="<?= URL ?>/blog">Blog</a>
                    </li>
                </ul>
            </div>

            <!-- Corporativo -->
            <div class="col">
                <h3>Corporativo</h3>

                <ul>
                    <li>
                        <a href="<?= URL ?>/admin">Admin</a>
                    </li>
                </ul>
            </div>

            <!-- Redes Sociais -->
            <div class="col-social">
                <h3>Siga a <?= ACADEMY ?></h3>

                <ul class="social">
                    <?php if($social): ?>
                        <?php foreach($social as $soci): ?>
                            <li>
                                <a target="_blank" href="<?= $soci['link'] ?>">
                                    <img src="<?= URL ?>/assets/img/social/<?= $soci['icon'] ?>" alt="<?= $soci['name'] ?>">
                                </a>
                            </li>
                        <?php endforeach ?>
                    <?php endif ?>
                </ul>
            </div>
        </div>

        <!-- //////////////// Contatos //////////////// -->
        <div class="row">
            <!-- Telefone -->
            <div class="col">
                <h3><i class="fa-solid fa-phone"></i> Telefone</h3>

                <ul>
                    <?php if(isset($academy['contact'][0])): ?>
                        <?php foreach($academy['contact'] as $phone): ?>
                            <li>
                                <?= $phone['phone'] ?>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li>
                            Não Informado
                        </li>
                    <?php endif ?>
                </ul>
            </div>

            <!-- WhatsApp -->
            <div class="col">
                <h3><i class="fa-brands fa-whatsapp"></i> WhatsApp</h3>

                <ul>
                    <?php if(isset($academy['contact'][0])): ?>
                        <?php foreach($academy['contact'] as $zap): ?>
                            <li>
                                <?= $zap['whatsapp'] ?>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li>
                            Não Informado
                        </li>
                    <?php endif ?>
                </ul>
            </div>

            <!-- E-Mail -->
            <div class="col">
                <h3><i class="fa-solid fa-envelope"></i> E-Mail</h3>

                <ul>
                    <?php if(isset($academy['contact'][0])): ?>
                        <?php foreach($academy['contact'] as $email): ?>
                            <li>
                                <?= $email['email'] ?>
                            </li>
                        <?php endforeach ?>
                    <?php else: ?>
                        <li>
                            Não Informado
                        </li>
                    <?php endif ?>
                </ul>
            </div>

            <!-- Localizacao -->
            <div class="col">
                <h3><i class="fa-solid fa-location-dot"></i> Loclização</h3>

                <p>
                    <?php if(isset($academy['address']) && isset($academy['road']) && isset($academy['number']) && isset($academy['state']) && isset($academy['uf'])): ?>
                        <?= $academy['address'] ?>, <?= $academy['road'] ?>, <?= $academy['number'] ?> - <?= $academy['state'] ?> - <?= $academy['uf'] ?>
                    <?php else: ?>
                        Não informado
                    <?php endif ?>
                </p>
            </div>
        </div>

        <!-- Direitos autorais -->
        <div class="row">
            <div class="col">
                <p>
                    © Academia fictícia, projeto desenvolvido para Portfólio - <?= date('Y') ?> - Pedro Cesar Costa
                </p>
            </div>
        </div>


    </div><!-- Fim div .container -->
</footer>


<!-- SCRIPT GERAL -->
<script src='<?= URL ?>/assets/js/main.js'></script>


</body>
</html>



