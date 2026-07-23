<?php require_once 'componentes/config.php'; ?>
<?php require_once 'componentes/conexao.php'; ?>
<?php require_once 'componentes/rotas.php'; ?>

<?php
$con = config::connect();

// --- LÓGICA DE EXCLUSÃO DE MOVIMENTAÇÃO ---
if (isset($_GET['excluir_movimentacao'])) {
    $id_excluir = intval($_GET['excluir_movimentacao']);
    $stmt = $con->prepare("DELETE FROM movimentacoes_estoque WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- LÓGICA DE SALVAMENTO (INSERIR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['persistir_movimentacao'])) {
    $id = $_POST['id_movimentacao'];
    $produto_id = intval($_POST['produto_id']);
    $tipo = $_POST['tipo'];
    $quantidade = intval($_POST['quantidade']);
    $observacao = !empty(trim($_POST['observacao'])) ? trim($_POST['observacao']) : null;

    if ($produto_id > 0 && $quantidade > 0 && !empty($tipo)) {
        if (!empty($id)) {
            // Modo Edição
            $stmt = $con->prepare("UPDATE movimentacoes_estoque SET produto_id = ?, tipo = ?, quantidade = ?, observacao = ? WHERE id = ?");
            $stmt->execute([$produto_id, $tipo, $quantidade, $observacao, $id]);
        } else {
            // Modo Adicionar
            $stmt = $con->prepare("INSERT INTO movimentacoes_estoque (produto_id, tipo, quantidade, observacao) VALUES (?, ?, ?, ?)");
            $stmt->execute([$produto_id, $tipo, $quantidade, $observacao]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE MOVIMENTAÇÕES ---
$movimentacoes_lista = $con->query("SELECT * FROM movimentacoes_estoque ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER REGISTROS NO BANCO ---
if (empty($movimentacoes_lista)) {
    $movimentacoes_lista = [
        [
            'id' => 1,
            'produto_id' => 101,
            'tipo' => 'Entrada',
            'quantidade' => 50,
            'observacao' => 'Recebimento de lote do fornecedor',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'produto_id' => 102,
            'tipo' => 'Saida',
            'quantidade' => 10,
            'observacao' => 'Venda para cliente corporativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'produto_id' => 103,
            'tipo' => 'Entrada',
            'quantidade' => 20,
            'observacao' => 'Ajuste de inventário semanal',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'produto_id' => 104,
            'tipo' => 'Saida',
            'quantidade' => 5,
            'observacao' => 'Baixa por avaria no transporte',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'produto_id' => 105,
            'tipo' => 'Entrada',
            'quantidade' => 100,
            'observacao' => 'Reposição de estoque principal',
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
    <title>StockMaster - Movimentações de Estoque</title>

    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/2897/2897785.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
        <?php if (defined('APP_COMPONENTES')) { require_once APP_COMPONENTES . '/nav.php'; } ?>
    </aside>

    <section class="dashboard-wrapper">
        <!-- header -->
        <?php if (defined('APP_COMPONENTES')) { require_once APP_COMPONENTES . '/header.php'; } ?>

        <main class="flex-grow-1 p-4">

            <div class="row align-items-center g-3 mb-4">
                <div class="col-10 col-md-6 col-lg-7">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-1">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                    <h1 class="h2 mb-1 fw-bold text-body">Movimentações de Estoque</h1>
                    <p class="text-muted mb-0">Controle de entradas, saídas e histórico de movimentações.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMovimentacao" onclick="prepararInclusaoMovimentacao()">
                        <i class="bi bi-plus-circle me-2"></i>Nova Movimentação
                    </button>
                </div>
            </div>

            <!-- TABELA DE MOVIMENTAÇÕES DE ESTOQUE -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>ID Produto</th>
                                            <th>Tipo</th>
                                            <th>Quantidade</th>
                                            <th>Observação</th>
                                            <th>Data/Hora</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($movimentacoes_lista as $mov): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $mov['id'] ?></td>
                                                <td class="fw-semibold text-body">Prod. #<?= $mov['produto_id'] ?></td>
                                                <td>
                                                    <?php if (strtolower($mov['tipo']) === 'entrada'): ?>
                                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                                                            <i class="bi bi-arrow-down-left me-1"></i>Entrada
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-3">
                                                            <i class="bi bi-arrow-up-right me-1"></i>Saída
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="fw-bold"><?= $mov['quantidade'] ?> un</td>
                                                <td><?= !empty($mov['observacao']) ? htmlspecialchars($mov['observacao']) : '<em class="text-muted">Sem observação</em>' ?></td>
                                                <td><?= date('d/m/Y H:i', strtotime($mov['criado_em'])) ?></td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Ações de Gerenciamento">
                                                        <!-- Botão Adicionar -->
                                                        <button class="btn btn-outline-success" 
                                                                title="Adicionar Novo" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalMovimentacao" 
                                                                onclick="prepararInclusaoMovimentacao()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicaoMovimentacao(<?= json_encode($mov) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalMovimentacao">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_movimentacao=<?= $mov['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir esta movimentação?')">
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
        <?php if (defined('APP_COMPONENTES')) { require_once APP_COMPONENTES . '/footer.php'; } ?>
    </section>

    <!-- MODAL DINÂMICO PARA REGISTRAR/EDITAR MOVIMENTAÇÃO -->
    <div class="modal fade" id="modalMovimentacao" tabindex="-1" aria-labelledby="modalMovimentacaoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalMovimentacaoLabel">
                        <i class="bi bi-arrow-left-right text-primary me-2"></i>
                        <span id="mov-modal-titulo">Movimentação de Estoque</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_movimentacao" value="1">
                    <input type="hidden" name="id_movimentacao" id="mov-id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="mov-produto-id" class="form-label small fw-medium">ID do Produto</label>
                            <input type="number" class="form-control" name="produto_id" id="mov-produto-id" required min="1">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="mov-tipo" class="form-label small fw-medium">Tipo de Movimento</label>
                                <select class="form-select" name="tipo" id="mov-tipo" required>
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saida">Saída</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="mov-quantidade" class="form-label small fw-medium">Quantidade</label>
                                <input type="number" class="form-control" name="quantidade" id="mov-quantidade" required min="1">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="mov-observacao" class="form-label small fw-medium">Observação</label>
                            <textarea class="form-control" name="observacao" id="mov-observacao" rows="3" placeholder="Insira observações relevantes (opcional)..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="mov-btn-submit">Salvar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS PARA INTERAÇÃO DO MODAL -->
    <script>
        function prepararInclusaoMovimentacao() {
            document.getElementById('mov-modal-titulo').innerText = "Adicionar Nova Movimentação";
            document.getElementById('mov-btn-submit').innerText = "Adicionar";
            document.getElementById('mov-id').value = "";
            document.getElementById('mov-produto-id').value = "";
            document.getElementById('mov-tipo').value = "Entrada";
            document.getElementById('mov-quantidade').value = "";
            document.getElementById('mov-observacao').value = "";
        }

        function prepararEdicaoMovimentacao(mov) {
            document.getElementById('mov-modal-titulo').innerText = "Editar Movimentação";
            document.getElementById('mov-btn-submit').innerText = "Salvar Alterações";
            document.getElementById('mov-id').value = mov.id;
            document.getElementById('mov-produto-id').value = mov.produto_id;
            document.getElementById('mov-tipo').value = mov.tipo;
            document.getElementById('mov-quantidade').value = mov.quantidade;
            document.getElementById('mov-observacao').value = mov.observacao ? mov.observacao : "";
        }
    </script>
</body>
</html>