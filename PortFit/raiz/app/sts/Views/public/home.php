<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    #nav nav ul li:first-child a {
        color: <?= SECONDARY_COLOR ?>;
    }
</style>

<!-- ///////////////////// SLIDE ///////////////////// -->
<?php if($this->data['slide']): ?>
    <section id="slide">
        <ul>
            <?php foreach($this->data['slide'] as $slide): ?>
                <li style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $slide['banner'] ?>);">
                    <div>
                        <h1><?= $slide['name'] ?></h1>
                        <p><?= $slide['phrase'] ?></p>
                        <a href="<?= URL ?>/modalidade?key=<?= $slide['id'] ?>">Saiba Mais</a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
    </section>
<?php endif ?>

<!-- ///////////////////// ENDERECO ///////////////////// -->
<section id="address-common">
    <h1 class="container">
        <?php if(isset($academy['state']) && isset($academy['uf'])): ?>
            Academia <br>
            <span>
                <?= $academy['state'] ?>, <?= $academy['uf'] ?>
            </span>
        <?php endif ?>
    </h1>

    <div class="row">
        <!-- FOTO DA ACADEMIA -->
        <div class="banner" style="background-image: url(<?= URL ?>/assets/img/academy/<?= $academy['banner'] ?>);">
            <div class="bar"></div>
        </div>

        <!-- INFORMACOES DA ACADEMIA -->
        <div class="address">
            <!-- HORARIOS -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-regular fa-clock"></i>
                </div>
    
                <div class="col">
                    <h2>Horário de funcionamento</h2>
    
                    <div class="time">
                        <div class="col-1">
                            <p>Seg a Sex</p>
                            <p>Feriado</p>
                            <p>Sábado</p>
                            <p>Domingo</p>
                        </div>
    
                        <div class="col-1">
                            <?php if(isset($academy['timeWeek']) && isset($academy['timeHoliday']) && isset($academy['timeSaturday']) && isset($academy['timeSunday'])): ?>
                                <p><?= $academy['timeWeek'] ?></p>
                                <p><?= $academy['timeHoliday'] ?></p>
                                <p><?= $academy['timeSaturday'] ?></p>
                                <p><?= $academy['timeSunday'] ?></p>
                                <?php else: ?>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <p>Não informado</p>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONATTO -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-solid fa-address-book"></i>
                </div>

                <div class="col">
                    <h2>Contato</h2>

                    <div class="col-1">
                        <?php if(isset($academy['contact'][0])): ?>
                            <p>Telefone: <?= $academy['contact'][0]['phone'] ?></p>
                            <p>WhatsApp: <?= $academy['contact'][0]['whatsapp'] ?></p>
                            <p>E-Mail: <?= $academy['contact'][0]['email'] ?></p>
                        <?php else: ?>
                            <p>Não informado</p>
                        <?php endif ?>
                    </div>
                </div>
            </div>

            <!-- ENDERECO -->
            <div class="row-1">
                <div class="col">
                    <i class="fa-solid fa-location-dot"></i>
                </div>

                <div class="col">
                    <h2>Endereço</h2>

                    <div class="col-1">
                        <p>
                            <?php if(isset($academy['address']) && isset($academy['road']) && isset($academy['number']) && isset($academy['state']) && isset($academy['uf'])): ?>
                                <?= $academy['address'] ?>, <?= $academy['road'] ?>, <?= $academy['number'] ?> - <?= $academy['state'] ?> - <?= $academy['uf'] ?>
                            <?php else: ?>
                                Não informado
                            <?php endif ?>
                        </p>
                    </div>
                </div>
            </div>

            <!-- BTN MAPA -->
            <a href="<?= URL ?>/contato#google-map">Veja no mapa</a>

        </div><!-- Fim div .address -->
    </div><!-- Fim div .row -->
</section>


<!-- ///////////////////// MODALIDADES ///////////////////// -->
<?php if(isset($this->data['modalities'])): ?>
    <section id="home-modality">
        <h1 class="title">
            <div>
                Modalidades <span><?= ACADEMY ?></span>
            </div>
        </h1>
    
        <div class="modalities">
            <?php foreach($this->data['modalities'] as $modality): ?>
                <div class="box-main" style="background-image: url(<?= URL ?>/assets/img/modalities/<?= $modality['banner'] ?>);">
                    <div class="box">
                        <h2><?= $modality['name'] ?></h2>
        
                        <div class="summary">
                            <p><?= $modality['summary'] ?></p>
                            <a href="<?= URL ?>/modalidade?key=<?= $modality['id'] ?>">Saiba Mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>


<!-- ///////////////////// BLOG ///////////////////// -->
<?php if(isset($this->data['blog'])): ?>
    <section id="home-blog">
        <h1 class="title">
            <div>
                Dicas de <span>treino</span> e <span>alimentação</span>
            </div>
        </h1>
    
        <div class="row">
            <?php foreach($this->data['blog'] as $blog): ?>
                <div class="col">
                    <div class="banner" style="background-image: url(<?= URL ?>/assets/img/blog/<?= $blog['banner'] ?>);">
                    </div>
    
                    <div class="box">
                        <h2><?= $blog['title'] ?></h2>    
                        <p><?= $blog['summary'] ?></p>    
                        <a href="<?= URL ?>/blog/post?key=<?= $blog['id'] ?>">Leia Mais</a>
                    </div>
    
                </div>
            <?php endforeach ?>
            
            <a href="<?= URL ?>/blog" class="btn-more-tips">Veja mais dicas aqui!</a>
        </div>
    </section>
<?php endif ?>


<!-- ///////////////////// ALUNO ///////////////////// -->
<section id="home-student">
    <!-- infomacao -->
    <div class="col">
        <h1>Com avaliação física o aluno <?= ACADEMY ?> tem:</h1>

        <ul>
            <li>Acesso a área exclusiva do aluno no site</li>
            <li>Acompanhamento de evolução</li>
            <li>Treino montado exclusivo para você</li>
            <li>Dieta montada exclusiva para você</li>
        </ul>

        <div class="link">
            <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de agendar uma avaliação física.*">
                Agendar Avaliação
            </a>
        </div>
    </div>

    <!-- banner -->
    <div class="col">
        <img src="<?=  URL?>/assets/img/bannerStudent.png">
    </div>
</section>


<!-- ///////////////////// PRECOS ///////////////////// -->
<?php if(isset($this->data['prices']) || isset($this->data['priceEmphasis'])): ?>
    <section id="home-price">
        <h1 class="title">
            <div>
                Conheça nossos <span>planos</span>
            </div>
        </h1>

        <div class="price-main">
            <!-- Define quantos preco ira mostrar no carrossel 4 ou 3 -->
            <input id="amount-price" type="hidden" value="<?= $this->data['amount-price'] ?>">

            <!-- PRECO DESTACADO -->
            <?php if(isset($this->data['priceEmphasis'])): ?>
                <div class="emphasis">
                    <div class="information">
                        <p>Preço em destaque</p>
                    </div>

                    <div class="row-1">
                        <div class="flat <?= $this->data['priceEmphasis']['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $this->data['priceEmphasis']['icon'] ?>);">
                            <?php if($this->data['priceEmphasis']['month']): ?>
                                <p><?= $this->data['priceEmphasis']['time'] ?>M</p>
                            <?php else: ?>
                                <p><?= $this->data['priceEmphasis']['time'] ?></p>
                            <?php endif ?>
                        </div>
                        
                        <h2><?= $this->data['priceEmphasis']['name'] ?></h2>

                        <p>R$<span><?= $this->data['priceEmphasis']['real'] ?></span>,<?= $this->data['priceEmphasis']['penny'] ?></p>
                    </div><!-- Fim div .row-1 -->

                    <!-- pordutos relacionados ao preco -->
                    <div class="schemes">
                        <ul>
                            <?php foreach($this->data['priceEmphasis']['schemes'] as $scheme): ?>
                                <li><i class="fa-solid fa-check"></i> <?= $scheme['scheme'] ?></li>
                            <?php endforeach ?>
                        </ul>
                    </div>

                    <!-- Link -->
                    <div class="link">
                        <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de mais detalhes sobre o plano <?= $this->data['priceEmphasis']["name"] ?> de R$<?= $this->data['priceEmphasis']["price"] ?>.*">Entrar em contato</a>
                    </div>
                </div><!-- Fim div .emphasis -->
            <?php endif ?>

            <!-- PRECOS NORMAIS -->
            <?php if(isset($this->data['prices'])): ?>
                <div class="prices <?= $this->data['carousel-class'] ?>">

                    <?php foreach($this->data['prices'] as $price): ?>
                        <div class="all-prices">
                            <div class="row-1">
                                <div class="flat <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                    <?php if($price['month']): ?>
                                        <p><?= $price['time'] ?>M</p>
                                    <?php else: ?>
                                        <p><?= $price['time'] ?></p>
                                    <?php endif ?>
                                </div>

                                <h2><?= $price['name'] ?></h2>

                                <p>R$<span><?= $price['real'] ?></span>,<?= $price['penny'] ?></p>
                            </div><!-- Fim div .row-1 -->

                            <!-- pordutos relacionados ao preco -->
                            <div class="schemes">
                                <ul>
                                    <?php foreach($price['schemes'] as $scheme): ?>
                                        <li><i class="fa-solid fa-check"></i> <?= $scheme['scheme'] ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>

                            <!-- Link -->
                            <div class="link">
                                <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de mais detalhes sobre o plano <?= $price["name"] ?> de R$<?= $price["price"] ?>.*">Entrar em contato</a>
                            </div>

                        </div><!-- Fim div .all-prices -->
                    <?php endforeach ?>

                </div><!-- Fim div .prices -->
            <?php endif ?>


        </div><!-- Fim div .price-main -->
    </section>



    <section id="home-price-mobile">
        <h1 class="title">
            <div>
                Conheça nossos <span>planos</span>
            </div>
        </h1>

        <div class="price-main">
            <!-- Define quantos preco ira mostrar no carrossel 4 ou 3 -->
            <input id="amount-price" type="hidden" value="<?= $this->data['amount-price'] ?>">

            

            <!-- No mobile o preco destacado tambem entra no carrossel com os preco normais -->
            <?php if(isset($this->data['prices'])): ?>
                <div class="prices <?= $this->data['carousel-class'] ?>">

                    <!-- PRECO DESTACADO -->
                    <?php if(isset($this->data['priceEmphasis'])): ?>
                        <div class="emphasis">
                            <div class="information">
                                <p>Preço em destaque</p>
                            </div>

                            <div class="row-1">
                                <div class="flat <?= $this->data['priceEmphasis']['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $this->data['priceEmphasis']['icon'] ?>);">
                                    <?php if($this->data['priceEmphasis']['month']): ?>
                                        <p><?= $this->data['priceEmphasis']['time'] ?>M</p>
                                    <?php else: ?>
                                        <p><?= $this->data['priceEmphasis']['time'] ?></p>
                                    <?php endif ?>
                                </div>
                                
                                <h2><?= $this->data['priceEmphasis']['name'] ?></h2>

                                <p>R$<span><?= $this->data['priceEmphasis']['real'] ?></span>,<?= $this->data['priceEmphasis']['penny'] ?></p>
                            </div><!-- Fim div .row-1 -->

                            <!-- pordutos relacionados ao preco -->
                            <div class="schemes">
                                <ul>
                                    <?php foreach($this->data['priceEmphasis']['schemes'] as $scheme): ?>
                                        <li><i class="fa-solid fa-check"></i> <?= $scheme['scheme'] ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>

                            <!-- Link -->
                            <div class="link">
                                <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de mais detalhes sobre o plano <?= $this->data['priceEmphasis']["name"] ?> de R$<?= $this->data['priceEmphasis']["price"] ?>.*">Entrar em contato</a>
                            </div>
                        </div><!-- Fim div .emphasis -->
                    <?php endif ?>


                    <!-- PRECOS NORMAIS -->
                    <?php foreach($this->data['prices'] as $price): ?>
                        <div class="all-prices">
                            <div class="row-1">
                                <div class="flat <?= $price['class'] ?>" style="background-image: url(<?= URL ?>/assets/img/<?= $price['icon'] ?>);">
                                    <?php if($price['month']): ?>
                                        <p><?= $price['time'] ?>M</p>
                                    <?php else: ?>
                                        <p><?= $price['time'] ?></p>
                                    <?php endif ?>
                                </div>

                                <h2><?= $price['name'] ?></h2>

                                <p>R$<span><?= $price['real'] ?></span>,<?= $price['penny'] ?></p>
                            </div><!-- Fim div .row-1 -->

                            <!-- pordutos relacionados ao preco -->
                            <div class="schemes">
                                <ul>
                                    <?php foreach($price['schemes'] as $scheme): ?>
                                        <li><i class="fa-solid fa-check"></i> <?= $scheme['scheme'] ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>

                            <!-- Link -->
                            <div class="link">
                                <a target="_blank" href="https://wa.me/<?= $academy['btnSapp'] ?>?text=*Olá, Bom dia! gostaria de mais detalhes sobre o plano <?= $price["name"] ?> de R$<?= $price["price"] ?>.*">Entrar em contato</a>
                            </div>

                        </div><!-- Fim div .all-prices -->
                    <?php endforeach ?>

                </div><!-- Fim div .prices -->
            <?php endif ?>


        </div><!-- Fim div .price-main -->
    </section>
<?php endif ?>


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/home.js"></script>