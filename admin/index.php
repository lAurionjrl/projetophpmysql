<?php require_once __DIR__ . '/componentes/config.php'; ?>
<?php require_once __DIR__ . '/componentes/rotas.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster - Sistema de Controle de Estoque</title>
    <meta name="description" content="Dashboard moderno para controle de estoque, gerenciamento de produtos, fornecedores e relatórios em tempo real.">
    <meta name="keywords" content="estoque, dashboard, gerenciamento, produtos, logística, admin">
    <meta name="author" content="Desenvolvedor Especialista Front-end">

    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    
</head>

<body>

    <aside class="bg-body-tertiary" id="sidebar" aria-label="Navegação Principal">
        <div class="sidebar-brand justify-content-between">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-box-seam-fill text-primary fs-3"></i>
                <span class="fw-bold fs-5 sidebar-text">StockMaster</span>
            </div>
            <button class="btn btn-sm d-none d-lg-block text-secondary" id="btn-collapse-sidebar" aria-label="Recolher menu">
                <i class="bi bi-arrow-bar-left fs-5"></i>
            </button>
        </div>

        <div class="p-3 border-bottom user-info">
            <div class="d-flex align-items-center gap-3">
                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Foto do Administrador" class="rounded-circle" width="45" height="45">
                <div>
                    <h6 class="mb-0 text-truncate fw-semibold" style="max-width: 150px;">Aurinon Junior</h6>
                    <small class="text-muted">Administrador</small>
                </div>
            </div>
        </div>

        <!-- nav -->
        <?php require_once APP_COMPONENTES . '/nav.php'; ?>

    </aside>

    <section class="dashboard-wrapper">

        <!-- header -->
        <?php require_once APP_COMPONENTES . '/header.php'; ?>

        <main class="flex-grow-1 p-4">

            <div class="row align-items-center g-3 mb-4">
                <div class="col-10 col-md-6 col-lg-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="h2 mb-1 fw-bold text-body">Dashboard de Estoque</h1>
                    <p class="text-muted mb-0">Seja bem-vinda de volta, Junior! Aqui está o resumo operacional de hoje, <span id="current-date" class="fw-medium"></span>.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="" data-bs-target="">
                        <i class="bi bi-plus-circle me-2"></i>Novo Produto
                    </button>
                    <button class="btn btn-outline-success" data-bs-toggle="" data-bs-target="">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Entrada
                    </button>
                    <button class="btn btn-outline-danger" data-bs-toggle="" data-bs-target="">
                        <i class="bi bi-box-arrow-left me-2"></i>Saída
                    </button>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Total de Produtos</span>
                                <h3 class="fw-bold my-1">1.248</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i>+3.4%</span>
                                <span class="text-muted small"> vs mês anterior</span>
                            </div>
                            <div class="icon-shape bg-primary-subtle text-primary">
                                <i class="bi bi-box fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Itens em Estoque</span>
                                <h3 class="fw-bold my-1">8.590</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i>+1.2%</span>
                                <span class="text-muted small"> vs mês anterior</span>
                            </div>
                            <div class="icon-shape bg-info-subtle text-info">
                                <i class="bi bi-boxes fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Estoque Baixo</span>
                                <h3 class="fw-bold text-warning my-1">37</h3>
                                <span class="text-danger small fw-medium"><i class="bi bi-arrow-up-short"></i>+8.2%</span>
                                <span class="text-muted small"> em risco crítico</span>
                            </div>
                            <div class="icon-shape bg-warning-subtle text-warning">
                                <i class="bi bi-exclamation-triangle fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Sem Estoque</span>
                                <h3 class="fw-bold text-danger my-1">12</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-down-short"></i>-4.3%</span>
                                <span class="text-muted small"> itens zerados</span>
                            </div>
                            <div class="icon-shape bg-danger-subtle text-danger">
                                <i class="bi bi-x-circle fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Entradas (Mês)</span>
                                <h3 class="fw-bold my-1">420</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i>+15.3%</span>
                                <span class="text-muted small"> novos lotes</span>
                            </div>
                            <div class="icon-shape bg-success-subtle text-success">
                                <i class="bi bi-cloud-arrow-up fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Saídas (Mês)</span>
                                <h3 class="fw-bold my-1">385</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i>+5.8%</span>
                                <span class="text-muted small"> pedidos expedidos</span>
                            </div>
                            <div class="icon-shape bg-secondary-subtle text-secondary">
                                <i class="bi bi-cloud-arrow-down fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Valor em Patrimônio</span>
                                <h3 class="fw-bold my-1">R$ 286.450</h3>
                                <span class="text-success small fw-medium"><i class="bi bi-arrow-up-short"></i>+2.5%</span>
                                <span class="text-muted small"> capital imobilizado</span>
                            </div>
                            <div class="icon-shape bg-success-subtle text-success">
                                <i class="bi bi-currency-dollar fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-xl-3">
                    <div class="card border-0 shadow-sm card-stat h-100">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-medium text-uppercase">Fornecedores Ativos</span>
                                <h3 class="fw-bold my-1">84</h3>
                                <span class="text-muted small">Nenhuma alteração</span>
                            </div>
                            <div class="icon-shape bg-dark-subtle text-dark">
                                <i class="bi bi-truck-flatbed fs-4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-12 col-xl-8">
                    <div class="card border-0 shadow-sm p-4">
                        <h5 class="fw-bold mb-3">Movimentações de Estoque (Últimos 6 meses)</h5>
                        <div style="position: relative; height: 300px;">
                            <canvas id="chartMovimentacoes"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-xl-4">
                    <div class="card border-0 shadow-sm p-4">
                        <h5 class="fw-bold mb-3">Distribuição por Categoria</h5>
                        <div style="position: relative; height: 300px;">
                            <canvas id="chartCategorias"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- footer -->
        <?php require_once APP_COMPONENTES . '/footer.php'; ?>

    </section>

    <div class="modal fade" id="modalNovoProduto" tabindex="-1" aria-labelledby="modalNovoProdutoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalNovoProdutoLabel"><i class="bi bi-box-seam text-primary me-2"></i>Cadastrar Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-shadow="none" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="prod-nome" class="form-label small fw-medium">Nome do Produto</label>
                            <input type="text" class="form-control" id="prod-nome" required>
                        </div>
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="prod-sku" class="form-label small fw-medium">SKU / Código</label>
                                <input type="text" class="form-control" id="prod-sku" required>
                            </div>
                            <div class="col-6">
                                <label for="prod-cat" class="form-label small fw-medium">Categoria</label>
                                <select class="form-select" id="prod-cat">
                                    <option>Eletrônicos</option>
                                    <option>Alimentos</option>
                                    <option>Vestuário</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEntrada" tabindex="-1" aria-labelledby="modalEntradaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalEntradaLabel"><i class="bi bi-box-arrow-in-right text-success me-2"></i>Registrar Entrada de Estoque</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted">Insira as informações do lote ou nota fiscal recebida para alimentar o sistema.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success">Confirmar Entrada</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalSaida" tabindex="-1" aria-labelledby="modalSaidaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalSaidaLabel"><i class="bi bi-box-arrow-left text-danger me-2"></i>Registrar Saída / Baixa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p class="small text-muted">Selecione o produto e a quantidade correspondente para faturamento ou descarte.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-danger">Confirmar Saída</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    
</body>

</html>