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
    <script src="../../public/js/comprar.js"></script>
</head>

<body>

    <!-- Barra de filtros -->
    <div class="filter-bar">
        <form method="GET" action="comprar.php">
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" placeholder="Digite a marca" value="<?php echo isset($_GET['marca']) ? $_GET['marca'] : ''; ?>">

            <label for="modelo">Modelo:</label>
            <input type="text" name="modelo" id="modelo" placeholder="Digite o modelo" value="<?php echo isset($_GET['modelo']) ? $_GET['modelo'] : ''; ?>">

            <label for="cor">Cor:</label>
            <input type="text" name="cor" id="cor" placeholder="Digite a cor" value="<?php echo isset($_GET['cor']) ? $_GET['cor'] : ''; ?>">

            <label for="valor">Faixa de preço:</label>
            <select name="valor" id="valor">
                <option value="">Todas</option>
                <option value="1-20000" <?php echo isset($_GET['valor']) && $_GET['valor'] == '1-20000' ? 'selected' : ''; ?>>Até R$ 20.000</option>
                <option value="20000-50000" <?php echo isset($_GET['valor']) && $_GET['valor'] == '20000-50000' ? 'selected' : ''; ?>>R$ 20.000 - R$ 50.000</option>
                <option value="50000-100000" <?php echo isset($_GET['valor']) && $_GET['valor'] == '50000-100000' ? 'selected' : ''; ?>>R$ 50.000 - R$ 100.000</option>
                <option value="100000" <?php echo isset($_GET['valor']) && $_GET['valor'] == '100000' ? 'selected' : ''; ?>>Mais de R$ 100.000</option>
            </select>

            <button type="submit" class="btn btn-filter">Aplicar Filtros</button>
        </form>
    </div>

    <div class="cards-container">
        <?php
        // Coleta dos filtros aplicados
        $marca = isset($_GET['marca']) ? strtolower(trim($_GET['marca'])) : '';
        $modelo = isset($_GET['modelo']) ? strtolower(trim($_GET['modelo'])) : '';
        $cor = isset($_GET['cor']) ? strtolower(trim($_GET['cor'])) : '';
        $valor = isset($_GET['valor']) ? $_GET['valor'] : '';

        // Construção da query com os filtros
        $query_veiculos = "SELECT id, marca, modelo, cor, ano, motor, placa, valor, data_anuncio, usuario, foto_1, foto_2 
                            FROM veiculos 
                            WHERE status = 'ativo' ";

        // Filtro por marca, comparando com case-insensitive
        if (!empty($marca)) {
            $query_veiculos .= "AND LOWER(marca) LIKE '%$marca%' ";
        }

        // Filtro por modelo, comparando com case-insensitive
        if (!empty($modelo)) {
            $query_veiculos .= "AND LOWER(modelo) LIKE '%$modelo%' ";
        }

        // Filtro por cor, comparando com case-insensitive
        if (!empty($cor)) {
            $query_veiculos .= "AND LOWER(cor) LIKE '%$cor%' ";
        }

        // Filtro por faixa de preço
        if (!empty($valor)) {
            if ($valor == "1-20000") {
                $query_veiculos .= "AND valor <= 20000 ";
            } elseif ($valor == "20000-50000") {
                $query_veiculos .= "AND valor BETWEEN 20000 AND 50000 ";
            } elseif ($valor == "50000-100000") {
                $query_veiculos .= "AND valor BETWEEN 50000 AND 100000 ";
            } elseif ($valor == "100000") {
                $query_veiculos .= "AND valor > 100000 ";
            }
        }

        // Ordenação por data de anúncio
        $query_veiculos .= "ORDER BY data_anuncio DESC;";
        $retorno_veiculos = mysqli_query($con, $query_veiculos);

        while ($carro = mysqli_fetch_array($retorno_veiculos)) {
            // Converter as imagens de bytes para base64
            $foto1 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_1']);
            $foto2 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_2']);
        ?>
            <div class="card">
                <div class="image">
                    <img id="car-image-<?php echo $carro['id']; ?>" src="<?php echo $foto1; ?>" alt="Imagem do carro" data-foto1="<?php echo $foto1; ?>" data-foto2="<?php echo $foto2; ?>">
                    <!-- Botão da esquerda -->
                    <button class="arrow-button left" onclick="toggleImage(<?php echo $carro['id']; ?>)">
                        &#10094;
                    </button>
                    <!-- Botão da direita -->
                    <button class="arrow-button right" onclick="toggleImage(<?php echo $carro['id']; ?>)">
                        &#10095;
                    </button>
                </div>
                <h1 class="name"><?php echo $carro["marca"] . " - " . $carro["modelo"]; ?></h1>
                <h2 class="value">Ano modelo: <?php echo $carro["ano"]; ?></h2>
                <h2 class="value">Preço: <?php echo 'R$ ' . number_format($carro["valor"], 2, ',', '.'); ?></h2>

                <button class="btn" onclick="window.location.href='anuncio_veiculo.php?id=<?php echo $carro['id']; ?>'">Ver anúncio</button>
            </div>
        <?php
        }
        ?>
    </div>

</body>

</html>
