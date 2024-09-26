<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="../../public/css/header.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WebMotors</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Valida se o usuário está logado -->
                    <?php if (isset($_SESSION["nivel_usuario"])): ?>
                        <!-- Botões para admin -->
                        <?php if ($_SESSION["nivel_usuario"] == "admin"): ?>
                            <!-- Não exibe links de "Comprar" e "Sobre" para admin -->
                        <?php elseif ($_SESSION["nivel_usuario"] == "user"): ?>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Comprar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Vender</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Sobre</a>
                            </li>
                        <?php endif; ?>
                    <?php else: ?>
                        <!-- Visitante não autenticado -->
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Comprar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" aria-disabled="true">Sobre</a>
                        </li>
                    <?php endif; ?>
                </ul>

                <div class="d-flex ms-auto"> <!-- Container para botões de controle -->
                    <?php if (isset($_SESSION["nivel_usuario"])): ?>
                        <?php if ($_SESSION["nivel_usuario"] == "admin"): ?>
                            <a href="admin_dashboard.php" class="btn btn-outline-info me-2">Admin Dashboard</a>
                            <a href="logout.php" class="btn btn-outline-danger me-2">Sair</a>
                        <?php elseif ($_SESSION["nivel_usuario"] == "user"): ?>
                            <a href="user_profile.php" class="btn btn-outline-info me-2">Meu Perfil</a>
                            <a href="logout.php" class="btn btn-outline-danger me-2">Sair</a>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="btn btn-outline-success" href="login.php">Entrar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>
