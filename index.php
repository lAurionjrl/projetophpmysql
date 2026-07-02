<?php require_once __DIR__. '/componentes/rotas.php';?>
<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Controle de Estoque</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="componentes/style.css">
</head>

<body class="bg-light">

    <!-- Navbar -->
    <?php require_once APP_COMPONENTES.'/nav.php'; ?>

    <!-- Header -->
    <?php require_once APP_COMPONENTES.'/header.php'; ?>

    <!-- Dashboard / Conteúdo Principal -->
    <main class="container my-5">

        <!-- Seção de Boas-vindas -->
        <section class="welcome-section mb-5">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="welcome-icon d-flex align-items-center justify-content-center rounded-3 bg-primary bg-opacity-10 text-primary">
                    <i class="bi bi-speedometer2"></i>
                </div>
                <div>
                    <h2 class="h3 fw-bold mb-0">Painel de Controle</h2>
                    <p class="text-secondary mb-0">Visão geral do seu estoque</p>
                </div>
            </div>
            <div class="welcome-bar rounded-3 p-4 bg-white border">
                <p class="mb-0 text-secondary">
                    <i class="bi bi-info-circle me-2 text-primary"></i>
                    Utilize os atalhos abaixo ou o menu de navegação para acessar as funcionalidades do sistema.
                </p>
            </div>
        </section>

        <!-- Cards de Ação -->
        <div class="row g-4">

            <!-- Card: Produtos -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-primary bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-primary text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-box-seam display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Produtos</h5>
                        <p class="card-text text-secondary mb-4">
                            Cadastre, edite e gerencie todos os produtos do seu estoque de forma organizada.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/produtos" class="btn btn-primary fw-semibold px-4">
                                <i class="bi bi-box me-2"></i>Acessar
                            </a>
                            <a href="/produtos/novo" class="btn btn-outline-primary fw-semibold" title="Novo Produto">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-check-circle-fill text-success me-1"></i> 1.240 ativos</span>
                            <span><i class="bi bi-exclamation-circle-fill text-warning me-1"></i> 12 baixos</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Fornecedores -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-success bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-success text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-truck display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Fornecedores</h5>
                        <p class="card-text text-secondary mb-4">
                            Mantenha seu cadastro de fornecedores atualizado e consulte informações de contato.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/fornecedores" class="btn btn-success fw-semibold px-4">
                                <i class="bi bi-truck me-2"></i>Acessar
                            </a>
                            <a href="/fornecedores/novo" class="btn btn-outline-success fw-semibold" title="Novo Fornecedor">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-check-circle-fill text-success me-1"></i> 86 cadastrados</span>
                            <span><i class="bi bi-star-fill text-warning me-1"></i> 5 top</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Relatórios -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-warning bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-warning text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-graph-up-arrow display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Relatórios</h5>
                        <p class="card-text text-secondary mb-4">
                            Visualize relatórios detalhados de entradas, saídas e movimentação do estoque.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/relatorios" class="btn btn-warning fw-semibold px-4 text-white">
                                <i class="bi bi-graph-up me-2"></i>Acessar
                            </a>
                            <a href="/relatorios/exportar" class="btn btn-outline-warning fw-semibold" title="Exportar">
                                <i class="bi bi-download"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-file-earmark-text text-primary me-1"></i> 24 gerados</span>
                            <span><i class="bi bi-calendar-check text-success me-1"></i> Este mês</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Categorias (Bônus) -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-info bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-info text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-tags display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Categorias</h5>
                        <p class="card-text text-secondary mb-4">
                            Organize seus produtos em categorias para facilitar a busca e gestão do estoque.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/categorias" class="btn btn-info fw-semibold px-4 text-white">
                                <i class="bi bi-tags me-2"></i>Acessar
                            </a>
                            <a href="/categorias/nova" class="btn btn-outline-info fw-semibold" title="Nova Categoria">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-layers text-info me-1"></i> 12 categorias</span>
                            <span><i class="bi bi-folder text-warning me-1"></i> 3 grupos</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Movimentações (Bônus) -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-danger bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-danger text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-arrow-left-right display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Movimentações</h5>
                        <p class="card-text text-secondary mb-4">
                            Registre entradas e saídas de produtos e acompanhe o histórico completo.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/movimentacoes" class="btn btn-danger fw-semibold px-4">
                                <i class="bi bi-arrow-left-right me-2"></i>Acessar
                            </a>
                            <a href="/movimentacoes/nova" class="btn btn-outline-danger fw-semibold" title="Nova Movimentação">
                                <i class="bi bi-plus-lg"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-arrow-down-circle text-success me-1"></i> 156 entradas</span>
                            <span><i class="bi bi-arrow-up-circle text-danger me-1"></i> 89 saídas</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card: Configurações (Bônus) -->
            <div class="col-md-6 col-lg-4">
                <div class="dashboard-card card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-top bg-secondary bg-opacity-10 p-4 text-center">
                        <div class="card-icon bg-secondary text-white d-inline-flex align-items-center justify-content-center rounded-3 shadow-sm">
                            <i class="bi bi-gear display-6"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="card-title fw-bold mb-2">Configurações</h5>
                        <p class="card-text text-secondary mb-4">
                            Personalize preferências do sistema, usuários e permissões de acesso.
                        </p>
                        <div class="d-flex gap-2 justify-content-center">
                            <a href="/configuracoes" class="btn btn-secondary fw-semibold px-4">
                                <i class="bi bi-gear me-2"></i>Acessar
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 px-4 pb-4">
                        <div class="d-flex align-items-center justify-content-between text-secondary small">
                            <span><i class="bi bi-people text-primary me-1"></i> 3 usuários</span>
                            <span><i class="bi bi-shield-check text-success me-1"></i> Ativo</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Atividade Recente (Opcional) -->
        <section class="mt-5">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h3 class="h5 fw-bold mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>
                    Atividade Recente
                </h3>
                <a href="/movimentacoes" class="btn btn-sm btn-outline-primary">Ver todas</a>
            </div>
            <div class="card border-0 shadow-sm rounded-4">
                <div class="list-group list-group-flush rounded-4">
                    <div class="list-group-item d-flex align-items-center gap-3 py-3">
                        <div class="activity-icon bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-arrow-down-left"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold">Entrada de estoque</h6>
                            <small class="text-secondary">50 unidades de "Notebook Dell" adicionadas</small>
                        </div>
                        <small class="text-secondary flex-shrink-0">Há 10 min</small>
                    </div>
                    <div class="list-group-item d-flex align-items-center gap-3 py-3">
                        <div class="activity-icon bg-danger bg-opacity-10 text-danger rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold">Saída de estoque</h6>
                            <small class="text-secondary">12 unidades de "Mouse Logitech" removidas</small>
                        </div>
                        <small class="text-secondary flex-shrink-0">Há 45 min</small>
                    </div>
                    <div class="list-group-item d-flex align-items-center gap-3 py-3">
                        <div class="activity-icon bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center flex-shrink-0">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold">Novo produto</h6>
                            <small class="text-secondary">"Monitor LG 27''" cadastrado no sistema</small>
                        </div>
                        <small class="text-secondary flex-shrink-0">Há 2 horas</small>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php require_once APP_COMPONENTES.'/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>