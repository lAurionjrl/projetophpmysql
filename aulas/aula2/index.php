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
    <?php $numaula = 'Aula 2 - Desafio 1'; ?>
    <?php require_once '../componentes/nav.php' ?>

    <?php require_once '../componentes/header.php' ?>
    
    <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                    <?php

                    $nome = "Carlos Andrade";
                    $idade = "15";
                    $curso = "TI";
                    $nota = "8,5";

                    ?>

                </div>
            </div>
        </div>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Ficha do Aluno</h2>

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
                        <td><i class="bi bi-cash-stack me-2"></i>Curso</td>
                        <td><?php echo $salario?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-geo-alt-fill me-2"></i>Nota</td>
                        <td><?php echo $nota?? "Não Definido"?></td>
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

                    $produto = "Monitor";
                    $categoria = "Informatica";
                    $preço = "399";
                    $estoque = "100";

                    ?>

                </div>
            </div>
        </div>

        <div class="container mt-5">

            <h2 class="text-center mb-4">Ficha do Aluno</h2>

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
                        <td><?php echo $nome?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-calendar-event me-2"></i>Categoria</td>
                        <td><?php echo $idade?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-cash-stack me-2"></i>Curso</td>
                        <td><?php echo $salario?? "Não Definido"?></td>
                    </tr>

                    <tr>
                        <td><i class="bi bi-geo-alt-fill me-2"></i>Nota</td>
                        <td><?php echo $nota?? "Não Definido"?></td>
                    </tr>

                </tbody>
            </table>

        </div>

    </main>

     
     
    <!-- footer -->
    <?php require_once '../componentes/footer.php' ?>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>