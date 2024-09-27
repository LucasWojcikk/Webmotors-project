<?php
session_start();  // Iniciar a sessão
$title = "Web Motors - Anúncios";
include '../../components/header.php';
include '../../config/config.php';
?>

<html>

<head>
    <link href="../../public/css/login.css" rel="stylesheet">
    <link href="../../public/css/comprar.css" rel="stylesheet">
</head>

<body>

    <div class="cards-container">
        <?php
        $query_veiculos = "SELECT id, marca, modelo, cor, ano, motor, placa, valor, data_anuncio, usuario, foto_1, foto_2 FROM veiculos;";
        $retorno_veiculos = mysqli_query($con, $query_veiculos);

        while ($carro = mysqli_fetch_array($retorno_veiculos)) {
            // Converter as imagens de bytes para base64
            $foto1 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_1']);
            $foto2 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_2']);
        ?>
           <div class="card">
                <div class="image">
                    <img id="car-image-<?php echo $carro['id']; ?>" src="<?php echo $foto1; ?>" alt="Imagem do carro" data-foto1="<?php echo $foto1; ?>">
                </div>
                <h1 class="name"><?php echo $carro["marca"] . " - " . $carro["modelo"];?></h1>
                <h2 class="value">Ano modelo: <?php echo $carro["ano"];?></h2>
                <h2 class="value">Preço: R$ <?php echo $carro["valor"];?></h2>
                <button class="btn" onclick="window.location.href='anuncio_veiculo.php?id=<?php echo $carro['id']; ?>'">Ver anúncio</button>
                <div style="display: flex; justify-content: center; margin-top: 10px;">
                    <button class="arrow-button" onclick="toggleImage(<?php echo $carro['id']; ?>)">
                        &#10094; <!-- Seta para a esquerda -->
                    </button>
                    <button class="arrow-button" onclick="toggleImage(<?php echo $carro['id']; ?>)">
                        &#10095; <!-- Seta para a direita -->
                    </button>
                </div>
            </div>
        <?php 
        }
        ?>
    </div>

</body>

</html>
