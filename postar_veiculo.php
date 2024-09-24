<?php
$title = "Anunciar veículo";
include 'includes/header.php';
?>

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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Comprar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Vender</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Sobre</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-success" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Anunciar veículo -->
    <div class="container mt-5">
        <h2 class="text-center">Anunciar veículo</h2>
        <form id="carForm" class="mx-auto" style="max-width: 900px;">
            <!-- Marca -->
            <div class="form-group">
                <label for="marca-veiculo">Marca</label>
                <textarea class="form-control" name="marca-veiculo" rows="1" placeholder="Marca..." required></textarea>
            </div>

            <!-- Modelo -->
            <div class="form-group">
                <label for="modelo-veiculo">Modelo</label>
                <textarea class="form-control" name="modelo-veiculo" rows="1" placeholder="Modelo..." required></textarea>
            </div>

            <!-- Cor -->
            <div class="form-group">
                <label for="cor-veiculo">Cor</label>
                <textarea class="form-control" name="cor-veiculo" rows="1" placeholder="Cor..." required></textarea>
            </div>

            <!-- Ano -->
            <div class="form-group">
                <label for="ano-veiculo">Ano</label>
                <textarea class="form-control" name="ano-veiculo" rows="1" placeholder="Ano..." required></textarea>
            </div>

            <!-- Motor -->
            <div class="form-group">
                <label for="motor-veiculo">Motor</label>
                <textarea class="form-control" name="motor-veiculo" rows="1" placeholder="Motor..." required></textarea>
            </div>

            <!-- Placa -->
            <div class="form-group">
                <label for="placa-veiculo">Placa</label>
                <textarea class="form-control" name="placa-veiculo" rows="1" placeholder="Placa..." required></textarea>
            </div>

            <!-- Valor -->
            <div class="form-group">
                <label for="valor-veiculo">Valor do veículo</label>
                <textarea class="form-control" name="valor-veiculo" rows="1" placeholder="Valor do veículo..." required></textarea>
            </div>

            <!-- Fotos -->
            <div class="form-group mt-4">
                <label for="postContent">Fotos</label>
                <div class="d-flex">
                    <div class="img-preview me-2" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center;">
                        <img name="img1" class="img-thumbnail" alt="Imagem 1" style="max-width: 100%; max-height: 100%; display: none;">
                    </div>
                    <div class="img-preview" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center;">
                        <img name="img2" class="img-thumbnail" alt="Imagem 2" style="max-width: 100%; max-height: 100%; display: none;">
                    </div>
                </div>
                <input type="file" accept="image/*" id="fileInput" multiple onchange="previewImages(event)" />
            </div>

            <div class="d-flex justify-content-start mt-3">
                <button type="button" onclick="createPost()" class="btn btn-primary">Publicar</button>
                <a href="pagina_inicial.php" class="btn btn-primary ms-2">Cancelar</a>
            </div>
        </form>
    </div>

</body>
</html>
