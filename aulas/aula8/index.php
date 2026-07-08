<?php require_once dirname(__DIR__) . '/componentes/config.php'; ?>
<?php require_once dirname(__DIR__) . '/componentes/rotas.php'; ?>
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

    <?php $numaula = "Aula - 8 USO DE SESSION"; ?>

    <!-- nav -->
    <?php require_once APP_COMPONENTES . '/nav.php'; ?>

    <!-- header -->
    <?php require_once APP_COMPONENTES . '/header.php'; ?>

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
                        if (!empty($_SESSION['nomeUser'])) {
                            echo $_SESSION['nomeUser'];
                        }

                        ?>
                    </p>


                    Senha Encryptada:
                    <p>
                        <?php
                        if (!empty($_SESSION['senhaUser'])) {
                            echo $_SESSION['senhaUser'];
                        }

                        ?>




                    </p>

                    Senha Decrypitada:
                    <p>
                        <?php
                        if (!empty($_SESSION['senhaUser'])) {
                            echo encrypt_secure($_SESSION['senhaUser'], 'd');
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

                    <br><br>

                    <h3>Calculo da Quantidade</h3>

                    <p>

                        <?php

                        $protudo = "Mouse";
                        $valor = "15";
                        $quantidade = "50";

                        ?>
                    </p>


                    <p>

                        Produto: <?php echo $protudo; ?> <br>
                        Valor: <?php echo $valor; ?> <br>
                        Quantidade: <?php echo $quantidade; ?> <br>
                        Total: <?php echo $quantidade * $valor; ?> <br>

                    </p>

                    <br><br>

                    <h3>Criando Variáveis</h3>

                    <p>

                        <?php

                        $banco = "Inter";
                        $saldo = 5000;
                        $deposito = 1000;
                        $saldototal = $saldo + $deposito;

                        ?>

                    </p>

                    <p>

                        Banco: <?php echo $banco; ?> <br>
                        Saldo: <?php echo $saldo; ?> <br>
                        Depósito: <?php echo $deposito; ?> <br>
                        Saldo Total: <?php echo $saldototal; ?> <br>

                    </p>


                    <br><br>

                    <h3>Criar Variáveis</h3>

                    <?php

                    $produto = "Caneta";
                    $valor = 5;
                    $desconto = 10;
                    $valorfinal = $valor - ($valor * $desconto / 100);

                    ?>

                    <p>

                        Produto: <?php echo $produto; ?> <br>
                        Valor: R$ <?php echo $valor; ?> <br>
                        Desconto: <?php echo $desconto; ?>% <br>
                        Valor Final: R$ <?php echo $valorfinal; ?> <br>

                    </p>


                    <br><br>

                    <h3>Crie uma Variável</h3>

                    <p>

                        <?php

                        $email = "lulu@gmail.com";

                        $enc = encrypt_secure($email, 'e');
                        $dec = encrypt_secure($enc, 'd');

                        ?>

                    </p>

                    <p>

                        Código Encriptado: <?php echo $enc; ?> <br>
                        Código Decriptado: <?php echo $dec; ?> <br>

                    </p>

                    <br><br>

                    <h3>Variável de Link</h3>

                    <P>
                        <?php

                        $chave = "we252563";

                        ?>

                    </P>

                    <a href="?chave=<?php echo $chave; ?>">Link</a>

                    <?php

                    if (!empty($_GET['chave'])) {

                        $chave = $_GET['chave'];

                        $enc = encrypt_secure($chave, 'e');
                        $dec = encrypt_secure($enc, 'd');
                    }

                    ?>



                    Variável: <?php echo $chave; ?> <br>
                    Variável Encryptada: <?php echo $enc; ?> <br>
                    Variável Decryptada: <?php echo $dec; ?> <br>


                    <br><br>

                    <a href="?chave=we252563"> link da chave</a>

                        <?php

                        if(!empty($_GET['chave'])) {
                        $chave =$_GET['chave'];
                        $chaveenc = encrypt_secure($chave,'e');
                        $chavedec = encrypt_secure($chaveenc,'d');
                        
                        }

                        ?>

                        Chave: <?=$chave??'';?> br
                        Chave encryptada: <?=$chaveenc??' ';?> <br>
                        Chave decryptada: <?=$chavedec??' ';?>


                        

































































                </div>
            </div>
        </div>



    </main>

    <!-- footer -->
    <?php require_once APP_COMPONENTES . '/footer.php'; ?>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>