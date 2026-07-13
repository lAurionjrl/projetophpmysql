<?php
$nav="0";
if(!empty($_GET['nav'])) {
    $nav = $_GET['nav'];
}
?>
<nav class="overflow-y-auto" style="height: calc(100vh - 150px);">
            <ul class="nav flex-column py-2">
                <li class="nav-item">
                    <a href="index.php?nav=0" class="nav-link <?= $nav==0?'active':'';?>" aria-current="page">
                        <i class="bi bi-speedometer2 me-3"></i><span class="sidebar-text">Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="#submenuProdutos" <?= $nav==1?'active':'';?> class="nav-link dropdown-toggle" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenuProdutos">
                        <i class="bi bi-box-seam me-3"></i><span class="sidebar-text">Produtos</span>
                    </a>
                    <div class="collapse submenu" id="submenuProdutos">
                        <ul class="nav flex-column ps-2">
                            <li><a href="produtos.php?nav=1" class="nav-link">Listar produtos</a></li>
                            <li><a href="produtoscadastro.php?nav=1" class="nav-link">Novo produto</a></li>
                            <li><a href="estoque.php?nav=1" class="nav-link">Estoque </a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="categorias.php" class="nav-link">
                        <i class="bi bi-tags me-3"></i><span class="sidebar-text">Categorias</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#submenuEstoque"<?= $nav==2?'active':'';?> class="nav-link dropdown-toggle" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenuEstoque">
                        <i class="bi bi-houses me-3"></i><span class="sidebar-text">Estoque</span>
                    </a>
                    <div class="collapse submenu" id="submenuEstoque">
                        <ul class="nav flex-column ps-2">
                            <li><a href="produtos_editar?nav=2.php" class="nav-link">Movimentações</a></li>
                            <li><a href="entrada_estoque.php?nav=2" class="nav-link">Entrada de estoque</a></li>
                            <li><a href="saida_estoque.php?nav=2" class="nav-link">Saída de estoque</a></li>
                            <li><a href="produtos_relatorios?nav=2" class="nav-link">Inventário</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-box-arrow-in-right me-3"></i><span class="sidebar-text">Entradas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-box-arrow-left me-3"></i><span class="sidebar-text">Saídas</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-people me-3"></i><span class="sidebar-text">Clientes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-cart me-3"></i><span class="sidebar-text">Pedidos</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#submenuRelatorios" class="nav-link dropdown-toggle" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="submenuRelatorios">
                        <i class="bi bi-bar-chart-line me-3"></i><span class="sidebar-text">Relatórios</span>
                    </a>
                    <div class="collapse submenu" id="submenuRelatorios">
                        <ul class="nav flex-column ps-2">
                            <li><a href="produtos_relatorios" class="nav-link">Vendas</a></li>
                            <li><a href="#" class="nav-link">Perdas</a></li>
                            <li><a href="#" class="nav-link">Curva ABC</a></li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-person-gear me-3"></i><span class="sidebar-text">Usuários</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-gear me-3"></i><span class="sidebar-text">Configurações</span>
                    </a>
                </li>
                <li class="nav-item mt-4 border-top">
                    <a href="#" class="nav-link text-danger">
                        <i class="bi bi-box-arrow-right me-3"></i><span class="sidebar-text">Sair</span>
                    </a>
                </li>
            </ul>
        </nav>