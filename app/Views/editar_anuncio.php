<?php
session_start();
$title = "Atualizar veículo";
include '../../components/header.php';
include '../../config/config.php';
date_default_timezone_set("America/Sao_Paulo");

if (@$_REQUEST['botao'] == 'Anunciar' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $placa = $_POST["placa-veiculo"];

    $query_valida_placa = "SELECT id FROM veiculos WHERE placa = '$placa' AND id != '$id'";
    $retorno_validacao_placa = mysqli_query($con, $query_valida_placa);

    if (mysqli_num_rows($retorno_validacao_placa) == 0) {
        $marca = $_POST["marca-veiculo"];
        $modelo = $_POST["modelo-veiculo"];
        $cor = $_POST["cor-veiculo"];
        $ano = $_POST["ano-veiculo"];
        $motor = $_POST["motor-veiculo"];
        $valor = str_replace('.', '', $_POST["valor-veiculo"]);
        $valor = str_replace(',', '.', $valor);

        $foto_1 = null;
        $foto_2 = null;

        if (isset($_FILES['imagem_input']) && !empty($_FILES['imagem_input']['tmp_name'][0])) {
            $foto_1 = file_get_contents($_FILES["imagem_input"]["tmp_name"][0]);
        }
        if (isset($_FILES['imagem_input']) && !empty($_FILES['imagem_input']['tmp_name'][1])) {
            $foto_2 = file_get_contents($_FILES["imagem_input"]["tmp_name"][1]);
        }

        // Montagem da query de atualização
        $query_update_veiculo = "UPDATE veiculos SET
            marca = '$marca',
            modelo = '$modelo',
            cor = '$cor',
            ano = '$ano',
            motor = '$motor',
            placa = '$placa',
            valor = '$valor'";

        // Verificação para atualizar as imagens apenas se novas forem enviadas
        if ($foto_1 !== null) {
            $query_update_veiculo .= ", foto_1 = '" . mysqli_real_escape_string($con, $foto_1) . "'";
        }
        if ($foto_2 !== null) {
            $query_update_veiculo .= ", foto_2 = '" . mysqli_real_escape_string($con, $foto_2) . "'";
        }

        $query_update_veiculo .= " WHERE id = '$id'";

        $retorno_update_veiculo = mysqli_query($con, $query_update_veiculo);

        if ($retorno_update_veiculo) {
            header("Location: meus_anuncios.php");
            exit();
        } else {
            echo ("Não foi possível atualizar seu anúncio no momento, tente novamente mais tarde.");
            echo mysqli_error($con);
        }
    } else {
        echo "A placa já está cadastrada para outro veículo.";
    }
}
?>

<?php if (
    isset($_SESSION["nivel_usuario"])
    and $_SESSION["nivel_usuario"] == "user"
):

    if (isset($_GET['id'])){
        $id = $_GET['id'];
        $query_veiculo = "SELECT * FROM veiculos WHERE id = '$id'";
        $retorno_veiculo = mysqli_query($con, $query_veiculo);
        $dados_veiculo = mysqli_fetch_array($retorno_veiculo);

        $marca = $dados_veiculo["marca"];
        $modelo = $dados_veiculo["modelo"];
        $cor = $dados_veiculo["cor"];
        $ano = $dados_veiculo["ano"];
        $motor = $dados_veiculo["motor"];
        $placa = $dados_veiculo["placa"];
        $valor = $dados_veiculo["valor"];
        // $valor = 'R$ ' . number_format($valor, 2, ',', '.');
        $foto_1_base64 = 'data:image/jpeg;base64,' . base64_encode($dados_veiculo['foto_1']);
        $foto_2_base64 = 'data:image/jpeg;base64,' . base64_encode($dados_veiculo['foto_2']);
    }
?>
<html>

<head>
    <script src="../../public/js/anunciar_veiculo.js"></script>
</head>

<body>
    <!-- Atualizar veículo -->
    <div class="container mt-5">
        <h2 class="text-center">Atualizar veículo</h2>
        <form name="form-carro" class="mx-auto" style="max-width: 900px;" method="post" enctype="multipart/form-data">
            <!-- Marca -->
            <div class="form-group">
                <label>Marca</label>
                <textarea class="form-control" name="marca-veiculo" rows="1" placeholder="Marca..."><?php echo $marca; ?></textarea>
            </div>

            <!-- Modelo -->
            <div class="form-group">
                <label>Modelo</label>
                <textarea class="form-control" name="modelo-veiculo" rows="1" placeholder="Modelo..."><?php echo $modelo; ?></textarea>
            </div>

            <!-- Cor -->
            <div class="form-group">
                <label>Cor</label>
                <textarea class="form-control" name="cor-veiculo" rows="1" placeholder="Cor..."><?php echo $cor; ?></textarea>
            </div>

            <!-- Ano -->
            <div class="form-group">
                <label>Ano</label>
                <textarea class="form-control" name="ano-veiculo" rows="1" placeholder="Ano..."><?php echo $ano; ?></textarea>
            </div>

            <!-- Motor -->
            <div class="form-group">
                <label>Motor</label>
                <textarea class="form-control" name="motor-veiculo" rows="1" placeholder="Motor..."><?php echo $motor; ?></textarea>
            </div>

            <!-- Placa -->
            <div class="form-group">
                <label>Placa</label>
                <textarea class="form-control" name="placa-veiculo" rows="1" placeholder="Placa..."><?php echo $placa; ?></textarea>
            </div>

            <!-- Valor -->
            <div class="form-group">
                <label>Valor do veículo</label>
                <textarea class="form-control" name="valor-veiculo" rows="1" placeholder="Valor do veículo..."><?php echo $valor; ?></textarea>
            </div>

            <!-- Fotos -->
            <div class="d-flex flex-column">
                <div class="d-flex">
                    <!-- Primeiro box de imagem com pré-visualização da imagem atual -->
                    <div class="img-preview me-2" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; position: relative;">
                        <img name="img1" class="img-thumbnail" src="<?php echo $foto_1_base64; ?>" alt="Imagem 1" style="max-width: 100%; max-height: 100%;">
                    </div>

                    <!-- Segundo box de imagem com pré-visualização da imagem atual -->
                    <div class="img-preview" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; position: relative;">
                        <img name="img2" class="img-thumbnail" src="<?php echo $foto_2_base64; ?>" alt="Imagem 2" style="max-width: 100%; max-height: 100%;">
                    </div>
                </div>

                <!-- Input para selecionar novas imagens -->
                <input type="file" accept="image/*" name="imagem_input[]" multiple class="mt-2" />
            </div>

            <div class="d-flex justify-content-start mt-3">
                <button type="submit" class="btn btn-primary" name="botao" value="Anunciar">Atualizar</button>
                <a href="pagina_inicial.php" class="btn btn-primary ms-2">Cancelar</a>
            </div>
        </form>
    </div>
</body>

</html>
<?php else:
    include '../../components/requisicao_login.php';
?>
<?php endif; ?>
