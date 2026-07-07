<?php require_once dirname(__DIR__). '/componentes/config.php';?>
<?php require_once dirname(__DIR__). '/componentes/rotas.php';?>
<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>

    <?php $numaula = "Aula - 8 USO DE SESSION";?> 
    
    <!-- nav -->
    <?php require_once APP_COMPONENTES. '/nav.php';?>

    <!-- header -->
    <?php require_once APP_COMPONENTES. '/header.php';?>

       <main>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Uso de $_SESSION</h3>

                    <a class="btn btn-success btn-sm"
                     href="action.php?nomeUser=Junior Lima">
                     Nome Usuário: Junior Lima
                    </a>
                    
                    <a class="btn btn-warning btn-sm"
                     href="action.php?senhaUser=@jr123456">
                     Senha de Usuário: @jr123456
                    </a>
                    
                    <p>
                        <?php 
                        if(!empty($_SESSION ['nomeUser'])){
                            echo $_SESSION ['nomeUser'];
                        }                      

                        ?>
                    </p>
                        

            Senha Encryptada: 
                    <p>
                        <?php 
                        if(!empty($_SESSION ['senhaUser'])){
                            echo $_SESSION ['senhaUser'];
                        }                      

                        ?>




                    </p>

            Senha Decrypitada:
                    <p>
                        <?php
                        if(!empty($_SESSION['senhaUser'])){
                         echo encrypt_secure($_SESSION['senhaUser'],'d');

                        }

                        ?>

                    </p>

                    <h3>Login com autenticção</h3>

                    <a href="paineladimin.php">Painel Adimin</a>

                        <h3 class="mt-5">Login com autenticação</h3>

                <form action="action.php" method="POST" class="card p-4 shadow">

                <div class="mb-3">
                    <label class="form-label">E-mail</label>
                    <input
                        type="email"
                        name="email_login"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input
                        type="password"
                        name="senha_login"
                        class="form-control"
                        placeholder="Digite sua senha"
                        required>
                </div>

                <button class="btn btn-primary">
                    Entrar
                </button>

                </form>

                <?php
                if (!empty($_SESSION['erroLogin'])) {
                echo "<div class='alert alert-danger mt-3'>";
                echo $_SESSION['erroLogin'];
                echo "</div>";

                unset($_SESSION['erroLogin']);
                }
                ?>

                            

                            </div>
                        </div>
                    </div>

        

      </main>
      
    <!-- footer -->
    <?php require_once APP_COMPONENTES. '/footer.php';?>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>