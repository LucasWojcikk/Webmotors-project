<?php
    $title = "Anunciar veículo";
    include '../../includes/header.php';
    include '../../config/config.php';
    date_default_timezone_set("America/Sao_Paulo");


    if (@$_REQUEST['botao'] == 'Anunciar') {

        $placa = $_POST["placa-veiculo"];
        
        $query_valida_placa = "SELECT id FROM veiculos WHERE placa = '$placa'";
        $retorno_validacao_placa = mysqli_query($con, $query_valida_placa);

        if (mysqli_num_rows($retorno_validacao_placa) == 0){

            $marca = $_POST["marca-veiculo"];
            $modelo = $_POST["modelo-veiculo"];
            $cor = $_POST["cor-veiculo"];
            $ano = $_POST["ano-veiculo"];
            $motor = $_POST["motor-veiculo"];

            // tratando os dados da coluna valor
            $valor = $_POST["valor-veiculo"];
            $valor = str_replace('.', '', $valor); // Remove todos os pontos
            $valor = str_replace(',', '.', $valor);

            $data_anuncio = date('Y/m/d');
            // echo $data_anuncio;
            
            // pegar o usuario do login
            $usuario = 'lucaswojcik';

            $foto_1 = null;
            $foto_2 = null;

            if (isset($_FILES['imagem_input']['tmp_name'])) {
                if (isset($_FILES['imagem_input']['tmp_name'][0])) {
                    $foto_1 = file_get_contents($_FILES['imagem_input']['tmp_name'][0]);
                }
                if (isset($_FILES['imagem_input']['tmp_name'][1])) {
                    $foto_2 = file_get_contents($_FILES['imagem_input']['tmp_name'][1]);
                }
            }

            // Corrigindo a consulta SQL
            $query_insert_veiculo = (
                "INSERT INTO veiculos (
                    marca, modelo, cor, ano, motor, placa, valor, data_anuncio, usuario, foto_1, foto_2, status
                ) VALUES (
                    '$marca', '$modelo', '$cor', '$ano', '$motor', '$placa', '$valor', '$data_anuncio', '$usuario', 
                    '" . mysqli_real_escape_string($con, $foto_1) . "', 
                    '" . mysqli_real_escape_string($con, $foto_2) . "', 'Pendente'
                )"
            );

            $retorno_insert_veiculo = mysqli_query($con, $query_insert_veiculo);

            if ($retorno_insert_veiculo){
                echo ("Seu anúncio foi enviado para análise!");
            } else {
                echo ("Não foi possível gerar seu anúncio no momento, tente novamente mais tarde.");
            }
        }
        
        mysqli_free_result($retorno_validacao_placa);
    }
?>

<html>
    <head>
        <script src="../../public/js/anunciar_veiculo.js"></script>
    </head>
    <body>
        <!-- Anunciar veículo -->
        <div class="container mt-5">
            <h2 class="text-center">Anunciar veículo</h2>
            <form name="form-carro" class="mx-auto" style="max-width: 900px;" method="post" enctype="multipart/form-data">
                <!-- Marca -->
                <div class="form-group">
                    <label>Marca</label>
                    <textarea class="form-control" name="marca-veiculo" rows="1" placeholder="Marca..."></textarea>
                </div>

                <!-- Modelo -->
                <div class="form-group">
                    <label>Modelo</label>
                    <textarea class="form-control" name="modelo-veiculo" rows="1" placeholder="Modelo..."></textarea>
                </div>

                <!-- Cor -->
                <div class="form-group">
                    <label>Cor</label>
                    <textarea class="form-control" name="cor-veiculo" rows="1" placeholder="Cor..."></textarea>
                </div>

                <!-- Ano -->
                <div class="form-group">
                    <label>Ano</label>
                    <textarea class="form-control" name="ano-veiculo" rows="1" placeholder="Ano..."></textarea>
                </div>

                <!-- Motor -->
                <div class="form-group">
                    <label>Motor</label>
                    <textarea class="form-control" name="motor-veiculo" rows="1" placeholder="Motor..."></textarea>
                </div>

                <!-- Placa -->
                <div class="form-group">
                    <label>Placa</label>
                    <textarea class="form-control" name="placa-veiculo" rows="1" placeholder="Placa..."></textarea>
                </div>

                <!-- Valor -->
                <div class="form-group">
                    <label>Valor do veículo</label>
                    <textarea class="form-control" name="valor-veiculo" rows="1" placeholder="Valor do veículo..."></textarea>
                </div>

                <!-- Fotos -->
                <!-- Box de pré-visualização das imagens -->
                <div class="d-flex flex-column">
                    <div class="d-flex">
                        <!-- Primeiro box de imagem -->
                        <div 
                            class="img-preview me-2" 
                            style="width: 150px; height: 150px; border: 1px solid #ccc; 
                                    display: flex; align-items: center; justify-content:
                                    center; position: relative;">
                            <img name="img1" class="img-thumbnail" alt="Imagem 1" style="max-width: 100%; max-height: 100%; display: none;">
                            <button type="button" onclick="removeImage('img1')" style="position: absolute; top: 5px; right: 5px; display: none;" name="btn-remove-img1" class="btn btn-danger btn-sm">X</button>
                        </div>
                        
                        <!-- Segundo box de imagem -->
                        <div class="img-preview" style="width: 150px; height: 150px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center; position: relative;">
                            <img name="img2" class="img-thumbnail" alt="Imagem 2" style="max-width: 100%; max-height: 100%; display: none;">
                            <button type="button" onclick="removeImage('img2')" style="position: absolute; top: 5px; right: 5px; display: none;" name="btn-remove-img2" class="btn btn-danger btn-sm">X</button>
                        </div>
                    </div>
                    <input type="file" accept="image/*" name="imagem_input[]" multiple onchange="previewImages(event)" class="mt-2" />
                </div>

                <div class="d-flex justify-content-start mt-3">
                    <button type="submit" class="btn btn-primary" name="botao" value="Anunciar">Anunciar</button>
                    <a href="pagina_inicial.php" class="btn btn-primary ms-2">Cancelar</a>
                </div>
            </form>
        </div>

    </body>
</html>