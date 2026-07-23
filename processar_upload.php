<?php
// 1. Inclui o arquivo de conexão existente e inicializa a variável $con
require_once __DIR__ . '/componentes/conexao.php';
$con = config::connect();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagem'])) {
    
    $nome_foto = trim($_POST['nome_foto']);
    $arquivo   = $_FILES['imagem'];

    // Validar erros de envio
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        die("Erro ao enviar o arquivo.");
    }

    // Validar formato (Apenas JPG e PNG)
    $mime_type = mime_content_type($arquivo['tmp_name']);
    $extensoes_permitidas = ['image/jpeg' => 'jpg', 'image/png' => 'png'];

    if (!array_key_exists($mime_type, $extensoes_permitidas)) {
        die("Formato inválido! Envie apenas imagens em formato PNG ou JPG.");
    }

    // Carregar imagem no GD
    if ($mime_type === 'image/jpeg') {
        $imagem_origem = imagecreatefromjpeg($arquivo['tmp_name']);
    } else {
        $imagem_origem = imagecreatefrompng($arquivo['tmp_name']);
    }

    // Obter dimensões e redimensionar proporcionalmente para no máximo 1024px
    $largura_orig = imagesx($imagem_origem);
    $altura_orig  = imagesy($imagem_origem);
    $max_dimensao = 1024;

    if ($largura_orig > $max_dimensao || $altura_orig > $max_dimensao) {
        if ($largura_orig >= $altura_orig) {
            $nova_largura = $max_dimensao;
            $nova_altura  = floor(($altura_orig / $largura_orig) * $max_dimensao);
        } else {
            $nova_altura  = $max_dimensao;
            $nova_largura = floor(($largura_orig / $altura_orig) * $max_dimensao);
        }
    } else {
        $nova_largura = $largura_orig;
        $nova_altura  = $altura_orig;
    }

    // Redimensionar mantendo transparência (caso seja PNG)
    $imagem_redimensionada = imagecreatetruecolor($nova_largura, $nova_altura);
    imagealphablending($imagem_redimensionada, false);
    imagesavealpha($imagem_redimensionada, true);
    imagecopyresampled($imagem_redimensionada, $imagem_origem, 0, 0, 0, 0, $nova_largura, $nova_altura, $largura_orig, $altura_orig);

    // Salvar na pasta /fotos como WebP e otimizar para no máximo 120KB
    $diretorio_destino = 'fotos/';
    if (!is_dir($diretorio_destino)) {
        mkdir($diretorio_destino, 0755, true);
    }

    $nome_arquivo_salvo = uniqid() . '_' . time() . '.webp';
    $caminho_completo   = $diretorio_destino . $nome_arquivo_salvo;

    $qualidade = 85; 
    $max_bytes = 120 * 1024; // 120KB

    do {
        imagewebp($imagem_redimensionada, $caminho_completo, $qualidade);
        $tamanho_arquivo = filesize($caminho_completo);
        $qualidade -= 10;
    } while ($tamanho_arquivo > $max_bytes && $qualidade > 10);

    // Liberar memória da biblioteca GD
    imagedestroy($imagem_origem);
    imagedestroy($imagem_redimensionada);

    // Inserir registro na tabela fotos_sistema usando a conexão $con
    $pasta      = 'fotos';
    $extensao   = 'webp';
    $status     = 1;
    $hora_atual = date('H:i:s');

    $sql = "INSERT INTO fotos_sistema (nome_foto, pasta, extensao, status, hora_resgistro) 
            VALUES (:nome_foto, :pasta, :extensao, :status, :hora_resgistro)";
    
    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':nome_foto', $nome_foto);
        $stmt->bindValue(':pasta', $pasta);
        $stmt->bindValue(':extensao', $extensao);
        $stmt->bindValue(':status', $status, PDO::PARAM_INT);
        $stmt->bindValue(':hora_resgistro', $hora_atual);

        if ($stmt->execute()) {
            echo "<script>alert('Imagem processada e cadastrada com sucesso!'); window.location.href='index.php';</script>";
        }
    } catch (PDOException $e) {
        die("Erro ao salvar no banco de dados: " . $e->getMessage());
    }
}
?>