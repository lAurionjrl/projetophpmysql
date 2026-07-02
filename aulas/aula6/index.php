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

    <?php $numaula = "Aula 6 - Arrey";?> 
    
    <!-- nav -->
    <?php require_once APP_COMPONENTES. '/nav.php';?>

    <!-- header -->
    <?php require_once APP_COMPONENTES. '/header.php';?>


    <main>

        <div class="container">
            <div class="row">
                <div class="col-12">

                <?php
                $produto = "Mouse";
                echo $produto;
                ?>

                <?php
                $produtos = ["Mouse", "Teclado", "Monitor"];

                echo $produtos[0];
                echo "<br>";
                echo $produtos[1];
                echo "<br>";
                echo $produtos[2];
                ?>


                <h4>Arrey + foreach</h4>

                <?php 
                
                $pessoas = [
                    "Carlo Moura",
                    "Maria Luiza",
                    "Luana Castro",
                    "Paulo Souza",
                    "Fabiano Costa",
                    "Carla Silva"


                ];

                foreach($pessoas as $key => $junior) {

                    echo $key+1 . " Nome: " . $junior ."<br>";
                }
                              
                ?>

                <h3>Arrey Associativa</h3>
                
                <?php 

                $pessoas = [
                    "Nome" => "Carlos Moura",
                    "Idade" => 33,
                    "Naturalidade" => "Fortaleza"
                ];
                
                
                
                
                ?>

                <p>Dados do Usuário</p>
                Nome: <?php echo $pessoas["Nome"]; ?> <br>
                Idade: <?= $pessoas["Idade"]; ?> <br>
                Naturalidade: <?= $pessoas["Naturalidade"]; ?> <br>
                


                <h4>Arrey Multidimencinal</h4>


                <?php
                $pessoas = [
                    [
                        "Nome" => "Carlos Moura",
                        "Idade" => 33,
                        "Naturalidade" => "Fortaleza"
                    ],
                    [
                       "Nome" => "Nadia Lima",
                       "Idade" => 23,
                       "Naturalidade" => "Fortaleza"
                    ],
                    [
                        "Nome" => "Livia Gomes",
                        "Idade" => 28,
                        "Naturalidade" => "Fortaleza"
                    ]
                ];

                    echo $pessoas[2]["Nome"] . "<br>"        

                ?>
                
                <?php 
                
                foreach($pessoas as $key => $dados) {

                echo $dados["Nome"] . "<br>";
                }
                
                
                
                ?>
















                
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