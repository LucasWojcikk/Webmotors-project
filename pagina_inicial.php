<?php 
    $title = "Anunciar veículo"; 
    include 'includes/header.php';
?>

<html>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">

                <!-- Botão WebMotors -->
                <a class="navbar-brand" href="#">WebMotors</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <!-- Outros botões -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <!-- Botao comprar -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Comprar</a>
                        </li>

                        <!-- Botao vender -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">Vender</a>
                        </li>

                        <!-- Botao sobre -->
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Sobre</a>
                        </li>
                    </ul>

                    <!-- Botão login -->
                    <form class="d-flex" role="search">                
                        <button class="btn btn-outline-success" type="submit">Entrar</button>
                    </form>
                </div>
            </div>
        </nav>
    </body>
</html>
