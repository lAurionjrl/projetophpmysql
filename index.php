<?php require_once __DIR__. '/componentes/rotas.php';?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle de Estoque</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Navbar -->
     <?php require_once APP_COMPONENTES.'/nav.php'; ?>

    <!-- Header -->
     <?php require_once APP_COMPONENTES.'/header.php'; ?>


    
   

    <!-- Section -->
    <section class="container my-4">
        <h2>Bem-vindo</h2>
        <p>
            Utilize o menu acima para acessar as funcionalidades do sistema de controle de estoque.
        </p>
    </section>

    <!-- Main -->
    <main class="container my-5">

        <div class="row">
            
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Produtos</h5>
                        <p class="card-text">
                            Cadastre e gerencie os produtos do estoque.
                        </p>
                        <a href="#" class="btn btn-primary">Acessar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Fornecedores</h5>
                        <p class="card-text">
                            Consulte e cadastre fornecedores.
                        </p>
                        <a href="#" class="btn btn-success">Acessar</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mt-3 mt-md-0">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Relatórios</h5>
                        <p class="card-text">
                            Visualize relatórios de entradas e saídas.
                        </p>
                        <a href="#" class="btn btn-warning">Acessar</a>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- Footer -->
     <?php require_once APP_COMPONENTES.'/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>