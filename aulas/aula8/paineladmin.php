<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="bi bi-speedometer2"></i> Painel Administrativo
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="bi bi-house"></i> Início
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-box"></i> Produtos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="bi bi-people"></i> Usuários
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link text-danger">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo -->
    <main class="container py-5">

        <h2 class="mb-4">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </h2>

        <div class="row g-4">

            <!-- Card Produtos -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="bi bi-box-seam display-4 text-primary"></i>
                        <h5 class="mt-3">Produtos</h5>
                        <h2>120</h2>
                    </div>
                </div>
            </div>

            <!-- Card Usuários -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="bi bi-people display-4 text-success"></i>
                        <h5 class="mt-3">Usuários</h5>
                        <h2>35</h2>
                    </div>
                </div>
            </div>

            <!-- Card Vendas -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="bi bi-cart-check display-4 text-warning"></i>
                        <h5 class="mt-3">Vendas</h5>
                        <h2>78</h2>
                    </div>
                </div>
            </div>

            <!-- Card Estoque -->
            <div class="col-md-3">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <i class="bi bi-archive display-4 text-danger"></i>
                        <h5 class="mt-3">Estoque</h5>
                        <h2>540</h2>
                    </div>
                </div>
            </div>

        </div>

        <!-- Tabela -->
        <div class="card shadow mt-5">
            <div class="card-header bg-primary text-white">
                Últimos Produtos
            </div>

            <div class="card-body">

                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Produto</th>
                            <th>Categoria</th>
                            <th>Preço</th>
                            <th>Estoque</th>
                            <th>Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr>
                            <td>1</td>
                            <td>Mouse Gamer</td>
                            <td>Informática</td>
                            <td>R$ 150,00</td>
                            <td>25</td>
                            <td>
                                <button class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>2</td>
                            <td>Teclado Mecânico</td>
                            <td>Informática</td>
                            <td>R$ 320,00</td>
                            <td>12</td>
                            <td>
                                <button class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <button class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>