 <header class="d-flex align-items-center px-4 justify-content-between shadow-sm">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="btn-toggle-mobile" aria-label="Abrir menu">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <form class="d-none d-md-flex" role="search">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input class="form-control bg-light border-start-0" type="search" placeholder="Buscar produtos, SKU, lotes..." aria-label="Pesquisa global">
                    </div>
                </form>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <button class="btn btn-light position-relative p-2 rounded-circle" type="button" data-bs-toggle="dropdown" aria-label="Notificações">
                        <i class="bi bi-bell fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            3
                        </span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow p-2" style="width: 280px;">
                        <li><h6 class="dropdown-header">Notificações</h6></li>
                        <li><a class="dropdown-item rounded small text-wrap py-2" href="#"><i class="bi bi-exclamation-triangle-fill text-warning me-2"></i> 5 produtos atingiram o estoque mínimo.</a></li>
                        <li><a class="dropdown-item rounded small text-wrap py-2" href="#"><i class="bi bi-box-arrow-in-right text-success me-2"></i> Nova entrada de mercadoria registrada.</a></li>
                    </ul>
                </div>

                <button class="btn btn-light p-2 rounded-circle d-none d-sm-inline-block" aria-label="Mensagens">
                    <i class="bi bi-chat-left-text fs-5"></i>
                </button>

                <button class="btn btn-light p-2 rounded-circle" id="btn-theme-toggle" aria-label="Mudar tema visual">
                    <i class="bi bi-moon-stars fs-5" id="theme-icon"></i>
                </button>

                <hr class="vertical-divider d-none d-sm-block mx-1" style="height: 24px; width: 1px; background-color: var(--bs-border-color);">

                <div class="dropdown">
                    <button class="btn btn-link d-flex align-items-center gap-2 text-decoration-none p-0 dropdown-toggle text-body" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="" class="rounded-circle" width="32" height="32">
                        <span class="d-none d-md-inline small fw-medium">Junior Lima</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Meu perfil</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Configurações</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i> Sair</a></li>
                    </ul>
                </div>
            </div>
        </header>
