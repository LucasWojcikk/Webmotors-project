<?php
    session_start();
    $title = "Meus anuncios";
?>

<?php if (
    isset($_SESSION["nivel_usuario"])
    and $_SESSION["nivel_usuario"] == "user"
):
    include '../../components/header.php';
    include '../../config/config.php';
?>

    <html>

    <head>
        <link href="../../public/css/meus_anuncios.css" rel="stylesheet">
    </head>

    <body>
        <div class="cards-container">
            <?php
            $nome_usuario = $_SESSION["nome_usuario"];

            $query_veiculos = (
                "SELECT id, marca, modelo, cor, ano, motor, placa, valor, data_anuncio, foto_1
                    FROM veiculos
                    WHERE usuario = '$nome_usuario'
                    ORDER BY data_anuncio DESC;"
            );

            $retorno_veiculos = mysqli_query($con, $query_veiculos);
            while ($carro = mysqli_fetch_array($retorno_veiculos)) {
                $foto1 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_1']);
            ?>
                <div class="card">
                    <div class="img">
                        <img src="<?php echo $foto1; ?>" alt="Imagem do veículo" style="width: 80px; height: 80px;" />
                    </div>
                </div>

            <?php
            }
            ?>
        </div>
    </body>

    </html>


<?php else:
    include '../../components/requisicao_login.php';
?>
<?php endif; ?>