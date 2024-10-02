<?php
session_start();
$title = "Meu perfil";
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
        <link href="../../public/css/perfil_usuario.css" rel="stylesheet" />
    </head>

    <body>

        <?php
        $login_usuario = $_SESSION["nome_usuario"];
        $query_dados_usuario = "SELECT * FROM usuarios WHERE login = '$login_usuario';";
        $retorno_usuario = mysqli_query($con, $query_dados_usuario);

        $dados_usuario = mysqli_fetch_array($retorno_usuario);
        $nome = $dados_usuario["nome"];
        $tipo_usuario = $dados_usuario["tipo_usuario"];
        $cpf = $dados_usuario["cpf"];
        $data_nascimento = $dados_usuario["data_nascimento"];
        $cidade = $dados_usuario["cidade"];
        $telefone = $dados_usuario["telefone"];

        ?>
        <main>
            <section class="right-container">
                <div class="content">
                    <h1>Perfil</h1>
                    <div class="car-content">
                        <img src="img/user-red.svg" alt="Foto de perfil" />
                        <div class="user-info">
                            <p>Nome: <span id="nome"><?php echo $nome; ?></span></p>
                            <p>Permissão: <span id="permissao"><?php echo $tipo_usuario; ?></span></p>
                            <p>CPF: <span id="cpf"><?php echo $cpf; ?></span></p>
                            <p>Data de Nascimento: <span id="data_nascimento"><?php echo $data_nascimento; ?></span></p>
                            <p>Cidade: <span id="cidade"><?php echo $cidade; ?></span></p>
                        </div>
            </section>

        </main>

    </body>

    </html>

<?php else:
    include '../../components/requisicao_login.php';
?>
<?php endif; ?>