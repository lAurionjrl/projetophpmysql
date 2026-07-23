<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Fotos</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Cadastrar Nova Imagem</h4>
                </div>
                <div class="card-body">
                    <form action="processar_upload.php" method="POST" enctype="multipart/form-data">
                        
                        <!-- Nome da Foto -->
                        <div class="mb-3">
                            <label for="nome_foto" class="form-label">Nome da Foto:</label>
                            <input type="text" class="form-control" id="nome_foto" name="nome_foto" maxlength="50" placeholder="Ex: Foto de Perfil" required>
                        </div>

                        <!-- Input File -->
                        <div class="mb-3">
                            <label for="imagem" class="form-label">Selecione a Imagem (JPG ou PNG):</label>
                            <input type="file" class="form-control" id="imagem" name="imagem" accept="image/png, image/jpeg" required>
                            <div class="form-text">A imagem será convertida para WebP e redimensionada automaticamente.</div>
                        </div>

                        <!-- Botão de Envio -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Enviar e Salvar</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>