<?php
    $title = "Registre-se";
    include '../../components/header.php';
    include '../../config/config.php';


    if (@$_REQUEST['botao'] == 'Registrar-se') {
        $cpf = $_POST["cpf-usuario"];

        $query_validar_cpf = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
        $result = mysqli_query($con, $query_validar_cpf);

        if (mysqli_num_rows($result) == 0) {
            $senha = $_POST["senha-usuario"];
            $validacao_senha = $_POST["confirmar-senha-usuario"];
            
            if ($senha == $validacao_senha) {
                $nome_usuario = $_POST["nome-usuario"];
                $data_nascimento = $_POST["data-nascimento-usuario"];
                $estado = $_POST["estado-usuario"];
                $cidade = $_POST["cidade-usuario"];
                $telefone = $_POST["telefone-usuario"];
                $login = $_POST["login-usuario"];
                $senha = password_hash($senha, PASSWORD_BCRYPT);

                $query_insert = (
                    "INSERT INTO usuarios (
                        nome, data_nascimento, cpf, estado, cidade, telefone, login, senha, tipo_usuario)
                    VALUES (
                        '$nome_usuario', '$data_nascimento', '$cpf', '$estado', '$cidade', '$telefone', '$login', '$senha', 'user')"
                );

                $result_insere = mysqli_query($con, $query_insert);

                if ($result_insere){
                    echo "Registro inserido com sucesso!";
                }
                else{
                    echo "Não foi possível inserir o registro!";
                }
            }

            else{
                echo "As senhas não correspondem";
            }

        } 
        else {
            echo "Este CPF já está cadastrado.";
        }

        mysqli_free_result($result);
    }
?>

<body>
    <!-- Anunciar veículo -->
    <div class="container mt-5">
        <h2 class="text-center">Registre-se</h2>
        <form name="registro-usuario" class="mx-auto" style="max-width: 900px;" method="post">
            
            <!-- Nome -->
            <div class="form-group">
                <label>Nome completo</label>
                <textarea class="form-control" name="nome-usuario" rows="1" placeholder="Digite seu nome completo..." required></textarea>
            </div>

            <!-- Data nascimento -->
            <div class="form-group">
                <label>Data de nascimento</label>
                <br>
                <input type="date" name="data-nascimento-usuario">
            </div>

            <!-- CPF -->
            <div class="form-group">
                <label>CPF</label>
                <textarea class="form-control" name="cpf-usuario" rows="1" placeholder="Digite o seu cpf..." required></textarea>
            </div>

            <!-- Estado -->
            <div class="form-group">
                <label>Estado</label>
                <textarea class="form-control" name="estado-usuario" rows="1" placeholder="Digite o nome do seu estado..." required></textarea>
            </div>

            <!-- Cidade -->
            <div class="form-group">
                <label>Cidade</label>
                <textarea class="form-control" name="cidade-usuario" rows="1" placeholder="Digite o nome da sua cidade..." required></textarea>
            </div>

            <!-- Telefone -->
            <div class="form-group">
                <label>Telefone</label>
                <textarea class="form-control" name="telefone-usuario" rows="1" placeholder="Digite seu telefone..." required></textarea>
            </div>

            <!-- Login -->
            <div class="form-group">
                <label>Login</label>
                <textarea class="form-control" name="login-usuario" rows="1" placeholder="Digite seu login..." required></textarea>
            </div>

            <!-- Senha -->
            <div class="form-group">
                <label>Senha</label>
                <textarea class="form-control" name="senha-usuario" rows="1" placeholder="Digite sua senha..." required></textarea>
            </div>

            <!-- Confirmar Senha -->
            <div class="form-group">
                <label>Confirmar senha</label>
                <textarea class="form-control" name="confirmar-senha-usuario" rows="1" placeholder="Digite novamente sua senha..." required></textarea>
            </div>

            <div class="d-flex justify-content-start mt-3">
                <button type="submit" class="btn btn-primary" name="botao" value="Registrar-se">Registrar-se</button>
                <a href="pagina_inicial.php" class="btn btn-primary ms-2">Cancelar</a>
            </div>

        </form>
    </div>

</body>

</html>