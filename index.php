<?php require_once __DIR__ . '/componentes/config.php'; ?>
<?php require_once __DIR__ . '/componentes/conexao.php'; ?>

<?php 
if(!empty($_SESSION['adiminstatus'])) {
    header('Loation:admin/');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema de Controle de Estoque</title>

    <meta name="description" content="Página de login segura para o Sistema de Controle de Estoque. Acesse para gerenciar seus produtos, fornecedores e relatórios.">
    <meta name="keywords" content="estoque, controle de estoque, login, painel administrativo, erp">
    <meta name="author" content="Desenvolvedor Especialista Front-end">

    <meta name="theme-color" content="#0d6efd">

    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>📦</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --bs-body-font-family: 'Inter', sans-serif;
            --bg-gradient-start: #f8f9fa;
            --bg-gradient-end: #e9ecef;
        }

        body {
            background: linear-gradient(135deg, var(--bg-gradient-start) 0%, var(--bg-gradient-end) 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .login-page {
            flex: 1 0 auto;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .login-container {
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background-color: #ffffff;
            border: 1px solid rgba(0, 0, 0, 0.08);
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 2.5rem 2rem;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        /* Foco acessível personalizado para os inputs */
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.15);
            border-color: #0d6efd;
        }

        /* Estilização sutil do input-group-text para ícones */
        .input-group-text {
            background-color: transparent;
            border-right: none;
            color: #6c757d;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .input-group-text {
            border-color: #0d6efd;
            color: #0d6efd;
        }

        /* Toggle de visualização de senha */
        .password-toggle {
            cursor: pointer;
            border-left: none;
            background-color: transparent;
            color: #6c757d;
            transition: color 0.2s;
        }

        .password-toggle:hover {
            color: #0d6efd;
        }

        .input-group:focus-within .password-toggle {
            border-color: #0d6efd;
        }

        /* Rodapé Fixo no Final se houver espaço */
        footer {
            flex-shrink: 0;
            background-color: #ffffff;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1.25rem 0;
        }
    </style>
</head>

<body>

    <main class="login-page">
        <section class="login-container">
            <article class="login-card">

                <div class="text-center mb-4">
                    <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3" aria-hidden="true">
                        <i class="bi bi-box-seam fs-1"></i>
                    </div>
                    <h1 class="h3 fw-bold text-dark mb-1">StockControl</h1>
                    <p class="text-muted small">Gerenciamento inteligente de estoque</p>
                </div>

                <div id="mensagemLogin" class="alert d-none"></div>

                <form id="loginForm" >

                    <div class="mb-3">
                        <label for="email" class="form-label fw-medium text-secondary small">E-mail corporativo</label>
                        <div class="input-group">
                            <span class="input-group-text" id="email-addon">
                                <i class="bi bi-envelope" aria-hidden="true"></i>
                            </span>
                            <input
                                type="email"
                                class="form-control"
                                id="email"
                                name="email"
                                placeholder="nome@empresa.com"
                                aria-describedby="email-addon emailFeedback"
                                required
                                autocomplete="username">
                            <div id="emailFeedback" class="invalid-feedback">
                                Por favor, insira um endereço de e-mail corporativo válido.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <label for="password" class="form-label fw-medium text-secondary small mb-0">Senha</label>
                            <a href="#" class="text-decoration-none small fw-medium" id="forgotPasswordLink">Esqueceu a senha?</a>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text" id="password-addon">
                                <i class="bi bi-shield-lock" aria-hidden="true"></i>
                            </span>
                            <input
                                type="password"
                                class="form-control"
                                id="password"
                                name="senha"
                                placeholder="Sua senha de acesso"
                                aria-describedby="password-addon passwordFeedback"
                                required
                                autocomplete="current-password">
                            <button
                                type="button"
                                class="input-group-text password-toggle"
                                id="togglePasswordBtn"
                                aria-label="Mostrar senha"
                                title="Mostrar senha">
                                <i class="bi bi-eye" id="togglePasswordIcon" aria-hidden="true"></i>
                            </button>
                            <div id="passwordFeedback" class="invalid-feedback">
                                A senha deve conter pelo menos 6 caracteres.
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="rememberMe">
                        <label class="form-check-label text-secondary small user-select-none" id="rememberMeLabel" for="rememberMe">
                            Manter-me conectado neste dispositivo
                        </label>
                    </div>

                   

                    <button type="submit" class="btn btn-primary w-100 py-2.5 fw-semibold d-flex align-items-center justify-content-center" id="submitBtn">
                        <span id="btnText">Entrar no sistema</span>
                        <span class="spinner-border spinner-border-sm ms-2 d-none" id="btnSpinner" role="status" aria-hidden="true"></span>
                    </button>

                </form>

            </article>
        </section>
    </main>

    <footer class="text-center">
        <div class="container">
            <p class="text-muted small mb-0">&copy; 2026 StockControl Inc. Todos os direitos reservados.</p>
            <p class="text-muted small mb-0 mt-1" style="font-size: 0.75rem;">Versão 4.2.0 (Produção)</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('loginForm');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const togglePasswordBtn = document.getElementById('togglePasswordBtn');
            const togglePasswordIcon = document.getElementById('togglePasswordIcon');
            const submitBtn = document.getElementById('submitBtn');
            const btnText = document.getElementById('btnText');
            const btnSpinner = document.getElementById('btnSpinner');
            const loginAlert = document.getElementById('loginAlert');

            // 1. Alternar visualização da senha
            togglePasswordBtn.addEventListener('click', () => {
                const isPasswordType = passwordInput.getAttribute('type') === 'password';

                if (isPasswordType) {
                    passwordInput.setAttribute('type', 'text');
                    togglePasswordIcon.classList.replace('bi-eye', 'bi-eye-slash');
                    togglePasswordBtn.setAttribute('aria-label', 'Ocultar senha');
                    togglePasswordBtn.setAttribute('title', 'Ocultar senha');
                } else {
                    passwordInput.setAttribute('type', 'password');
                    togglePasswordIcon.classList.replace('bi-eye-slash', 'bi-eye');
                    togglePasswordBtn.setAttribute('aria-label', 'Mostrar senha');
                    togglePasswordBtn.setAttribute('title', 'Mostrar senha');
                }
            });

            // 2. Validação ao vivo dos campos (Acessibilidade + UX)
            const validateField = (input, validationFn) => {
                if (validationFn(input.value)) {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    return true;
                } else {
                    input.classList.remove('is-valid');
                    input.classList.add('is-invalid');
                    return false;
                }
            };

            const isEmailValid = (email) => {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            };

            const isPasswordValid = (password) => password.length >= 6;

            // Remove classes ao digitar para limpar o visual
            emailInput.addEventListener('input', () => {
                if (emailInput.classList.contains('is-invalid') && isEmailValid(emailInput.value)) {
                    emailInput.classList.replace('is-invalid', 'is-valid');
                }
            });

            passwordInput.addEventListener('input', () => {
                if (passwordInput.classList.contains('is-invalid') && isPasswordValid(passwordInput.value)) {
                    passwordInput.classList.replace('is-invalid', 'is-valid');
                }
            });

            // 3. Processamento de envio (Submit)
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                // Esconde alertas prévios
                loginAlert.classList.add('d-none');

                // Executa as validações
                const emailOk = validateField(emailInput, isEmailValid);
                const passwordOk = validateField(passwordInput, isPasswordValid);

                if (emailOk && passwordOk) {
                    // Estado de Carregamento (Loading State)
                    setLoading(true);

                    // Simulando uma requisição de API com delay de 1.5s
                    setTimeout(() => {
                        const emailValue = emailInput.value;
                        const passwordValue = passwordInput.value;

                        // Simulação de credenciais para fins de teste local
                        if (emailValue === "admin@estoque.com" && passwordValue === "123456") {
                            // Sucesso! Redirecionaria para o dashboard
                            alert("Login realizado com sucesso! Redirecionando...");
                            // window.location.href = 'dashboard.html';
                        } else {
                            // Exibe mensagem de erro simulada
                            loginAlert.classList.remove('d-none');
                            emailInput.classList.remove('is-valid');
                            passwordInput.classList.remove('is-valid');
                        }

                        setLoading(false);
                    }, 1500);
                }
            });

            // Helper para controlar o visual de carregamento
            const setLoading = (isLoading) => {
                if (isLoading) {
                    submitBtn.disabled = true;
                    btnSpinner.classList.remove('d-none');
                    btnText.textContent = "Autenticando...";
                } else {
                    submitBtn.disabled = false;
                    btnSpinner.classList.add('d-none');
                    btnText.textContent = "Entrar no sistema";
                }
            };

            // Link de recuperação de senha apenas simulado
            document.getElementById('forgotPasswordLink').addEventListener('click', (e) => {
                e.preventDefault();
                alert("Fluxo de recuperação de senha enviado para a equipe de T.I.");
            });
        });
    </script>

    <script>
        const formLogin = document.getElementById('loginForm');
        const mensagemLogin = document.getElementById('mensagemLogin');
        const btnEntrar = document.getElementById('submitBtn');

        formLogin.addEventListener('submit', async function(event) {
            event.preventDefault();

            limparMensagem();

            const dadosFormulario = new FormData(formLogin);

            btnEntrar.disabled = true;
            btnEntrar.textContent = 'Verificando...';

            try {
                const resposta = await fetch(
                    'componentes/LoginUsuario.php', {
                        method: 'POST',
                        body: dadosFormulario,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }
                );

                const dados = await resposta.json();

                if (!resposta.ok || dados.sucesso !== true) {
                    throw new Error(
                        dados.mensagem || 'Não foi possível realizar o login.'
                    );
                }

                exibirMensagem(dados.mensagem, 'success');

                window.location.href =
                    dados.redirecionar || 'admin/index.php';

            } catch (erro) {
                exibirMensagem(erro.message, 'danger');

                document.getElementById('senha').value = '';
                document.getElementById('senha').focus();

            } finally {
                btnEntrar.disabled = false;
                btnEntrar.textContent = 'Entrar';
            }
        });

        function exibirMensagem(texto, tipo) {
            mensagemLogin.textContent = texto;
            mensagemLogin.className = `alert alert-${tipo}`;
        }

        function limparMensagem() {
            mensagemLogin.textContent = '';
            mensagemLogin.className = 'alert d-none';
        }
    </script>



</body>

</html>