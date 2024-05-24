<?php require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); ?>

<section id="login" class="container">
    <h1 class="title">
        <div>
            Área <span>administrativa</span>
        </div>
    </h1>

    <form action="<?= URL ?>/admin" method="POST">
        <div>
            <?php if(isset($_SESSION['return-email'])): ?>
                <input class="email" type="email" name="email" value="<?= $_SESSION['return-email'] ?>" placeholder="E-Mail">
            <?php else: ?>
                <input class="email" type="email" name="email" placeholder="E-Mail">
            <?php endif ?>
        </div>

        <div>
            <input class="password" type="password" name="password" placeholder="Senha">
        </div>

        <button>Entrar</button>
    </form>

    <p>
        Esqueceu sua senha? <a href="<?= URL ?>/admin/recuperarsenha">Clique aqui</a>
    </p>
</section>


<!-- Removendo $_sessino['return-email'] caso houver -->
<?php unset($_SESSION['return-email']) ?>


<!-- SCRIPTS -->
<script src="<?= URL ?>/assets/js/form.js"></script>
<script src="<?= URL ?>/assets/js/login.js"></script>

<script>
    login()
</script>

