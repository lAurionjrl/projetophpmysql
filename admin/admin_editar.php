<?php 
require_once __DIR__ . '/componentes/config.php';
require_once __DIR__ . '/componentes/rotas.php';
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

// --- AÇÃO: EXCLUIR USUÁRIO ---
if (isset($_GET['excluir'])) {
    $id_excluir = intval($_GET['excluir']);
    $stmt = $con->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->execute([$id_excluir]);
    header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
    exit;
}

// --- AÇÃO: SALVAR (ADICIONAR OU EDITAR) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['salvar_usuario'])) {
    $id = $_POST['id'];
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $nivel = $_POST['nivel'];
    $senha = $_POST['senha'];

    if (!empty($nome) && !empty($email) && !empty($nivel)) {
        if (!empty($id)) {
            // Modo Edição
            if (!empty($senha)) {
                $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
                $stmt = $con->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, nivel = ? WHERE id = ?");
                $stmt->execute([$nome, $email, $senha_hash, $nivel, $id]);
            } else {
                $stmt = $con->prepare("UPDATE usuarios SET nome = ?, email = ?, nivel = ? WHERE id = ?");
                $stmt->execute([$nome, $email, $nivel, $id]);
            }
        } else {
            // Modo Adicionar
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha, nivel) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $senha_hash, $nivel]);
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

// --- BUSCA DA LISTA DE USUÁRIOS ---
$usuarios = $con->query("SELECT * FROM usuarios ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

// --- 5 EXEMPLOS PREENCHIDOS NA TABELA SE NÃO HOUVER USUÁRIOS NO BANCO ---
if (empty($usuarios)) {
    $usuarios = [
        [
            'id' => 1,
            'nome' => 'Junior Lima',
            'email' => 'junior.lima@exemplo.com',
            'nivel' => 'Administrador',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 2,
            'nome' => 'Ana Beatriz',
            'email' => 'ana.beatriz@exemplo.com',
            'nivel' => 'Gerente',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 3,
            'nome' => 'Lucas Mendes',
            'email' => 'lucas.mendes@exemplo.com',
            'nivel' => 'Operador',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 4,
            'nome' => 'Carla Ferreira',
            'email' => 'carla.ferreira@exemplo.com',
            'nivel' => 'Gerente',
            'criado_em' => date('Y-m-d H:i:s')
        ],
        [
            'id' => 5,
            'nome' => 'Matheus Rocha',
            'email' => 'matheus.rocha@exemplo.com',
            'nivel' => 'Operador',
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
    <title>StockMaster - Gerenciamento de Usuários</title>

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
                    <h1 class="h2 mb-1 fw-bold text-body">Gerenciamento de Usuários</h1>
                    <p class="text-muted mb-0">Gerencie permissões, dados cadastrais e credenciais da equipe.</p>
                </div>
                <div class="col-12 col-md-6 col-lg-5 text-md-end d-flex gap-2 justify-content-md-end flex-wrap">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalUsuario" onclick="abrirModalCadastro()">
                        <i class="bi bi-plus-circle me-2"></i>Adicionar Usuário
                    </button>
                </div>
            </div>

            <!-- TABELA DE USUÁRIOS COM AÇÕES: ADICIONAR, EDITAR E EXCLUIR -->
            <div class="row g-3 mb-4">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="ps-4">ID</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Nível</th>
                                            <th>Criado em</th>
                                            <th class="pe-4 text-center" style="min-width: 180px;">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usr): ?>
                                            <tr>
                                                <td class="ps-4 text-secondary fw-medium">#<?= $usr['id'] ?></td>
                                                <td class="fw-semibold text-body"><?= htmlspecialchars($usr['nome']) ?></td>
                                                <td><?= htmlspecialchars($usr['email']) ?></td>
                                                <td>
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                                        <?= htmlspecialchars($usr['nivel']) ?>
                                                    </span>
                                                </td>
                                                <td><?= date('d/m/Y H:i', strtotime($usr['criado_em'])) ?></td>
                                                <td class="pe-4 text-center">
                                                    <div class="btn-group btn-group-sm" role="group" aria-label="Ações de Gerenciamento">
                                                        <!-- Botão Adicionar -->
                                                        <button class="btn btn-outline-success" 
                                                                title="Adicionar Novo" 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalUsuario" 
                                                                onclick="abrirModalCadastro()">
                                                            <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Adicionar</span>
                                                        </button>
                                                        <!-- Botão Editar -->
                                                        <button class="btn btn-outline-primary" 
                                                                title="Editar Registro" 
                                                                onclick='abrirModalEdicao(<?= json_encode($usr) ?>)' 
                                                                data-bs-toggle="modal" 
                                                                data-bs-target="#modalUsuario">
                                                            <i class="bi bi-pencil-square"></i> <span class="d-none d-md-inline">Editar</span>
                                                        </button>
                                                        <!-- Botão Excluir -->
                                                        <a href="?excluir=<?= $usr['id'] ?>" 
                                                           class="btn btn-outline-danger" 
                                                           title="Excluir Registro" 
                                                           onclick="return confirm('Tem certeza que deseja excluir este usuário?')">
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

    <!-- MODAL DINÂMICO PARA CADASTRAR / EDITAR USUÁRIO -->
    <div class="modal fade" id="modalUsuario" tabindex="-1" aria-labelledby="modalUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalUsuarioLabel">
                        <i class="bi bi-person-gear text-primary me-2"></i>
                        <span id="modal-titulo">Novo Usuário</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <input type="hidden" name="salvar_usuario" value="1">
                    <input type="hidden" name="id" id="user-id">
                    
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="user-nome" class="form-label small fw-medium">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="user-nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-email" class="form-label small fw-medium">E-mail</label>
                            <input type="email" class="form-control" name="email" id="user-email" required>
                        </div>
                        <div class="mb-3">
                            <label for="user-senha" class="form-label small fw-medium">Senha</label>
                            <input type="password" class="form-control" name="senha" id="user-senha">
                            <small class="text-muted d-none" id="senha-helper">Deixe em branco se não desejar alterar a senha atual.</small>
                        </div>
                        <div class="mb-3">
                            <label for="user-nivel" class="form-label small fw-medium">Nível de Acesso</label>
                            <select class="form-select" name="nivel" id="user-nivel" required>
                                <option value="">Selecione...</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Gerente">Gerente</option>
                                <option value="Operador">Operador</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary" id="btn-submit">Salvar Registro</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FUNÇÕES JS PARA CONTROLE DO MODAL DE AÇÕES -->
    <script>
        function abrirModalCadastro() {
            document.getElementById('modal-titulo').innerText = "Cadastrar Novo Usuário";
            document.getElementById('btn-submit').innerText = "Adicionar";
            document.getElementById('user-id').value = "";
            document.getElementById('user-nome').value = "";
            document.getElementById('user-email').value = "";
            document.getElementById('user-nivel').value = "";
            document.getElementById('user-senha').required = true;
            document.getElementById('senha-helper').classList.add('d-none');
        }

        function abrirModalEdicao(usuario) {
            document.getElementById('modal-titulo').innerText = "Editar Dados do Usuário";
            document.getElementById('btn-submit').innerText = "Salvar Alterações";
            document.getElementById('user-id').value = usuario.id;
            document.getElementById('user-nome').value = usuario.nome;
            document.getElementById('user-email').value = usuario.email;
            document.getElementById('user-nivel').value = usuario.nivel;
            document.getElementById('user-senha').required = false;
            document.getElementById('senha-helper').classList.remove('d-none');
        }
    </script>
</body>
</html>