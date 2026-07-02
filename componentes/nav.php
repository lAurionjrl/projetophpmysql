<nav class="navbar navbar-expand-lg navbar-dark" aria-label="Navegação principal">
    <div class="container">

        <!-- Logo / Nome do projeto -->
        <a class="navbar-brand d-flex align-items-center gap-2" href="/" aria-label="Controle de Estoque - Página inicial">
            <div class="brand-icon d-flex align-items-center justify-content-center rounded-3">
                <i class="bi bi-box-seam" aria-hidden="true"></i>
            </div>
            <span class="fw-bold">Controle de Estoque</span>
        </a>

        <!-- Botão hambúrguer para telas pequenas -->
        <button 
            class="navbar-toggler border-0 shadow-none" 
            type="button" 
            data-bs-toggle="collapse"
            data-bs-target="#menuNavbar"
            aria-controls="menuNavbar"
            aria-expanded="false"
            aria-label="Alternar menu de navegação"
        >
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu de navegação -->
        <div class="collapse navbar-collapse" id="menuNavbar">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center gap-lg-1">

                <li class="nav-item">
                    <a class="nav-link active d-flex align-items-center gap-2 px-3 rounded-2" href="/" aria-current="page">
                        <i class="bi bi-house-door" aria-hidden="true"></i>
                        <span>Início</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 px-3 rounded-2" href="/produtos">
                        <i class="bi bi-box" aria-hidden="true"></i>
                        <span>Produtos</span>
                    </a>
                </li>

                <!-- Dropdown: Aulas -->
                <li class="nav-item ">
                    <a href="aulas/aula1_variaveis/"
                        class="nav-link d-flex align-items-center gap-2 px-3 rounded-2" 
                        href="#" 
                        role="button"
                       
                        id="menuAulas"
                    >
                        <i class="bi bi-book" aria-hidden="true"></i>
                        <span>Aulas</span>
                    </a>

                    
                </li>

                <!-- Separador visual em desktop -->
                <li class="nav-item d-none d-lg-block">
                    <div class="vr mx-2" style="height: 24px; opacity: 0.3;"></div>
                </li>

                <!-- Botão de ação rápida -->
                <li class="nav-item mt-2 mt-lg-0">
                    <a href="/produtos/novo" class="btn btn-light btn-sm fw-semibold d-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg" aria-hidden="true"></i>
                        Novo Produto
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>