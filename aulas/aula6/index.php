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
                
                
                
                <br>
                <h4>DESAFIO 1 — Lista de categorias com array simples</h4>

                <?php
                    $categorias = [
                        "Informática",
                        "Escritório",
                        "Eletrônicos",
                        "Celulares",
                        "Acessorios"
                       
                    ];

                    ?>


                    <br><br>
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            Categorias cadastradas
                        </div>

                        <div class="card-body">
                            <ul class="list-group">
                                <?php foreach ($categorias as $categoria) { ?>
                                    <li class="list-group-item">
                                        <?= $categoria; ?>
                                    </li>
                                <?php } 
                                
                                
                                ?>
                            </ul>
                        </div>
                    </div>

                <br><br>
                <h3>DESAFIO 2 — Lista de produtos com foreach</h3>
                <?php
                $produtos = [
                    "Mouse",
                    "Teclado",
                    "Monitor",
                    "Placa-Mâe",
                    "Placa de Vídeo",
                    "Processador"
                    
                ];
                ?>

                <br><br>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                Lista de Produtos
                            </div>

                            <div class="card-body">
                                <?php foreach ($produtos as $produto) { ?>
                                    <p class="border-bottom pb-2">
                                        Produto: <strong><?= $produto; ?></strong>
                                    </p>
                                <?php } 
                                
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <br><br>
                <h4>DESAFIO 3 — Dados de cliente com array associativo</h4>

                <?php
                $cliente = [
                    "nome" => "Maria Oliveira",
                    "email" => "maria@email.com",
                    "telefone" => "(85) 99999-0000",
                    "cidade" => "Fortaleza"
                ];
                ?>

                <br><br>
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        Dados do Cliente
                    </div>

                    <div class="card-body">
                        <p><strong>Nome:</strong> <?= $cliente["nome"]; ?></p>
                        <p><strong>E-mail:</strong> <?= $cliente["email"]; ?></p>
                        <p><strong>Telefone:</strong> <?= $cliente["telefone"]; ?></p>
                        <p><strong>Cidade:</strong> <?= $cliente["cidade"]; ?></p>

                    
                    </div>
                </div>

                <br><br>
                <h4>DESAFIO 4 — Card de produto com array associativo</h4>

                <?php
                $produto = [
                    "nome" => "Teclado Mecânico",
                    "categoria" => "Informática",
                    "preco" => 250.00,
                    "estoque" => 8
                ];
                ?>

                <br><br>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="card shadow-sm text-center">
                            <div class="card-body">
                                <h5 class="card-title"><?= $produto["nome"]; ?></h5>

                                <p class="card-text">
                                    Categoria: <strong><?= $produto["categoria"]; ?></strong>
                                </p>

                                <p class="card-text">
                                    Preço: R$ <strong><?= $produto["preco"]; ?></strong>
                                    
                                </p>

                                <p class="card-text">
                                    Estoque: <strong><?= $produto["estoque"]; ?></strong>
                                    
                                </p>

                                <a href="#" class="btn btn-primary">Ver produto</a>
                            </div>
                        </div>
                    </div>
                </div>


                <br><br>

                <h4>DESAFIO 5 — Array multidimensional de produtos</h4>

                <br><br>

                <?php
                $produtos = [
                    [
                        "nome" => "Mouse",
                        "categoria" => "Informática",
                        "preco" => 80.00,
                        "estoque" => 10
                    ],
                    [
                        "nome" => "Caderno",
                        "categoria" => "Escritório",
                        "preco" => 25.00,
                        "estoque" => 30
                    ],
                    [
                        "nome" => "Celular",
                        "categoria" => "Eletrônicos",
                        "preco" => 999.90,
                        "estoque" => 100
                    ], 
                    [
                        "nome" => "Teclado",
                        "categoria" => "Informática",
                        "preco" => 15.99,
                        "estoque" => 50
                    ],
                    [
                        "nome" => "Caneta",
                        "categoria" => "Escritório",
                        "preco" => 1.99,
                        "estoque" => 200
                    ]

                    
                ];
                ?>

                <?php foreach ($produtos as $produto) { ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h5><?= $produto["nome"]; ?></h5>

                            <p><strong>Categoria:</strong> <?= $produto["categoria"]; ?></p>

                            <p><strong>Preço:</strong>
                                R$ <?= number_format($produto["preco"], 2, ",", "."); ?>
                            </p>

                            <p><strong>Estoque:</strong>
                                <?= $produto["estoque"]; ?> unidades
                            </p>
                        </div>
                    </div>

                <?php } ?>
















                
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