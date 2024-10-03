<?php
session_start();  // Iniciar a sessão
$title = "Web Motors";
include '../../components/header.php';
?>

<html>

<head>
    <link href="../../public/css/login.css" rel="stylesheet">
    <link href="../../public/css/pagina_incial.css" rel="stylesheet"> <!-- Link para um arquivo CSS da home -->
</head>

<body>
    <div class="wrapper">
        <!-- Hero Section (destaque da página) -->
        <section class="hero-section">
            <div class="container">
                <h1>Bem-vindo à Web Motors!</h1>
                <p>Estamos felizes em tê-lo aqui. Explore nossa variedade de veículos e encontre o carro dos seus sonhos.</p>
                <p>Use a barra de navegação acima para acessar nossas categorias e ofertas.</p>
            </div>
        </section>
    </div>

    <!-- Rodapé -->
    <footer>
        <div class="container">
            <p>&copy; 2024 Web Motors. Todos os direitos reservados.</p>
        </div>
    </footer>

</body>

</html>
