<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

// --- LÓGICA DE EXCLUSÃO DE CATEGORIA ---
if (isset($_GET['excluir_categoria'])) {
    $id_excluir = intval($_GET['excluir_categoria']);
    $stmt = $con->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- LÓGICA DE SALVAMENTO (INSERIR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['persistir_categoria'])) {
    $id = $_POST['id_categoria'];
    $nome = trim($_POST['nome']);
    $descricao = !empty(trim($_POST['descricao'])) ? trim($_POST['descricao']) : null;
    $status = !empty($_POST['status']) ? $_POST['status'] : 'ativo';

    if (!empty($nome)) {
        if (!empty($id)) {
            // Editar Categoria Existente
            $stmt = $con->prepare("UPDATE categorias SET nome = ?, descricao = ?, status = ? WHERE id = ?");
            $stmt->execute([$nome, $descricao, $status, $id]);
        } else {
            // Inserir Nova Categoria
            $stmt = $con->prepare("INSERT INTO categorias (nome, descricao, status) VALUES (?, ?, ?)");
            $stmt->execute([$nome, $descricao, $status]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE CATEGORIAS ---
$categorias_lista = $con->query("SELECT * FROM categorias ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER REGISTROS NO BANCO ---
if (empty($categorias_lista)) {
    $categorias_lista = [
        [
            'id' => 1,
            'nome' => 'Eletrônicos',
            'descricao' => 'Dispositivos eletrônicos, periféricos e acessórios de informática.',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'nome' => 'Móveis & Escritório',
            'descricao' => 'Cadeiras ergonômicas, mesas, estantes e artigos de escritório.',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'nome' => 'Áudio & Vídeo',
            'descricao' => 'Headsets, caixas de som, microfones e monitores de alta definição.',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'nome' => 'Acessórios & Cabos',
            'descricao' => 'Cabos HDMI, adaptadores, hubs USB e organizadores.',
            'status' => 'ativo',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'nome' => 'Descontinuados',
            'descricao' => 'Produtos fora de linha ou com comercialização pausada.',
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
    <title>StockMaster - Gestão de Categorias</title>
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
                    <h1 class="h2 mb-1 fw-bold text-body">Gerenciamento de Categorias</h1>
                    <p class="text-muted mb-0">Organize seus produtos por categorias para facilitar a navegação e relatórios.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalGerenciarCategoria" onclick="prepararInclusaoCategoria()">
                        <i class="bi bi-plus-circle me-2"></i>Nova Categoria
                    </button>
                </div>
            </div>

            <!-- TABELA DE CATEGORIAS COM AÇÕES -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Nome da Categoria</th>
                                            <th>Descrição</th>
                                            <th>Status</th>
                                            <th>Data de Criação</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($categorias_lista as $cat): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $cat['id'] ?></td>
                                                <td>
                                                    <span class="fw-semibold text-body"><?= htmlspecialchars($cat['nome']) ?></span>
                                                </td>
                                                <td>
                                                    <?= !empty($cat['descricao']) ? htmlspecialchars($cat['descricao']) : '<em class="text-muted">Sem descrição</em>' ?>
                                                </td>
                                                <td>
                                                    <?php if (($cat['status'] ?? 'ativo') === 'ativo'): ?>
                                                        <span class="badge bg-success-subtle text-success rounded-pill px-2">Ativo</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-danger-subtle text-danger rounded-pill px-2">Inativo</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-secondary small">
                                                    <?= date('d/m/Y H:i', strtotime($cat['criado_em'])) ?>
                                                </td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Ações de Gerenciamento">
                                                        <!-- Botão Adicionar -->
                                                        <button class="btn btn-outline-success" 
                                                                title="Adicionar Novo" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarCategoria" 
                                                                onclick="prepararInclusaoCategoria()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='prepararEdicaoCategoria(<?= json_encode($cat) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalGerenciarCategoria">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir_categoria=<?= $cat['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir esta categoria?')">
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

    <!-- MODAL DINÂMICO PARA CADASTRAR E EDITAR CATEGORIA -->
    <div class="modal fade" id="modalGerenciarCategoria" tabindex="-1" aria-labelledby="modalGerenciarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalGerenciarCategoriaLabel">
                        <i class="bi bi-tags text-primary me-2"></i>
                        <span id="cat-modal-titulo">Categoria</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="persistir_categoria" value="1">
                    <input type="hidden" name="id_categoria" id="cat-id">

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cat-nome" class="form-label small fw-medium">Nome da Categoria</label>
                            <input type="text" class="form-control" name="nome" id="cat-nome" required maxlength="80">
                        </div>

                        <div class="mb-3">
                            <label for="cat-status" class="form-label small fw-medium">Status</label>
                            <select class="form-select" name="status" id="cat-status">
                                <option value="ativo">Ativo</option>
                                <option value="inativo">Inativo</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="cat-descricao" class="form-label small fw-medium">Descrição</label>
                            <textarea class="form-control" name="descricao" id="cat-descricao" rows="3" maxlength="255" placeholder="Breve descrição da categoria (opcional)..."></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="cat-btn-submit">Salvar Categoria</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- JS PARA CONTROLE DO MODAL DE CATEGORIAS -->
    <script>
        function prepararInclusaoCategoria() {
            document.getElementById('cat-modal-titulo').innerText = "Cadastrar Nova Categoria";
            document.getElementById('cat-btn-submit').innerText = "Adicionar";
            document.getElementById('cat-id').value = "";
            document.getElementById('cat-nome').value = "";
            document.getElementById('cat-descricao').value = "";
            document.getElementById('cat-status').value = "ativo";
        }

        function prepararEdicaoCategoria(cat) {
            document.getElementById('cat-modal-titulo').innerText = "Editar Categoria";
            document.getElementById('cat-btn-submit').innerText = "Salvar Alterações";
            document.getElementById('cat-id').value = cat.id;
            document.getElementById('cat-nome').value = cat.nome ? cat.nome : "";
            document.getElementById('cat-descricao').value = cat.descricao ? cat.descricao : "";
            document.getElementById('cat-status').value = cat.status ? cat.status : "ativo";
        }
    </script>
</body>
</html>