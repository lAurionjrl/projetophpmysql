<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

// --- LÓGICA DE EXCLUSÃO DE PRODUTO ---
if (isset($_GET['excluir_produto'])) {
    $id_excluir = intval($_GET['excluir_produto']);
    $stmt = $con->prepare("DELETE FROM produtos WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- LÓGICA DE SALVAMENTO (INSERIR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['persistir_produto'])) {
    $id = $_POST['id_produto'];
    $nome = trim($_POST['nome']);
    $categoria = trim($_POST['categoria']);
    $preco = floatval(str_replace(',', '.', $_POST['preco']));
    $estoque = intval($_POST['estoque']);
    $status = !empty($_POST['status']) ? $_POST['status'] : 'ativo';

    if (!empty($nome) && !empty($categoria)) {
        if (!empty($id)) {
            // Editar Produto Existente
            $stmt = $con->prepare("UPDATE produtos SET nome = ?, categoria = ?, preco = ?, estoque = ?, status = ? WHERE id = ?");
            $stmt->execute([$nome, $categoria, $preco, $estoque, $status, $id]);
        } else {
            // Inserir Novo Produto
            $stmt = $con->prepare("INSERT INTO produtos (nome, categoria, preco, estoque, status) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $categoria, $preco, $estoque, $status]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE PRODUTOS ---
$produtos_lista = $con->query("SELECT * FROM produtos ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER PRODUTOS NO BANCO ---
if (empty($produtos_lista)) {
    $produtos_lista = [
        [
            'id' => 1,
            'nome' => 'Teclado Mecânico RGB',
            'categoria' => 'Eletrônicos',
            'preco' => 289.90,
            'estoque' => 45,
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'nome' => 'Mouse Sem Fio Ergonomico',
            'categoria' => 'Eletrônicos',
            'preco' => 129.50,
            'estoque' => 30,
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'nome' => 'Monitor 24 IPS Full HD',
            'categoria' => 'Eletrônicos',
            'preco' => 899.00,
            'estoque' => 12,
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'nome' => 'Cadeira de Escritório Presidente',
            'categoria' => 'Móveis',
            'preco' => 749.99,
            'estoque' => 8,
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'nome' => 'Headset Gamer 7.1',
            'categoria' => 'Áudio',
            'preco' => 219.00,
            'estoque' => 25,
            'status' => 'inativo',
            'criado_em' => date('Y-m-d H:i:s')
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster - Controle de Produtos</title>
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
                    <h6 class="mb-0 text-truncate fw-semibold" style="max-width: 150px;">Junior Lima</h6>
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
                    <h1 class="h2 mb-1 fw-bold text-body">Gerenciamento de Produtos</h1>
                    <p class="text-muted mb-0">Cadastre e gerencie os itens do seu estoque em tempo real.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarProduto" onclick="prepararInclusaoProduto()">
                        <i class="bi bi-plus-circle me-2"></i>Novo Produto
                    </button>
                    <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#modalEntrada">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Entrada
                    </button>
                    <button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#modalSaida">
                        <i class="bi bi-box-arrow-left me-2"></i>Saída
                    </button>
                </div>
            </div>

            <!-- TABELA DE PRODUTOS COM AÇÕES: ADICIONAR, EDITAR E EXCLUIR -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Produto</th>
                                            <th>Categoria</th>
                                            <th>Preço</th>
                                            <th>Estoque</th>
                                            <th>Status</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($produtos_lista as $prod): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $prod['id'] ?></td>
                                                <td class="fw-semibold text-body"><?= htmlspecialchars($prod['nome']) ?></td>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                                        <?= htmlspecialchars($prod['categoria']) ?>
                                                    </span>
                                                </td>
                                                <td class="fw-medium text-success">R$ <?= number_format($prod['preco'], 2, ',', '.') ?></td>
                                                <td>
                                                    <span class="fw-semibold <?= $prod['estoque'] < 10 ? 'text-danger' : 'text-body' ?>">
                                                        <?= $prod['estoque'] ?> un
                                                    </span>
                                                </td>
                                                <td>
                                                    <?php if (($prod['status'] ?? 'ativo') === 'ativo'): ?>
                                                        <span class="badge bg-success-subtle text-success rounded-pill px-2">Ativo</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-2">Inativo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Ações de Gerenciamento">
                                                        <!-- Botão Adicionar -->
                                                        <button class="btn btn-outline-success" 
                                                                title="Adicionar Novo" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarProduto" 
                                                                onclick="prepararInclusaoProduto()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicaoProduto(<?= json_encode($prod) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarProduto">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_produto=<?= $prod['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                                            <i class="bi bi-trash"></i> <span class="d-none d-md-inline">Excluir</span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>

        <!-- footer -->
        <?php require_once APP_COMPONENTES . '/footer.php'; ?>

    </section>

    <!-- MODAL DINÂMICO PARA CADASTRAR E EDITAR PRODUTO -->
    <div class="modal fade" id="modalGerenciarProduto" tabindex="-1" aria-labelledby="modalGerenciarProdutoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGerenciarProdutoLabel">
                        <i class="bi bi-box-seam text-primary me-2"></i>
                        <span id="prod-modal-titulo">Produto</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_produto" value="1">
                    <input type="hidden" name="id_produto" id="prod-id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="prod-nome" class="form-label small fw-medium">Nome do Produto</label>
                            <input type="text" class="form-control" name="nome" id="prod-nome" required maxlength="120">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="prod-categoria" class="form-label small fw-medium">Categoria</label>
                                <input type="text" class="form-control" name="categoria" id="prod-categoria" required placeholder="Ex: Eletrônicos">
                            </div>
                            <div class="col-6">
                                <label for="prod-status" class="form-label small fw-medium">Status</label>
                                <select class="form-select" name="status" id="prod-status">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="prod-preco" class="form-label small fw-medium">Preço (R$)</label>
                                <input type="number" step="0.01" class="form-control" name="preco" id="prod-preco" required placeholder="0.00">
                            </div>
                            <div class="col-6">
                                <label for="prod-estoque" class="form-label small fw-medium">Quantidade em Estoque</label>
                                <input type="number" class="form-control" name="estoque" id="prod-estoque" required min="0">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="prod-btn-submit">Salvar Produto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAIS ADICIONAIS -->
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

    <!-- CONTROLE JS DO MODAL DE PRODUTOS -->
    <script>
        function prepararInclusaoProduto() {
            document.getElementById('prod-modal-titulo').innerText = "Cadastrar Novo Produto";
            document.getElementById('prod-btn-submit').innerText = "Adicionar";
            document.getElementById('prod-id').value = "";
            document.getElementById('prod-nome').value = "";
            document.getElementById('prod-categoria').value = "";
            document.getElementById('prod-preco').value = "";
            document.getElementById('prod-estoque').value = "";
            document.getElementById('prod-status').value = "ativo";
        }

        function prepararEdicaoProduto(prod) {
            document.getElementById('prod-modal-titulo').innerText = "Editar Produto";
            document.getElementById('prod-btn-submit').innerText = "Salvar Alterações";
            document.getElementById('prod-id').value = prod.id;
            document.getElementById('prod-nome').value = prod.nome;
            document.getElementById('prod-categoria').value = prod.categoria;
            document.getElementById('prod-preco').value = prod.preco;
            document.getElementById('prod-estoque').value = prod.estoque;
            document.getElementById('prod-status').value = prod.status ? prod.status : "ativo";
        }
    </script>
</body>
</html>