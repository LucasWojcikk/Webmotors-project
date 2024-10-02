<?php
    $title = "Entrar em WebMotors";
    include '../../components/header.php';
    include '../../config/config.php';
    session_start();

    if (@$_REQUEST["botao"] == "Entrar"){

        if (isset($_POST["botao"]) && $_POST["botao"] == "Entrar") {
            // Obtenção dos valores do formulário
            $login = $_POST["usuario"];
            $senha = $_POST["senha"];
    
            // Preparar a consulta com placeholders (?)
            $stmt = $con->prepare("SELECT id, login, senha, tipo_usuario FROM usuarios WHERE login = ?");
            
            // Associar o valor do usuário ao placeholder (?)
            $stmt->bind_param("s", $login); // "s" significa string
            
            // Executa a consulta
            $stmt->execute();
            
            // Obter o resultado da consulta
            $resultado = $stmt->get_result();
    
            if ($resultado->num_rows > 0) {
                // Verificar se o usuário foi encontrado
                $coluna = $resultado->fetch_assoc();
    
                // Verificar se a senha está correta usando password_verify
                if (password_verify($senha, $coluna['senha'])) {
                    // Armazenar dados na sessão
                    $_SESSION["id_usuario"] = $coluna["id"];
                    $_SESSION["nome_usuario"] = $coluna["login"];
                    $_SESSION["nivel_usuario"] = $coluna["tipo_usuario"];
    
                    // Redirecionar o usuário com base no nível de acesso
                    if ($coluna["tipo_usuario"] == "admin") {
                        header("Location: pagina_inicial.php");
                        exit;
                    }
                    elseif($coluna["tipo_usuario"] == "user") {
                        header("Location: pagina_inicial.php");
                        exit;
                    }
                } 
                else {
                    echo "Senha incorreta.";
                }
            } else {
                echo "Usuário não encontrado.";
            }
    
            // Fechar o statement e a conexão
            $stmt->close();
        }
    }
?>


<html>
    <head>
        <link href="../../public/css/login.css" rel="stylesheet">
        
    </head>

    <body class="d-flex flex-column h-100">
        <div class="container-fluid d-flex justify-content-center align-items-center h-100">
            <div class="row justify-content-center align-items-center w-100">
                <form class="col-sm-8 col-md-6 col-lg-4 form" method="post">
                    <p class="form-title">Faça login para iniciar sua sessão</p>
                    <div class="input-container"><input name="usuario" placeholder="Digite seu usuario..."><span></span></div>
                    <div class="input-container"><input name="senha" type="password" placeholder="Digite sua senha..."></div>
                    <button name="botao" value="Entrar" type="submit" class="submit">Entrar</button>
                    <p class="signup-link">Não tem uma conta? <a href="registrar_usuario.php" data-toggle="modal" data-target="#registerModal">Registre-se</a></p>
                </form>
            </div>
        </div>
    </body>
</html>