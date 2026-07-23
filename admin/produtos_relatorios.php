<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

// --- LÓGICA DE EXCLUSÃO DE FORNECEDOR ---
if (isset($_GET['excluir_fornecedor'])) {
    $id_excluir = intval($_GET['excluir_fornecedor']);
    $stmt = $con->prepare("DELETE FROM fornecedores WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- LÓGICA DE SALVAMENTO (INSERIR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['persistir_fornecedor'])) {
    $id = $_POST['id_fornecedor'];
    $nome = trim($_POST['nome']);
    $razao_social = !empty(trim($_POST['razao_social'])) ? trim($_POST['razao_social']) : null;
    $cnpj = !empty(trim($_POST['cnpj'])) ? trim($_POST['cnpj']) : null;
    $email = !empty(trim($_POST['email'])) ? trim($_POST['email']) : null;
    $telefone = !empty(trim($_POST['telefone'])) ? trim($_POST['telefone']) : null;
    $contato = !empty(trim($_POST['contato'])) ? trim($_POST['contato']) : null;
    $endereco = !empty(trim($_POST['endereco'])) ? trim($_POST['endereco']) : null;
    $cidade = !empty(trim($_POST['cidade'])) ? trim($_POST['cidade']) : null;
    $estado = !empty(trim($_POST['estado'])) ? trim($_POST['estado']) : null;
    $cep = !empty(trim($_POST['cep'])) ? trim($_POST['cep']) : null;
    $status = !empty($_POST['status']) ? $_POST['status'] : 'ativo';

    if (!empty($nome)) {
        if (!empty($id)) {
            // Editar Fornecedor Existente
            $stmt = $con->prepare("UPDATE fornecedores SET nome = ?, razao_social = ?, cnpj = ?, email = ?, telefone = ?, contato = ?, endereco = ?, cidade = ?, estado = ?, cep = ?, status = ? WHERE id = ?");
            $stmt->execute([$nome, $razao_social, $cnpj, $email, $telefone, $contato, $endereco, $cidade, $estado, $cep, $status, $id]);
        } else {
            // Inserir Novo Fornecedor
            $stmt = $con->prepare("INSERT INTO fornecedores (nome, razao_social, cnpj, email, telefone, contato, endereco, cidade, estado, cep, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $razao_social, $cnpj, $email, $telefone, $contato, $endereco, $cidade, $estado, $cep, $status]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE FORNECEDORES ---
$fornecedores_lista = $con->query("SELECT * FROM fornecedores ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER REGISTROS NO BANCO ---
if (empty($fornecedores_lista)) {
    $fornecedores_lista = [
        [
            'id' => 1,
            'nome' => 'TechSuprimentos Ltda',
            'razao_social' => 'TechSuprimentos Comércio e Serviços LTDA',
            'cnpj' => '12.345.678/0001-90',
            'email' => 'contato@techsuprimentos.com',
            'telefone' => '(11) 3344-5566',
            'contato' => 'Carlos Silva',
            'endereco' => 'Av. Paulista, 1000',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'cep' => '01310-100',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'nome' => 'Mega Distribuidora',
            'razao_social' => 'Mega Distribuidora de Eletrônicos S.A.',
            'cnpj' => '98.765.432/0001-10',
            'email' => 'vendas@megadistribuidora.com',
            'telefone' => '(21) 2555-0199',
            'contato' => 'Ana Paula',
            'endereco' => 'Rua Primeiro de Março, 45',
            'cidade' => 'Rio de Janeiro',
            'estado' => 'RJ',
            'cep' => '20010-000',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'nome' => 'Global Logística',
            'razao_social' => 'Global Logística e Transportes EIRELI',
            'cnpj' => '45.678.912/0001-33',
            'email' => 'atendimento@globallog.com.br',
            'telefone' => '(31) 3212-4400',
            'contato' => 'Roberto Alves',
            'endereco' => 'Av. do Contorno, 5000',
            'cidade' => 'Belo Horizonte',
            'estado' => 'MG',
            'cep' => '30110-000',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'nome' => 'Comercial Nordeste',
            'razao_social' => 'Comercial Nordeste Atacadista LTDA',
            'cnpj' => '23.456.789/0001-44',
            'email' => 'comercial@nordesteatracao.com',
            'telefone' => '(85) 3400-8800',
            'contato' => 'Mariana Costa',
            'endereco' => 'Av. Washington Soares, 1200',
            'cidade' => 'Fortaleza',
            'estado' => 'CE',
            'cep' => '60811-341',
            'status' => 'inativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'nome' => 'Sul Componentes',
            'razao_social' => 'Sul Componentes Industriais LTDA',
            'cnpj' => '34.567.890/0001-55',
            'email' => 'suporte@sulcomponentes.com.br',
            'telefone' => '(51) 3322-1100',
            'contato' => 'Fernando Dias',
            'endereco' => 'Rua Voluntários da Pátria, 800',
            'cidade' => 'Porto Alegre',
            'estado' => 'RS',
            'cep' => '90030-000',
            'status' => 'ativo',
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
    <title>StockMaster - Relatório de Fornecedores</title>
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
                    <h1 class="h2 mb-1 fw-bold text-body">Relatórios de Fornecedores</h1>
                    <p class="text-muted mb-0">Consulte e gerencie os parceiros e fornecedores cadastrados na sua base.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarFornecedor" onclick="prepararInclusaoFornecedor()">
                        <i class="bi bi-plus-circle me-2"></i>Novo Fornecedor
                    </button>
                </div>
            </div>

            <!-- TABELA DE FORNECEDORES COM AÇÕES -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Nome / Razão Social</th>
                                            <th>CNPJ</th>
                                            <th>Contato / E-mail</th>
                                            <th>Cidade/UF</th>
                                            <th>Status</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($fornecedores_lista as $forn): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $forn['id'] ?></td>
                                                <td>
                                                    <div class="fw-semibold text-body"><?= htmlspecialchars($forn['nome']) ?></div>
                                                    <small class="text-muted"><?= htmlspecialchars($forn['razao_social'] ?? '-') ?></small>
                                                </td>
                                                <td class="fw-medium text-body-secondary"><?= htmlspecialchars($forn['cnpj'] ?? '-') ?></td>
                                                <td>
                                                    <div><i class="bi bi-person me-1 text-muted"></i><?= htmlspecialchars($forn['contato'] ?? '-') ?></div>
                                                    <small class="text-muted"><i class="bi bi-envelope me-1"></i><?= htmlspecialchars($forn['email'] ?? '-') ?></small>
                                                </td>
                                                <td>
                                                    <?php if (!empty($forn['cidade']) || !empty($forn['estado'])): ?>
                                                        <?= htmlspecialchars($forn['cidade'] ?? '') ?><?= (!empty($forn['cidade']) && !empty($forn['estado'])) ? '/' : '' ?><?= htmlspecialchars($forn['estado'] ?? '') ?>
                                                    <?php else: ?>
                                                        <span class="text-muted">-</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (($forn['status'] ?? 'ativo') === 'ativo'): ?>
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
                                                                data-bs-target="#modalGerenciarFornecedor" 
                                                                onclick="prepararInclusaoFornecedor()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicaoFornecedor(<?= json_encode($forn) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarFornecedor">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_fornecedor=<?= $forn['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir este fornecedor?')">
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

    <!-- MODAL DINÂMICO PARA CADASTRAR E EDITAR FORNECEDOR -->
    <div class="modal fade" id="modalGerenciarFornecedor" tabindex="-1" aria-labelledby="modalGerenciarFornecedorLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGerenciarFornecedorLabel">
                        <i class="bi bi-truck text-primary me-2"></i>
                        <span id="forn-modal-titulo">Fornecedor</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_fornecedor" value="1">
                    <input type="hidden" name="id_fornecedor" id="forn-id">

                    <div class="modal-body">
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label for="forn-nome" class="form-label small fw-medium">Nome Fantasia</label>
                                <input type="text" class="form-control" name="nome" id="forn-nome" required maxlength="120">
                            </div>
                            <div class="col-md-6">
                                <label for="forn-razao" class="form-label small fw-medium">Razão Social</label>
                                <input type="text" class="form-control" name="razao_social" id="forn-razao" maxlength="150">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-4">
                                <label for="forn-cnpj" class="form-label small fw-medium">CNPJ</label>
                                <input type="text" class="form-control" name="cnpj" id="forn-cnpj" placeholder="00.000.000/0000-00" maxlength="18">
                            </div>
                            <div class="col-md-4">
                                <label for="forn-contato" class="form-label small fw-medium">Pessoa de Contato</label>
                                <input type="text" class="form-control" name="contato" id="forn-contato" maxlength="100">
                            </div>
                            <div class="col-md-4">
                                <label for="forn-status" class="form-label small fw-medium">Status</label>
                                <select class="form-select" name="status" id="forn-status">
                                    <option value="ativo">Ativo</option>
                                    <option value="inativo">Inativo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label for="forn-email" class="form-label small fw-medium">E-mail</label>
                                <input type="email" class="form-control" name="email" id="forn-email" maxlength="120">
                            </div>
                            <div class="col-md-6">
                                <label for="forn-telefone" class="form-label small fw-medium">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="forn-telefone" maxlength="20">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label for="forn-endereco" class="form-label small fw-medium">Endereço</label>
                                <input type="text" class="form-control" name="endereco" id="forn-endereco" maxlength="180">
                            </div>
                            <div class="col-md-3">
                                <label for="forn-cidade" class="form-label small fw-medium">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="forn-cidade" maxlength="80">
                            </div>
                            <div class="col-md-1">
                                <label for="forn-estado" class="form-label small fw-medium">UF</label>
                                <input type="text" class="form-control text-uppercase" name="estado" id="forn-estado" maxlength="2">
                            </div>
                            <div class="col-md-2">
                                <label for="forn-cep" class="form-label small fw-medium">CEP</label>
                                <input type="text" class="form-control" name="cep" id="forn-cep" maxlength="10">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="forn-btn-submit">Salvar Fornecedor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS PARA CONTROLE DO MODAL DE FORNECEDORES -->
    <script>
        function prepararInclusaoFornecedor() {
            document.getElementById('forn-modal-titulo').innerText = "Cadastrar Novo Fornecedor";
            document.getElementById('forn-btn-submit').innerText = "Adicionar";
            document.getElementById('forn-id').value = "";
            document.getElementById('forn-nome').value = "";
            document.getElementById('forn-razao').value = "";
            document.getElementById('forn-cnpj').value = "";
            document.getElementById('forn-email').value = "";
            document.getElementById('forn-telefone').value = "";
            document.getElementById('forn-contato').value = "";
            document.getElementById('forn-endereco').value = "";
            document.getElementById('forn-cidade').value = "";
            document.getElementById('forn-estado').value = "";
            document.getElementById('forn-cep').value = "";
            document.getElementById('forn-status').value = "ativo";
        }

        function prepararEdicaoFornecedor(forn) {
            document.getElementById('forn-modal-titulo').innerText = "Editar Fornecedor";
            document.getElementById('forn-btn-submit').innerText = "Salvar Alterações";
            document.getElementById('forn-id').value = forn.id;
            document.getElementById('forn-nome').value = forn.nome ? forn.nome : "";
            document.getElementById('forn-razao').value = forn.razao_social ? forn.razao_social : "";
            document.getElementById('forn-cnpj').value = forn.cnpj ? forn.cnpj : "";
            document.getElementById('forn-email').value = forn.email ? forn.email : "";
            document.getElementById('forn-telefone').value = forn.telefone ? forn.telefone : "";
            document.getElementById('forn-contato').value = forn.contato ? forn.contato : "";
            document.getElementById('forn-endereco').value = forn.endereco ? forn.endereco : "";
            document.getElementById('forn-cidade').value = forn.cidade ? forn.cidade : "";
            document.getElementById('forn-estado').value = forn.estado ? forn.estado : "";
            document.getElementById('forn-cep').value = forn.cep ? forn.cep : "";
            document.getElementById('forn-status').value = forn.status ? forn.status : "ativo";
        }
    </script>
</body>
</html>