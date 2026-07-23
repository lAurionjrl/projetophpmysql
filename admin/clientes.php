<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';

// --- INCLUSÃO DO COMPONENTE DE CONEXÃO REQUISITADO ---
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
    $cidade = !empty(trim($_POST['cidade'])) ? trim($_POST['cidade']) : null;

    if (!empty($nome)) {
        if (!empty($id)) {
            // Ação: Editar Registro Existente
            $stmt = $con->prepare("UPDATE clientes SET nome = ?, email = ?, telefone = ?, cidade = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $telefone, $cidade, $id]);
        } else {
            // Ação: Inserir Novo Registro
            $stmt = $con->prepare("INSERT INTO clientes (nome, email, telefone, cidade) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $telefone, $cidade]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- SELEÇÃO DE TODOS OS CLIENTES ---
$clientes_lista = $con->query("SELECT * FROM clientes ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER CLIENTES NO BANCO ---
if (empty($clientes_lista)) {
    $clientes_lista = [
        [
            'id' => 1,
            'nome' => 'Ana Silva',
            'email' => 'ana.silva@exemplo.com',
            'telefone' => '(11) 98888-7777',
            'cidade' => 'São Paulo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'nome' => 'Carlos Souza',
            'email' => 'carlos.souza@exemplo.com',
            'telefone' => '(21) 97777-6666',
            'cidade' => 'Rio de Janeiro',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'nome' => 'Mariana Costa',
            'email' => 'mariana.costa@exemplo.com',
            'telefone' => '(31) 96666-5555',
            'cidade' => 'Belo Horizonte',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'nome' => 'Ricardo Oliveira',
            'email' => 'ricardo.oliveira@exemplo.com',
            'telefone' => '(51) 95555-4444',
            'cidade' => 'Porto Alegre',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'nome' => 'Fernanda Lima',
            'email' => 'fernanda.lima@exemplo.com',
            'telefone' => '(61) 94444-3333',
            'cidade' => 'Brasília',
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
    <title>StockMaster - Gerenciamento de Clientes</title>

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
                    <h1 class="h2 mb-1 fw-bold text-body">Gerenciamento de Clientes</h1>
                    <p class="text-muted mb-0">Administre o cadastro de clientes do StockMaster.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarCliente" onclick="prepararInclusao()">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Cliente
                    </button>
                </div>
            </div>

            <!-- TABELA DE CLIENTES COM AÇÕES: ADICIONAR, EDITAR E EXCLUIR -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Nome Completo</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>Cidade</th>
                                            <th>Criado em</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes_lista as $cliente): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $cliente['id'] ?></td>
                                                <td class="fw-semibold text-body"><?= htmlspecialchars($cliente['nome']) ?></td>
                                                <td><?= $cliente['email'] ? htmlspecialchars($cliente['email']) : '<em class="text-muted">Não informado</em>' ?></td>
                                                <td><?= $cliente['telefone'] ? htmlspecialchars($cliente['telefone']) : '<em class="text-muted">Não informado</em>' ?></td>
                                                <td>
                                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                                        <?= $cliente['cidade'] ? htmlspecialchars($cliente['cidade']) : 'Não informada' ?>
                                                    </span>
                                                </td>
                                                <td><?= date('d/m/Y H:i', strtotime($cliente['criado_em'])) ?></td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Ações de Gerenciamento">
                                                        <!-- Botão Adicionar (Ação rápida) -->
                                                        <button class="btn btn-outline-success" 
                                                                title="Adicionar Novo" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarCliente" 
                                                                onclick="prepararInclusao()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicao(<?= json_encode($cliente) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarCliente">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_cliente=<?= $cliente['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Confirmar a exclusão deste cliente permanentemente?')">
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

    <!-- MODAL INTEGRADO PARA ADICIONAR E EDITAR -->
    <div class="modal fade" id="modalGerenciarCliente" tabindex="-1" aria-labelledby="modalGerenciarClienteLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGerenciarClienteLabel">
                        <i class="bi bi-person-lines-fill text-primary me-2"></i>
                        <span id="titulo-contexto-modal">Cliente</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_cliente" value="1">
                    <input type="hidden" name="id_cliente" id="input-cliente-id">
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="input-cliente-nome" class="form-label small fw-medium">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="input-cliente-nome" required maxlength="120">
                        </div>
                        <div class="mb-3">
                            <label for="input-cliente-email" class="form-label small fw-medium">E-mail</label>
                            <input type="email" class="form-control" name="email" id="input-cliente-email" maxlength="120">
                        </div>
                        <div class="row g-2">
                            <div class="col-6 mb-3">
                                <label for="input-cliente-telefone" class="form-label small fw-medium">Telefone</label>
                                <input type="text" class="form-control" name="telefone" id="input-cliente-telefone" maxlength="20">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="input-cliente-cidade" class="form-label small fw-medium">Cidade</label>
                                <input type="text" class="form-control" name="cidade" id="input-cliente-cidade" maxlength="80">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="botao-submit-modal">Salvar Dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS PARA ALTERAÇÃO DINÂMICA ENTRE INCLUSÃO E EDIÇÃO -->
    <script>
        function prepararInclusao() {
            document.getElementById('titulo-contexto-modal').innerText = "Adicionar Novo Cliente";
            document.getElementById('botao-submit-modal').innerText = "Adicionar";
            document.getElementById('input-cliente-id').value = "";
            document.getElementById('input-cliente-nome').value = "";
            document.getElementById('input-cliente-email').value = "";
            document.getElementById('input-cliente-telefone').value = "";
            document.getElementById('input-cliente-cidade').value = "";
        }

        function prepararEdicao(dadosCliente) {
            document.getElementById('titulo-contexto-modal').innerText = "Editar Cliente";
            document.getElementById('botao-submit-modal').innerText = "Salvar Alterações";
            document.getElementById('input-cliente-id').value = dadosCliente.id;
            document.getElementById('input-cliente-nome').value = dadosCliente.nome;
            document.getElementById('input-cliente-email').value = dadosCliente.email ? dadosCliente.email : "";
            document.getElementById('input-cliente-telefone').value = dadosCliente.telefone ? dadosCliente.telefone : "";
            document.getElementById('input-cliente-cidade').value = dadosCliente.cidade ? dadosCliente.cidade : "";
        }
    </script>
</body>
</html>