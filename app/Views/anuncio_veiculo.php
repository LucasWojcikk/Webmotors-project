<?php if (isset($_GET['id'])):
    $id = $_GET['id'];
    include '../../components/header.php';
    include '../../config/config.php';
?>
    <?php
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
        $valor = 'R$ ' . number_format($valor, 2, ',', '.');
        $data_anuncio = $dados_veiculo["data_anuncio"];
        $usuario = $dados_veiculo["usuario"];
        $foto_1 = 'data:image/jpeg;base64,' . base64_encode($dados_veiculo['foto_1']);
        $foto_2 = 'data:image/jpeg;base64,' . base64_encode($dados_veiculo['foto_2']);
    ?>

    <html>

        <head>
            <link href="../../public/css/anuncio_veiculo.css" rel="stylesheet" />
        </head>

        <body>
            <main>
                <section class="right-container">
                    <div class="content">
                    <div class="image-container">
                        
                        <img src=<?php echo $foto_1;?> alt="Foto-esquerda">
                        <img src=<?php echo $foto_2;?> alt="Foto-direita">
                    </div>
                
                    <!-- INÍCIO DO PRIMEIRO ANÚNCIO -->
                    <div class="car-content">
                        
                        <!-- Card de informações do carro -->
                        <div class="car-info-card">
                        <div class="car-info">

                            <div class="vendedor">
                                <car-model-info>
                                <span id="marca"><?php echo $marca; ?> - </span><span id="modelo"><?php echo $modelo; ?></span>
                                </car-model-info>

                                <p>Vendedor <span id="vendedor"><?php echo $usuario; ?></span></p>
                            </div>

                            <div class="details-car">  
                            <p>Cor <span id="cor"> <?php echo $cor; ?></span></p>
                            <p>Ano <span id="ano"><?php echo $ano; ?></span></p>
                            <p>Motor <span id="motor"><?php echo $motor; ?></span></p>
                            <p>Inicial placa <span id="placa"><?php echo strtoupper($placa[0]); ?></span></p>
                            </div>
                        </div>
                        </div>
                
                        <!-- Card de preço -->
                        <div class="price-card">
                        <h2>VALOR PEDIDO</h2>
                        <p><span id="preco"><?php echo $valor; ?></span></p>
                        </div>
                    </div>
                    
                    <hr class="divider" />
                    
                    </div>
                </section>
            </main>

        </body>

    </html>
    
<?php else:
    echo "Carro não encontrado";
?>
<?php endif; ?>