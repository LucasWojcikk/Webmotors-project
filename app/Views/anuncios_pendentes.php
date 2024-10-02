<?php
session_start();
$title = "Anuncios pendentes";
include '../../config/config.php';
?>

<?php
if (@$_REQUEST['botao']) {
    $id_aprovar = $_REQUEST["botao"];

    $query_update_status = "UPDATE veiculos SET status = 'ativo' WHERE id = '$id_aprovar';";
    $retorno_update_status = mysqli_query($con, $query_update_status);
    echo "Objeto aprovado com sucesso!";
} elseif (@$_REQUEST['recusar']) {
    $id_aprovar = $_REQUEST["recusar"];

    $query_update_status = "UPDATE veiculos SET status = 'recusado' WHERE id = '$id_aprovar';";
    $retorno_update_status = mysqli_query($con, $query_update_status);
    echo "Objeto recusado com sucesso!";
}
?>

<?php if (
    isset($_SESSION["nivel_usuario"])
    and $_SESSION["nivel_usuario"] == "admin"
):
    include '../../components/header.php';
    include '../../config/config.php';
?>

    <html>

    <head>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
            crossorigin="anonymous" />
        <link href="../../public/css/anuncios_pendentes.css" rel="stylesheet">
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap"
            rel="stylesheet" />
    </head>

    <body>
        <main>
            <section class="right-container">
                <h1>Anúncios Pendentes</h1>
                <?php

                $query_veiculos = (
                    "SELECT id, marca, modelo, cor, ano, motor, placa, valor, data_anuncio, foto_1
                        FROM veiculos
                        WHERE status = 'pendente'
                        ORDER BY data_anuncio;"
                );

                $retorno_veiculos = mysqli_query($con, $query_veiculos);
                if (mysqli_num_rows($retorno_veiculos) > 0) {
                    while ($carro = mysqli_fetch_array($retorno_veiculos)) {
                        $id = $carro["id"];
                        $foto1 = 'data:image/jpeg;base64,' . base64_encode($carro['foto_1']);
                        $marca = $carro['marca'];
                        $modelo = $carro['modelo'];
                        $cor = $carro['cor'];
                        $ano = $carro['ano'];
                        $motor = $carro['motor'];
                        $valor = $carro['valor'];
                ?>

                        <form method="post">
                            <div class="content">
                                <!-- INÍCIO DO PRIMEIRO ANÚNCIO -->
                                <div class="car-content">
                                    <?php ?>
                                    <img src=<?php echo $foto1 ?> alt="Miniatura do Carro" />
                                    <div class="car-info">
                                        <p>Marca: <span id="marca"><?php echo $marca; ?></span></p>
                                        <p>Modelo: <span id="modelo"><?php echo $modelo; ?></span></p>
                                        <p>Cor: <span id="cor"></span><?php echo $cor; ?></p>
                                        <p>Ano: <span id="ano"></span><?php echo $ano; ?></p>
                                        <p>Motor: <span id="motor"></span><?php echo $motor; ?></p>
                                    </div>
                                    <div class="price-container">
                                        <div class="price-content">
                                            <h2>VALOR PEDIDO</h2>
                                            <p>R$: <span id="preco"><?php echo $valor; ?></span></p>
                                        </div>
                                    </div>
                                    <div class="options-content">
                                        <h5>Deseja aceitar ou excluir esse anúncio ?</h5>
                                        <div class="approve"></div>
                                        <div class="admin-icon">
                                            <div class="approved">
                                                <!-- <a href=""><img src="img/approved-black.svg" alt="aprovado" /></a> -->
                                                <button type="submit" name="botao" value=<?php echo $id ?>><img src="img/approved-black.svg" alt="aprovado" /></button>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="bin">
                                                <!-- <a href=""><img src="img/lixeira.svg" alt="lixeira" /></a> -->
                                                <button type="submit" name="recusar" value="<?php echo $id ?>"><img src="img/lixeira.svg" /></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="divider" />
                        </form>
                    <?php
                    }
                } else {
                    ?>
                    <h2>Nenhum anúncio pendente.</h2>
                <?php
                }
                ?>
            </section>
        </main>
    </body>

    </html>

<?php else:
    include '../../components/requisicao_login.php';
?>
<?php endif; ?>