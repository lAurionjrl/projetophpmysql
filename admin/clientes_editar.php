<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

// --- LÓGICA DE EXCLUSÃO DE CLIENTE ---
if (isset($_GET['excluir_cliente'])) {
    $id_excluir = intval($_GET['excluir_cliente']);
    $stmt = $con->prepare("DELETE FROM clientes WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- LÓGICA DE SALVAMENTO (INSERIR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['persistir_cliente'])) {
    $id = $_POST['id_cliente'];
    $nome = trim($_POST['nome']);
    $email = !empty(trim($_POST['email'])) ? trim($_POST['email']) : null;
    $telefone = !empty(trim($_POST['telefone'])) ? trim($_POST['telefone']) : null;
    $cpf_cnpj = !empty(trim($_POST['cpf_cnpj'])) ? trim($_POST['cpf_cnpj']) : null;
    $cidade = !empty(trim($_POST['cidade'])) ? trim($_POST['cidade']) : null;
    $status = !empty($_POST['status']) ? $_POST['status'] : 'ativo';

    if (!empty($nome)) {
        if (!empty($id)) {
            // Editar Cliente Existente
            $stmt = $con->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, cpf_cnpj = ?, cidade = ?, status = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $cidade, $status, $id]);
        } else {
            // Inserir Novo Cliente
            $stmt = $con->prepare("INSERT INTO clientes (nome, email, telefone, cpf_cnpj, cidade, status) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $telefone, $cpf_cnpj, $cidade, $status]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE CLIENTES ---
$clientes_lista = [];
try {
    $clientes_lista = $con->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Tabela ainda não criada ou erro de consulta
    $clientes_lista = [];
}

// --- 5 EXEMPLOS PREENCHIDOS SE NÃO HOUVER REGISTROS ---
if (empty($clientes_lista)) {
    $clientes_lista = [
        [
            'id' => 1,
            'nome' => 'Carlos Eduardo Silva',
            'email' => 'carlos.silva@email.com',
            'telefone' => '(11) 98765-4321',
            'cpf_cnpj' => '123.456.789-00',
            'cidade' => 'São Paulo / SP',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s', strtotime('-2 days'))
        ],
        [
            'id' => 2,
            'nome' => 'Mariana Oliveira Tech LTDA',
            'email' => 'contato@marianatech.com.br',
            'telefone' => '(21) 3344-5566',
            'cpf_cnpj' => '12.345.678/0001-90',
            'cidade' => 'Rio de Janeiro / RJ',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s', strtotime('-5 days'))
        ],
        [
            'id' => 3,
            'nome' => 'Fernanda Souza',
            'email' => 'fernanda.souza@gmail.com',
            'telefone' => '(31) 99123-8877',
            'cpf_cnpj' => '987.654.321-11',
            'cidade' => 'Belo Horizonte / MG',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s', strtotime('-1 week'))
        ],
        [
            'id' => 4,
            'nome' => 'Lucas Rocha Comércio',
            'email' => 'financeiro@lucasrocha.com',
            'telefone' => '(41) 98877-1122',
            'cpf_cnpj' => '98.765.432/0001-10',
            'cidade' => 'Curitiba / PR',
            'status' => 'inativo',
            'criado_em' => date('Y-m-d H:i:s', strtotime('-2 weeks'))
        ],
        [
            'id' => 5,
            'nome' => 'Beatriz Mendes Pereira',
            'email' => 'beatriz.mendes@hotmail.com',
            'telefone' => '(85) 99654-3210',
            'cpf_cnpj' => '456.789.123-44',
            'cidade' => 'Fortaleza / CE',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s', strtotime('-1 month'))
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockMaster - Gestão de Clientes</title>
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
                    <h1 class="h2 mb-1 fw-bold text-body">Gerenciamento de Clientes</h1>
                    <p class="text-muted mb-0">Cadastre, edite e acompanhe as informações dos seus clientes.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarCliente" onclick="prepararInclusaoCliente()">
                        <i class="bi bi-person-plus me-2"></i>Novo Cliente
                    </button>
                </div>
            </div>

            <!-- TABELA DE CLIENTES COM AÇÕES -->
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
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>CPF / CNPJ</th>
                                            <th>Cidade</th>
                                            <th>Status</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes_lista as $cli): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $cli['id'] ?></td>
                                                <td>
                                                    <span class="fw-semibold text-body"><?= htmlspecialchars($cli['nome']) ?></span>
                                                </td>
                                                <td>
                                                    <?= !empty($cli['email']) ? htmlspecialchars($cli['email']) : '<em class="text-muted">Não informado</em>' ?>
                                                </td>
                                                <td>
                                                    <?= !empty($cli['telefone']) ? htmlspecialchars($cli['telefone']) : '<em class="text-muted">Não informado</em>' ?>
                                                </td>
                                                <td>
                                                    <?= !empty($cli['cpf_cnpj']) ? htmlspecialchars($cli['cpf_cnpj']) : '<em class="text-muted">-</em>' ?>
                                                </td>
                                                <td>
                                                    <?= !empty($cli['cidade']) ? htmlspecialchars($cli['cidade']) : '<em class="text-muted">-</em>' ?>
                                                </td>
                                                <td>
                                                    <?php if (($cli['status'] ?? 'ativo') === 'ativo'): ?>
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
                                                                data-bs-target="#modalGerenciarCliente" 
                                                                onclick="prepararInclusaoCliente()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicaoCliente(<?= json_encode($cli) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarCliente">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_cliente=<?= $cli['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir este cliente?')">
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

    <!-- MODAL DINÂMICO PARA CADASTRAR E EDITAR CLIENTE -->
    <div class="modal fade" id="modalGerenciarCliente" tabindex="-1" aria-labelledby="modalGerenciarClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGerenciarClienteLabel">
                        <i class="bi bi-person text-primary me-2"></i>
                        <span id="cli-modal-titulo">Cliente</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_cliente" value="1">
                    <input type="hidden" name="id_cliente" id="cli-id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cli-nome" class="form-label small fw-medium">Nome / Razão Social</label>
                            <input type="text" class="form-control" name="nome" id="cli-nome" required placeholder="Ex: Maria Silva">
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="cli-email" class="form-label small fw-medium">E-mail</label>
                                <input type="email" class="form-control" name="email" id="cli-email" placeholder="cliente@email.com">
                            </div>
                            <div class="col-6">
                                <label for="cli-telefone" class="form-label small fw-medium">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="cli-telefone" placeholder="(00) 00000-0000">
                            </div>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label for="cli-cpf-cnpj" class="form-label small fw-medium">CPF / CNPJ</label>
                                <input type="text" class="form-control" name="cpf_cnpj" id="cli-cpf-cnpj" placeholder="000.000.000-00">
                            </div>
                            <div class="col-6">
                                <label for="cli-cidade" class="form-label small fw-medium">Cidade / UF</label>
                                <input type="text" class="form-control" name="cidade" id="cli-cidade" placeholder="Ex: São Paulo / SP">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cli-status" class="form-label small fw-medium">Status</label>
                            <select class="form-select" name="status" id="cli-status">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="cli-btn-submit">Salvar Cliente</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS PARA CONTROLE DO MODAL DE CLIENTES -->
    <script>
        function prepararInclusaoCliente() {
            document.getElementById('cli-modal-titulo').innerText = "Cadastrar Novo Cliente";
            document.getElementById('cli-btn-submit').innerText = "Adicionar";
            document.getElementById('cli-id').value = "";
            document.getElementById('cli-nome').value = "";
            document.getElementById('cli-email').value = "";
            document.getElementById('cli-telefone').value = "";
            document.getElementById('cli-cpf-cnpj').value = "";
            document.getElementById('cli-cidade').value = "";
            document.getElementById('cli-status').value = "ativo";
        }

        function prepararEdicaoCliente(cli) {
            document.getElementById('cli-modal-titulo').innerText = "Editar Cliente";
            document.getElementById('cli-btn-submit').innerText = "Salvar Alterações";
            document.getElementById('cli-id').value = cli.id;
            document.getElementById('cli-nome').value = cli.nome ? cli.nome : "";
            document.getElementById('cli-email').value = cli.email ? cli.email : "";
            document.getElementById('cli-telefone').value = cli.telefone ? cli.telefone : "";
            document.getElementById('cli-cpf-cnpj').value = cli.cpf_cnpj ? cli.cpf_cnpj : "";
            document.getElementById('cli-cidade').value = cli.cidade ? cli.cidade : "";
            document.getElementById('cli-status').value = cli.status ? cli.status : "ativo";
        }
    </script>
</body>
</html>