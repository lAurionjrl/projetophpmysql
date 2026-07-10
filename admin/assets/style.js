
        document.addEventListener('DOMContentLoaded', () => {

            // 1. Mostrar Data Atual Dinamicamente
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('current-date').textContent = new Date().toLocaleDateString('pt-BR', options);

            // 2. Comportamento Colapsável do Menu Lateral (Layout Desktop)
            const btnCollapseSidebar = document.getElementById('btn-collapse-sidebar');
            btnCollapseSidebar.addEventListener('click', () => {
                document.body.classList.toggle('sidebar-collapsed');
                const icon = btnCollapseSidebar.querySelector('i');
                if (document.body.classList.contains('sidebar-collapsed')) {
                    icon.className = 'bi bi-arrow-bar-right fs-5';
                } else {
                    icon.className = 'bi bi-arrow-bar-left fs-5';
                }
            });

            // 3. Comportamento de Menu Lateral em Dispositivos Móveis
            const btnToggleMobile = document.getElementById('btn-toggle-mobile');
            btnToggleMobile.addEventListener('click', (e) => {
                e.stopPropagation();
                document.body.classList.toggle('sidebar-open');
            });

            // Fechar menu mobile ao clicar fora dele
            document.addEventListener('click', (e) => {
                if (document.body.classList.contains('sidebar-open') && !document.getElementById('sidebar').contains(e.target)) {
                    document.body.classList.remove('sidebar-open');
                }
            });

            // 4. Alternador de Tema Claro / Escuro (Bootstrap 5.3 nativo)
            const btnThemeToggle = document.getElementById('btn-theme-toggle');
            const themeIcon = document.getElementById('theme-icon');

            btnThemeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-bs-theme');
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                document.documentElement.setAttribute('data-bs-theme', newTheme);

                // Mudar ícone do tema
                if (newTheme === 'dark') {
                    themeIcon.className = 'bi bi-sun fs-5';
                } else {
                    themeIcon.className = 'bi bi-moon-stars fs-5';
                }
            });

            // 5. Configuração dos Gráficos com Chart.js
            // Gráfico de Linhas / Barras Combinadas - Movimentações
            const ctxMovimentacoes = document.getElementById('chartMovimentacoes').getContext('2d');
            new Chart(ctxMovimentacoes, {
                type: 'line',
                data: {
                    labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
                    datasets: [{
                        label: 'Entradas',
                        data: [340, 410, 390, 480, 520, 420],
                        borderColor: '#198754',
                        backgroundColor: 'rgba(25, 135, 84, 0.1)',
                        tension: 0.3,
                        fill: true
                    }, {
                        label: 'Saídas',
                        data: [290, 320, 360, 410, 440, 385],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        tension: 0.3,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Gráfico de Rosca - Categorias
            const ctxCategorias = document.getElementById('chartCategorias').getContext('2d');
            new Chart(ctxCategorias, {
                type: 'doughnut',
                data: {
                    labels: ['Eletrônicos', 'Alimentos', 'Vestuário', 'Outros'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: ['#0d6efd', '#198754', '#ffc107', '#6c757d']
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
   