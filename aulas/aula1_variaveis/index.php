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

    <!-- nav -->
    <?php $numaula = "Aula 1-Variáveis";?> 
    <?php require_once APP_COMPONENTES. '/nav.php';?>
    <?php require_once APP_COMPONENTES. '/header.php';?>

    <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                <?php 

                $nome = "Paula Lins";
                $valor = "100";
                $moeda = "15.59";
                $status = "true";
                $nulo = "Null";
                $dados = ["Antônio", 10, 15.25, true ];
                ?>

                <p>
                    Nome <br>
                    <?php var_dump($nome); ?>
                </p>
                
                <p>
                    Valor<br>
                    <?php var_dump($valor); ?>
                </p>

                <p>
                    Moeda<br>
                    <?php var_dump($moeda); ?>
                </p>
                
                <p>
                    Status<br>
                    <?php var_dump($status); ?>
                </p>
                
                <p>
                    Null<br>
                    <?php var_dump($nulo); ?>
                </p>

                <p>
                    Array<br>
                    <?php var_dump($dados); ?>
                </p>

                <h1>Operadores</h1>
                <?php
                    $valor1 = 1250;
                    $valor2 = 15;

                    // $valor1 = number_format($valor1, 2,',','.');
                ?>
                <h3>Soma</h3>
                <?php $total = $valor1 + $valor2;     ?>
                A soma de <?php echo number_format($valor1, 2,',','.'); ?> + é igual a :
                





                </div>
            </div>
        </div>

    </main>

    <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <?php

                    $nome = "Lucas Sampaio";
                    $idade = "26";
                    $profissão = "Atendente";
                    $salario = "1700";
                    $estado = "Fortaleza - CE";
                    $email = "LucasSam@gmail.com";
                    $celular = "(85)8645-3568";
                    $datanascimento = "05/10/00";


                    ?>

                </div>
            </div>
        </div>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Cadastro de Aluno</h2>

            <table class="table table-striped table-hover table-bordered align-middle shadow">
                <thead class="table-primary">
                    <tr>
                        <th width="35%">Campo</th>
                        <th>Informação</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><i class="bi bi-person-fill me-2"></i>Nome</td>
                        <td><?php echo $nome?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-calendar-event me-2"></i>Idade</td>
                        <td><?php echo $idade?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Salário</td>
                        <td><?php echo $salario?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-geo-alt-fill me-2"></i>Estado</td>
                        <td><?php echo $estado?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-envelope-fill me-2"></i>E-mail</td>
                        <td><?php echo $email?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-telephone-fill me-2"></i>Celular</td>
                        <td><?php echo $celular?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-calendar-date-fill me-2"></i>Data de Nascimento</td>
                        <td><?php echo$datanascimento?? "Não Definido"?></td>
                    </tr>
                </tbody>
            </table>

        </div>

    </main>

     <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <?php

                    $produto = "Morango";
                    $categoria= "fruta";
                    $preco = "12,99";
                    $estoque ="100";

                    ?>

                </div>
            </div>
        </div>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Desafio 2 Cadastro de Produto</h2>

            <table class="table table-striped table-hover table-bordered align-middle shadow">
                <thead class="table-primary">
                    <tr>
                        <th width="35%">Campo</th>
                        <th>Informação</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><i class="bi bi-person-fill me-2"></i>Produto</td>
                        <td><?php echo $produto?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-calendar-event me-2"></i>Categoria</td>
                        <td><?php echo $categoria?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Preço</td>
                        <td><?php echo $preco?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-geo-alt-fill me-2"></i>Estoque</td>
                        <td><?php echo $estoque?? "Não Definido"?></td>
                    </tr>

                    
                </tbody>
            </table>

        </div>

    </main>

       <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <?php

                    $produto = "Celular";
                    $precounitario = "2.000";
                    $quantidade = "150";
                    $vendedor = "Carlos Oliveira";
                    $percetualdecomissao = "0,5%";
                    $comissaoaareceber ="15.000"
                   
                    ?>

                </div>
            </div>
        </div>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Desafio 3 Cálculo de venda simples</h2>

            <table class="table table-striped table-hover table-bordered align-middle shadow">
                <thead class="table-primary">
                    <tr>
                        <th width="35%">Campo</th>
                        <th>Informação</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><i class="bi bi-person-fill me-2"></i>Produto</td>
                        <td><?php echo $produto?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-calendar-event me-2"></i>Preço Unitario</td>
                        <td><?php echo $precounitario?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Quantidade</td>
                        <td><?php echo $quantidade?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Vendedor</td>
                        <td><?php echo $vendedor?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Percentuau de Comissâo</td>
                        <td><?php echo $percetualdecomissao?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Comissâo a Receber</td>
                        <td><?php echo $comissaoaareceber?? "Não Definido"?></td>
                    </tr>
    
                </tbody>
                
            </table>

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