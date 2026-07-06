<?php require_once dirname(__DIR__). '/componentes/config.php';?>
<?php require_once dirname(__DIR__). '/componentes/rotas.php';?>
<!doctype html>
<html lang="en" data-bs-theme="light">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap CSS v5.3.8 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous" />
</head>

<body>

    <?php $numaula = "Aula - 7";?> 
    
    <!-- nav -->
    <?php require_once APP_COMPONENTES. '/nav.php';?>

    <!-- header -->
    <?php require_once APP_COMPONENTES. '/header.php';?>


    
   
     

       <main>

        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1>Padrões Config</h1>
                    <h3>1.Data BR</h3>                    
                    Data: <?php echo $data;?> <br>
                    Hora: <?php echo $hora;?> <br>
                    Data br <?php echo databr();?> <br>
                    Hora br <?php echo horabr();?> <br>

                    <h3>Encrypt dados</h3>
                    <?php $codigo ="123456";?>
                    Código: <?php echo $codigo;?>
                    <?php $enc = encrypt_secure($codigo,'e');?>
                    Código encryptado:<?php echo $enc;?> <br>
                    Código decryptado:<?php echo encrypt_secure($enc,'d');?> <br>

                    <h3>Encrypt no link</h3>
                    <a href="?enc=<?php echo urlencode($enc) ;?>">Chave encryptada</a><br>
                    
                        Código decryptado do link:
                        <?php
                        if(!empty($_GET['enc'])){
                         echo encrypt_secure($_GET['enc'],'d');

                        }

                        ?>

                        <h3>Encrypt dados</h3>
                        <?php $codigo ="654987";?>
                        Código: <?php echo $codigo;?>
                        <?php $nome = encrypt_secure($codigo,'e');?>
                        Código encryptado:<?php echo $nome;?> <br>
                        Código decryptado:<?php echo encrypt_secure($nome,'d');?> <br>

                        <h3>Encrypt no link</h3>
                        <a href="?nome=<?php echo urlencode($nome) ;?>">Chave encryptada</a><br>
                        
                        Código decryptado do link:
                        <?php
                        if(!empty($_GET['nome'])){
                         echo encrypt_secure($_GET['nome'],'d');

                        }

                        ?>


                        <h3>Encrypt dados</h3>
                        <?php $codigo ="000000";?>
                        Código: <?php echo $codigo;?>
                        <?php $Zero = encrypt_secure($codigo,'e');?>
                        Código encryptado:<?php echo $Zero;?> <br>
                        Código decryptado:<?php echo encrypt_secure($Zero,'d');?> <br>

                        <h3>Encrypt no link</h3>
                        <a href="?Zero=<?php echo urlencode($Zero) ;?>">Chave encryptada</a><br>
                        
                        Código decryptado do link:
                        <?php
                        if(!empty($_GET['Zero'])){
                         echo encrypt_secure($_GET['Zero'],'d');

                        }

                        ?>

                        <h3>Grupo com input text e botão</h3>

                       <form method="post" class="card card-body shadow-sm mb-4">
                        <h4>Input text + botão</h4>

                        <label for="produto_busca" class="form-label">Nome do produto</label>

                        <div class="input-group">
                            <input type="text" class="form-control" id="produto_busca" name="busca" placeholder="Digite o nome do produto">
                            <button type="submit" class="btn btn-primary">Pesquisar</button>
                        </div>
                    </form>

                        <h3>Código Decripitado</h3>

                        Código decryptado:
                        <?php
                        if(!empty($_POST['busca'])){
                         $enex = encrypt_secure($_POST['busca'],'e');
                         $deex = encrypt_secure($enex,'d');

                        }
                        
                        ?>

                     Chave Ecryptada <?= $enex; ?> <br>

                     Chave Decrypitada <?= $deex; ?> <br>
                         

                        






                    


                   
                    

                </div>
            </div>
        </div>

        

      </main>
      
    <!-- footer -->
    <?php require_once APP_COMPONENTES. '/footer.php';?>

    <!-- Bootstrap JavaScript Bundle (includes Popper) -->
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>