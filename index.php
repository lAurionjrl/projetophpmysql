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
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <!-- Nome do projeto -->
            <a class="navbar-brand fw-bold" href="#">
                Controle de Estoque
            </a>

            <!-- Botão para telas pequenas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#menuNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="menuNavbar">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link active" href="#">Início</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Produtos</a>
                    </li>

                    <!-- Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button"
                            data-bs-toggle="dropdown">
                            Mais
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Categorias</a></li>
                            <li><a class="dropdown-item" href="#">Fornecedores</a></li>
                            <li><a class="dropdown-item" href="#">Relatórios</a></li>
                        </ul>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="bg-light py-5 text-center">
        <div class="container">
            <h1>Controle de Estoque</h1>
            <p class="lead">
                Sistema para gerenciamento de produtos, fornecedores e movimentação de estoque.
            </p>
        </div>
    </header>

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
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <p class="mb-0">
                &copy; 2026 - Controle de Estoque. Todos os direitos reservados.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>