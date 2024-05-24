<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 2) . '/layout/navDashboard.php'); ?>

<!-- CSS EXCLUSIVO DA PAGINA -->
<style>
    /* Menu lateral - marcacao da page */
    #nav-dashboard .menu li:nth-child(2) a {
        color: <?= SECONDARY_COLOR ?> !important;
        background: <?= PRIMARY_COLOR ?> !important;
    }

    #nav-dashboard .menu li:nth-child(2) a i {
        color: <?= SECONDARY_COLOR ?> !important;
    }

    /* Mini nav - marcacao da page */
    .mini-nav-dash ul li:first-child a {
        color: <?= SECONDARY_COLOR ?>;
        background: transparent;
    }
</style>

<!-- TITULO DA PAGINA -->
<div id="title-dash" class="container">
    <h1 class="title">
        <div>
            Academia <span>Informações</span>
        </div>
    </h1>
</div>

<div id="main-academy-information" class="container">
    <!-- NAV DE OPCOES DA ACADEMIA -->
    <nav class="mini-nav-dash">
        <ul>
            <li>
                <a href="<?= URL ?>/dashboard/academia">Informações</a>
            </li>
            <li>
                <a href="<?= URL ?>/dashboard/modalidades">Modalidades</a>
            </li>
            <li>
                <a href="<?= URL ?>/dashboard/precos">Preços</a>
            </li>
        </ul>
    </nav>

    <!-- ///////////////////////////// LOCALIZACAO ///////////////////////////// -->
    <section id="academy-location">
        <h2 class="h2-academy-information">Localização</h2>

        <form class="form-standard" action="<?= URL ?>/dashboard/academia" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="location">

            <!-- Banner -->
            <div class="banner">
                <div id="img-academy" class="img">
                    <?php if(isset($this->data['academy']['banner'])): ?>
                        <img src="<?= URL ?>/assets/img/academy/<?= $this->data['academy']['banner'] ?>">
                    <?php endif ?>
                </div>


                <div class="btn-file">
                    <label for="banner">
                        <i class="fa-regular fa-image"></i> Alterar Banner
                    </label>
                    <input id="banner" type="file" accept="image/*" name="banner">
                </div>
            </div>


            <!-- Endereco -->
            <div class="row start-js">
                <label for="address">Endereço</label>
                <?php if(isset($this->data['academy']['address'])): ?>
                    <input type="text" id="address" name="address" value="<?= $this->data['academy']['address'] ?>">
                <?php else: ?>
                    <input type="text" id="address" name="address">
                <?php endif ?>
            </div>

            <!-- Rua -->
            <div class="row start-js">
                <label for="road">Rua</label>
                <?php if(isset($this->data['academy']['road'])): ?>
                    <input type="text" id="road" name="road" value="<?= $this->data['academy']['road'] ?>">
                <?php else: ?>
                    <input type="text" id="road" name="road">
                <?php endif ?>
            </div>

            <!-- Numero e Cep -->
            <div class="row number-cep">
                <div class="number start-js">
                    <label for="number">N°</label>
                    <?php if(isset($this->data['academy']['number'])): ?>
                        <input type="text" id="number" name="number" value="<?= $this->data['academy']['number'] ?>">
                    <?php else: ?>
                        <input type="text" id="number" name="number">
                    <?php endif ?>
                </div>

                <div class="cep start-js">
                    <label for="cep">CEP</label>
                    <?php if(isset($this->data['academy']['cep'])): ?>
                        <input type="text" id="cep" name="cep" value="<?= $this->data['academy']['cep'] ?>">
                    <?php else: ?>
                        <input type="text" id="cep" name="cep">
                    <?php endif ?>
                </div>
            </div>

            <!-- Estado e UF -->
            <div class="row state-uf">
                <div class="state start-js">
                    <label for="state">Estado</label>
                    <?php if(isset($this->data['academy']['state'])): ?>
                        <input type="text" id="state" name="state" value="<?= $this->data['academy']['state'] ?>">
                    <?php else: ?>
                        <input type="text" id="state" name="state">
                    <?php endif ?>
                </div>

                <div class="uf start-js">
                    <label for="uf">UF</label>
                    <?php if(isset($this->data['academy']['uf'])): ?>
                        <input type="text" id="uf" name="uf" value="<?= $this->data['academy']['uf'] ?>">
                    <?php else: ?>
                        <input type="text" id="uf" name="uf">
                    <?php endif ?>
                </div>
            </div>

            <!-- Google Maps -->
            <div class="row start-js">
                <label for="map">Google Mapa</label>
                <?php if(isset($this->data['academy']['map'])): ?>
                    <textarea name="map" id="map" cols="100" rows="10"><?= $this->data['academy']['map'] ?></textarea>
                <?php else: ?>
                    <textarea name="map" id="map" cols="100" rows="10"></textarea>
                <?php endif ?>
            </div>

            <button class="btn-standard-form">Salvar</button>

        </form>
    </section>

    <!-- ///////////////////////////// CONTATO ///////////////////////////// -->
    <section id="academy-contact">
        <h2 class="h2-academy-information">Contato</h2>

        <form class="form-standard" action="<?= URL ?>/dashboard/academia#academy-contact" method="POST">
            <input type="hidden" name="contact">

            <!-- Id da unidade -->
            <?php if(isset($this->data['contact']['id'])): ?>
                <input type="hidden" name="contact-id" value="<?= $this->data['contact']['id'] ?>">
            <?php endif ?>


            <!-- Telefone -->
            <div class="row ddd-phone">
                <div class="ddd start-js">
                    <label for="ddd">DDD</label>
                    <?php if(isset($this->data['contact']['ddd'])): ?>
                        <input type="number" id="ddd" name="ddd" value="<?= $this->data['contact']['ddd'] ?>">
                    <?php else: ?>
                        <input type="number" id="ddd" name="ddd">
                    <?php endif ?>
                </div>

                <div class="phone start-js">
                    <label for="phone">Telefone</label>
                    <?php if(isset($this->data['contact']['phone'])): ?>
                        <input type="number" id="phone" name="phone" value="<?= $this->data['contact']['phone'] ?>">
                    <?php else: ?>
                        <input type="number" id="phone" name="phone">
                    <?php endif ?>
                </div>
            </div>

            <!-- WhatSapp -->
            <div class="row ddd-phone">
                <div class="ddd start-js">
                    <label for="dddSapp">DDD</label>
                    <?php if(isset($this->data['contact']['dddSapp'])): ?>
                        <input type="nunber" id="dddSapp" name="dddSapp" value="<?= $this->data['contact']['dddSapp'] ?>">
                    <?php else: ?>
                        <input type="nunber" id="dddSapp" name="dddSapp">
                    <?php endif ?>
                </div>

                <div class="phone start-js">
                    <label for="whatsapp">WhatSapp</label>
                    <?php if(isset($this->data['contact']['whatsapp'])): ?>
                        <input type="nunber" id="whatsapp" name="whatsapp" value="<?= $this->data['contact']['whatsapp'] ?>">
                    <?php else: ?>
                        <input type="nunber" id="whatsapp" name="whatsapp">
                    <?php endif ?>
                </div>
            </div>

            <!-- E-Mial -->
            <div class="row start-js">
                <label for="email">E-Mail</label>
                <?php if(isset($this->data['contact']['email'])): ?>
                    <input type="text" id="email" name="email" value="<?= $this->data['contact']['email'] ?>">
                <?php else: ?>
                    <input type="text" id="email" name="email">
                <?php endif ?>
            </div>


            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>

    <!-- ///////////////////////////// HORARIOS ///////////////////////////// -->
    <section id="academy-time">
        <h2 class="h2-academy-information">Horários</h2>

        <form action="<?= URL ?>/dashboard/academia#academy-time" method="POST">
            <input type="hidden" name="time">


            <div class="row">
                <!-- SEMANA -->
                <div class="col">
                    <label>Segunda a Sexta</label>

                    <div class="time">
                        <?php if(isset($this->data['academy']['openHourWeek'])): ?>
                            <input type="number" name="openHourWeek" value="<?= $this->data['academy']['openHourWeek'] ?>" placeholder="Hora"> <span class="point">:</span> 
                            <input type="number" name="openMinuteWeek" value="<?= $this->data['academy']['openMinuteWeek'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="openHourWeek" placeholder="Hora"> : 
                            <input type="number" name="openMinuteWeek" placeholder="Min">
                        <?php endif ?>

                        <span>-</span>

                        <?php if(isset($this->data['academy']['closeHourWeek'])): ?>
                            <input type="number" name="closeHourWeek" value="<?= $this->data['academy']['closeHourWeek'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="closeMinuteWeek" value="<?= $this->data['academy']['closeMinuteWeek'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="closeHourWeek" placeholder="Hora"> : 
                            <input type="number" name="closeMinuteWeek" placeholder="Min">
                        <?php endif ?>
                    </div><!-- Fim div .time -->
                </div><!-- Fim div .col -->

                
                <!-- FERIADOS -->
                <div class="col">
                    <label>Feriados</label>

                    <div class="time">
                        <!-- Semana -->
                        <?php if(isset($this->data['academy']['openHourHoliday'])): ?>
                            <input type="number" name="openHourHoliday" value="<?= $this->data['academy']['openHourHoliday'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="openMinuteHoliday" value="<?= $this->data['academy']['openMinuteHoliday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="openHourHoliday" placeholder="Hora"> : 
                            <input type="number" name="openMinuteHoliday" placeholder="Min">
                        <?php endif ?>

                        <span>-</span>

                        <?php if(isset($this->data['academy']['closeHourHoliday'])): ?>
                            <input type="number" name="closeHourHoliday" value="<?= $this->data['academy']['closeHourHoliday'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="closeMinuteHoliday" value="<?= $this->data['academy']['closeMinuteHoliday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="closeHourHoliday" placeholder="Hora"> : 
                            <input type="number" name="closeMinuteHoliday" placeholder="Min">
                        <?php endif ?>
                    </div><!-- Fim div .time -->
                </div><!-- Fim div .col -->
            </div><!-- Fim div .row -->


            <div class="row">
                <!-- SABADO -->
                <div class="col">
                    <label>Sábado</label>

                    <div class="time">
                        <?php if(isset($this->data['academy']['openHourSaturday'])): ?>
                            <input type="number" name="openHourSaturday" value="<?= $this->data['academy']['openHourSaturday'] ?>" placeholder="Hora"> <span class="point">:</span> 
                            <input type="number" name="openMinuteSaturday" value="<?= $this->data['academy']['openMinuteSaturday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="openHourSaturday" placeholder="Hora"> : 
                            <input type="number" name="openMinuteSaturday" placeholder="Min">
                        <?php endif ?>

                        <span>-</span>

                        <?php if(isset($this->data['academy']['closeHourSaturday'])): ?>
                            <input type="number" name="closeHourSaturday" value="<?= $this->data['academy']['closeHourSaturday'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="closeMinuteSaturday" value="<?= $this->data['academy']['closeMinuteSaturday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="closeHourSaturday" placeholder="Hora"> : 
                            <input type="number" name="closeMinuteSaturday" placeholder="Min">
                        <?php endif ?>
                    </div><!-- Fim div .time -->
                </div><!-- Fim div .col -->

                
                <!-- DOMINGO -->
                <div class="col">
                    <label>Domingo</label>

                    <div class="time">
                        <!-- Semana -->
                        <?php if(isset($this->data['academy']['openHourSunday'])): ?>
                            <input type="number" name="openHourSunday" value="<?= $this->data['academy']['openHourSunday'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="openMinuteSunday" value="<?= $this->data['academy']['openMinuteSunday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="openHourSunday" placeholder="Hora"> : 
                            <input type="number" name="openMinuteSunday" placeholder="Min">
                        <?php endif ?>

                        <span>-</span>

                        <?php if(isset($this->data['academy']['closeHourSunday'])): ?>
                            <input type="number" name="closeHourSunday" value="<?= $this->data['academy']['closeHourSunday'] ?>" placeholder="Hora"> <span class="point">:</span>  
                            <input type="number" name="closeMinuteSunday" value="<?= $this->data['academy']['closeMinuteSunday'] ?>" placeholder="Min">
                        <?php else: ?>
                            <input type="number" name="closeHourSunday" placeholder="Hora"> : 
                            <input type="number" name="closeMinuteSunday" placeholder="Min">
                        <?php endif ?>
                    </div><!-- Fim div .time -->
                </div><!-- Fim div .col -->
            </div><!-- Fim div .row -->

            <button class="btn-standard-form">Salvar</button>
        </form>
    </section>


    <!-- ///////////////////////////// FOTOS ///////////////////////////// -->
    <section id="academy-photos">
        <h2 class="h2-academy-information">Fotos</h2>

        <div class="photos">
            <?php if(isset($this->data['photos'])): ?>
                <?php foreach($this->data['photos'] as $photo): ?>
                    <div class="photo" style="background-image: url(<?= URL ?>/assets/img/academy/<?= $photo['name'] ?>);">
                        <button class="btn-trash-photo"><i class="fa-solid fa-trash"></i></button>
    
                        
                        <!-- Overlay de confirmacao -->
                        <div class="overlay close-overlay">
                            <div class="main-box close-box">
                                <h2>Deseja excluir imagem?</h2>
        
                                <div class="box">
                                    <button class="btn-close-overlay">
                                        <i class="fa-solid fa-angle-left"></i> Voltar
                                    </button>
                                    
    
                                    <img src="<?= URL ?>/assets/img/academy/<?= $photo['name'] ?>">
    
    
                                    <form action="<?= URL ?>/dashboard/academia#academy-photos" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="delete-photo">
                                        <input type="hidden" name="id" value="<?= $photo['id'] ?>">
    
                                        <button class="btn-standard-form">Excluir</button>
                                    </form>
        
                                </div>
                            </div>
                        </div><!-- Fim div .overlay -->
                    </div><!-- Fim div .photo -->
                <?php endforeach ?>
            <?php endif ?>


            <!-- BTN de add imagens -->
            <button id="add-photo">
                + Adicionar
            </button>

            <div id="overlay-add-photos">
                <!-- Overlay de add photo -->
                <div class="overlay close-overlay">
                    <div class="main-box close-box">
                        <h2>Adicionar fotos - <span>jpg <small>ou</small> png</span></h2>
    
                        <div class="box">
                            <button class="btn-close-overlay">
                                <i class="fa-solid fa-angle-left"></i> Voltar
                            </button>

                            <form action="<?= URL ?>/dashboard/academia#academy-photos" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="photo">

                                <div class="btn-file">
                                    <label for="btn-photos">
                                        <i class="fa-regular fa-image"></i> Selecionar imagens
                                    </label>
                                    <input id="btn-photos" type="file" accept="image/*" name="photos[]" multiple="multiple">
                                </div>

                                <!-- Div que recebe as imagens do preview -->
                                <div class="preview-photos"></div>

                                <button class="btn-standard-form">Salvar</button>
                            </form>
    
                        </div>
                    </div>
                </div><!-- Fim div .overlay -->
            </div>

        </div><!-- Fim div .photos -->
    </section>


    <!-- ///////////////////////////// REDES SOCIAIS ///////////////////////////// -->
    <section id="academy-socials">
        <h2 class="h2-academy-information">Redes Sociais</h2>

        <div id="socials">
            <button id="btn-add-social">+ Adicionar</button>

            <!-- Overlay de ADD Social -->
            <div class="overlay close-overlay">
                <div class="main-box close-box">
                    <h2>Adicionar rede social</h2>
    
                    <div class="box">
                        <button class="btn-close-overlay">
                            <i class="fa-solid fa-angle-left"></i> Voltar
                        </button>

                        <form class="form-standard form-add-social" action="<?= URL ?>/dashboard/academia#academy-socials" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="social">
                            <?php if(isset($this->data['academy']['id'])): ?>
                                <input type="hidden" name="academy-id" value="<?= $this->data['academy']['id'] ?>">
                            <?php endif ?>

                            <!-- Icone -->
                            <div class="btn-file-social">
                                <label id="label-icon-social" for="btn-icon-social">
                                    <i class="fa-regular fa-image"></i> 
                                    <p>*Icone (png)</p>
                                </label>
                                <input id="btn-icon-social" type="file" accept="image/*" name="icon" multiple="multiple">
                            </div>

                            <!-- Nome -->
                            <div id="input-name" class="row start-js">
                                <label for="social-name">*Nome</label>
                                <input id="social-name" type="text" name="name">
                            </div>

                            <!-- Link -->
                            <div id="input-link" class="row start-js">
                                <label for="social-link">*Link</label>
                                <input id="social-link" type="text" name="link">
                            </div>

                            <button class="btn-standard-form">Salvar</button>
                        </form>
                    </div>
                </div>
            </div><!-- Fim div .overlay -->

            <?php if(isset($this->data['social'])): ?>
                <?php foreach($this->data['social'] as $socialDash): ?>
                    <div class="social-dash">
                        <img src="<?= URL ?>/assets/img/social/<?= $socialDash['icon'] ?>" alt="<?= $socialDash['name'] ?>">
    
                        <h3><?= $socialDash['name'] ?></h3>
    
                        <div class="btns">
                            <button class="btn-alter"><i class="fa-solid fa-pencil"></i></button>
                            <button class="btn-delete"><i class="fa-solid fa-trash"></i></button>
                        </div>
    
                        <!-- Overlay de ALTERAR Social -->
                        <div class="overlay overlay-alter close-overlay">
                            <div class="main-box close-box">
                                <h2>Alterar rede social</h2>
                
                                <div class="box">
                                    <button class="btn-close-overlay">
                                        <i class="fa-solid fa-angle-left"></i> Voltar
                                    </button>
    
                                    <form class="form-standard form-add-social" action="<?= URL ?>/dashboard/academia#academy-socials" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="update-social">
                                        <input class="id-social" type="hidden" name="id" value="<?= $socialDash['id'] ?>">
    
                                        <!-- Icone -->
                                        <div class="btn-file-social">
                                            <label id="label-icon-social-<?= $socialDash['id'] ?>" for="btn-icon-social-<?= $socialDash['id'] ?>">
                                                <img src="<?= URL ?>/assets/img/social/<?= $socialDash['icon'] ?>" alt="<?= $socialDash['name'] ?>">
                                            </label>
                                            <input id="btn-icon-social-<?= $socialDash['id'] ?>" type="file" accept="image/*" name="icon" multiple="multiple">
                                        </div>
    
                                        <!-- Nome -->
                                        <div id="input-name-<?= $socialDash['id'] ?>" class="row start-js input-name-update-js">
                                            <label for="social-name-<?= $socialDash['id'] ?>">*Nome</label>
                                            <input id="social-name-<?= $socialDash['id'] ?>" type="text" name="name" value="<?= $socialDash['name'] ?>">
                                        </div>
    
                                        <!-- Link -->
                                        <div id="input-link-<?= $socialDash['id'] ?>" class="row start-js input-link-update-js">
                                            <label for="social-link-<?= $socialDash['id'] ?>">*Link</label>
                                            <input id="social-link-<?= $socialDash['id'] ?>" type="text" name="link" value="<?= $socialDash['link'] ?>">
                                        </div>
    
                                        <button class="btn-standard-form">Alterar</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- Fim div .overlay -->
    
                        <!-- Overlay de EXLUIR Social -->
                        <div class="overlay overlay-delete close-overlay">
                            <div class="main-box close-box">
                                <h2>Deseja excluir <span><?= $socialDash['name'] ?>?</span></h2>
                
                                <div class="box">
                                    <button class="btn-close-overlay">
                                        <i class="fa-solid fa-angle-left"></i> Voltar
                                    </button>
    
                                    <form class="form-standard form-add-social" action="<?= URL ?>/dashboard/academia#academy-socials" method="POST" enctype="multipart/form-data">
                                        <input type="hidden" name="delete-social">
                                        <input type="hidden" name="id" value="<?= $socialDash['id'] ?>">
    
    
                                        <div class="mini-box">
                                            <!-- Icone -->
                                            <img src="<?= URL ?>/assets/img/social/<?= $socialDash['icon'] ?>" alt="<?= $socialDash['name'] ?>">
        
                                            <!-- Nome -->
                                            <h3><?= $socialDash['name'] ?></h3>
                                        </div>
    
                                        <button class="btn-standard-form">Excluir</button>
                                    </form>
                                </div>
                            </div>
                        </div><!-- Fim div .overlay -->
                    </div><!-- Fim div .social -->
                <?php endforeach ?>
            <?php endif ?>
            
        </div><!-- Fim div #socials -->
    </section>

</div><!-- main-academy-information -->



<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/dashboard/academyInformation.js"></script>

<script>
    previewIMG('#banner', '#img-academy')
    formLabelInput('#academy-location form')
    formLabelInput('#academy-contact form')
    previewImages('#btn-photos', '#overlay-add-photos .preview-photos')
    formLabelInput('#academy-socials form')
    previewIMG('#btn-icon-social', '#label-icon-social')
</script>
