<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/helpers/Cookie.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/functions/AcademyFunctions.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/sts/Controllers/AllPages/AcademyContact.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/functions/SocialFunctions.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/sts/Controllers/AllPages/Social.php'); ?>
<?php require_once(dirname(__FILE__, 4) . '/sts/Controllers/AllPages/Modality.php'); ?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Port Fit</title>

    <!-- Bibliotecas -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= URL ?>/assets/lib/slick/slick.css">
    <link rel="stylesheet" href="<?= URL ?>/assets/lib/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="<?= URL ?>/assets/lib/wow/style.css" />

    <!-- Icone -->
    <link rel="shortcut icon" href="<?= URL ?>/assets/img/icon.png" type="image/x-icon">

    <!-- Fontes -->
    <link rel="stylesheet" href="<?= URL ?>/assets/font/roboto.css">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= URL ?>/assets/css/main.css">

    <!-- JQUERY -->
    <script src='<?= URL ?>/assets/lib/jquery/jquery.js'></script>
    <!-- CARROUSEL SLICK -->
    <script src="<?= URL ?>/assets/lib/slick/slick.min.js"></script>
</head>
<body>

<!-- LOADING -->
<div id="loading">
    <img src="<?= URL ?>/assets/img/loading.svg" alt="loading">
</div>


<header>
    <div class="container">
        <!-- LOGO -->
        <div class="logo">
            <?php if(isset($this->data['title-dash'])): ?>
                <a href="<?= URL ?>/dashboard">
                    DASH <span>BOARD</span>
                </a>
            <?php elseif(isset($this->data['title-student'])): ?>
                <a href="<?= URL ?>/aluno">
                    Área do <span>Aluno</span>
                </a>
            <?php else: ?>
                <a href="<?= URL ?>">
                    <img src="<?= URL ?>/assets/img/logo.png" alt="<?= ACADEMY ?>"> Port <span>Fit</span>
                </a>
            <?php endif ?>
                
        </div><!-- Fim div #logo -->

        <!-- BTN NAV MOBILE -->
        <div id="btn-nav-mobile">
            <button><i class="fa-solid fa-bars"></i></button>
        </div>

        <div id="nav" class="open-nav-mobile">
            <!-- PESQUISA -->
            <?php if(!isset($this->data['title-dash']) && !isset($this->data['title-student'])): ?>
                <div id="search">
                    <form action="<?= URL ?>/blog" method="GET">
                        <input type="text" name="search" placeholder="Pesquisar">
                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            <?php endif ?>
    
            <!-- NAV -->
            <div id="menu">
                <nav>
                    <ul>
                        <li><a href="<?= URL ?>">Home</a></li>
                        <?php if(!isset($this->data['title-dash']) && !isset($this->data['title-student'])): ?>
                            <li><a href="<?= URL ?>/modalidades">Modalidades</a></li>
                            <li><a href="<?= URL ?>/contato">Contato</a></li>
                            <li><a href="<?= URL ?>/blog">Blog</a></li>
                        <?php endif ?>
    
    
                        <?php if(isset($_SESSION['employee'])): ?>
                        <!-- FOTO E NOME DO FUNCIONARIO QUANDO LOGADO -->
                            <li>
                                <a class="profile" href="<?= URL ?>/dashboard">
                                    <div class="my-photo">
                                        <?php if($_SESSION['employee']['photo']): ?>
                                            <img src="<?= URL ?>/assets/img/employees/<?= $_SESSION['employee']['photo'] ?>">
                                        <?php else: ?>
                                                <img src="<?= URL ?>/assets/img/user.png">
                                        <?php endif ?>
                                    </div> 
                                    <?= $_SESSION['employee']['first_name'] ?>
                                </a>
                            </li>
                            
                        <!-- FOTO E NOME DO ALUNO QUANDO LOGADO -->
                        <?php elseif(isset($_SESSION['student'])): ?>
                            <li>
                                <a class="profile" href="<?= URL ?>/dashboard">
                                    <div class="my-photo">
                                        <?php if($_SESSION['student']['photo']): ?>
                                            <img src="<?= URL ?>/assets/img/students/<?= $_SESSION['student']['photo'] ?>">
                                        <?php else: ?>
                                                <img src="<?= URL ?>/assets/img/user.png">
                                        <?php endif ?>
                                    </div> 
                                    <?= $_SESSION['student']['first_name'] ?>
                                </a>
                            </li>
                        <?php endif ?>
    
    
                        <?php if(!isset($_SESSION['employee']) && !isset($_SESSION['student'])): ?>
                            <li><a class="login" href="<?= URL ?>/login">Login</a></li>
                        <?php else: ?>
                            <li><a class="logout" href="<?= URL ?>/logout">Sair</a></li>
                        <?php endif ?>
    
    
                    </ul>
                </nav>
            </div><!-- Fim div #menu -->
        </div><!-- Fim div #nav -->

    </div>
</header>

<!-- MENSAGEM DE ALERTA -->
<?php if(isset($_SESSION['msg'])): ?>
    <div class="message-alert <?= $_SESSION['msg-type'] ?>">
        <p><?= $_SESSION['msg'] ?></p>
    </div>

    <?php
        unset($_SESSION['msg']);
        unset($_SESSION['msg-type']);
    ?>
<?php endif ?>

<main><!-- Tag main se encerra no arquivo footer.php -->

