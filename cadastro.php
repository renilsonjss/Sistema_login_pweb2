<?php

    require_once 'Classes/usuarios.php';
    $u = new Usuario;

?>

<html lang="pt-br">

<header>

    <meta charset="utf-8"/>
    <title>Sistema de Login e Cadastro</title>
    <link rel="stylesheet" href="./Css/estilo.css">

</header>

<body>

    <div class="formulario-cadastro">

        <h1>Cadastro</h1>

        <form method="POST">

            <label for="nome">Nome completo:</label>
            <input type="text" name="nome" maxlength="50">
            <label for="usuario">Nome de usuário:</label>
            <input type="text" name="usuario" maxlength="50">
            <label for="email">Email:</label>
            <input type="email" name="email" maxlength="50">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" maxlength="20">
            <input type="submit" value="Cadastrar">
            <a href="index.php">Login</a>

        </form>

    </div>

<?php

if(isset($_POST['nome']))
{
    $nome = addslashes($_POST['nome']);
    $usuario = addslashes($_POST['usuario']);
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($nome) && !empty($usuario) && !empty($email) && !empty($senha))
    {
        $u->conectarBanco("sistema_login","localhost","root","");
        if($u->msgErro == "")
        {
            if($u->cadastrar($nome, $usuario, $email, $senha))
            {
                ?>
                <div class="msg-cadastrado">
                    Usuário cadastrado com sucesso!
                </div>
                <?php
            }
            else
            {
                ?>
                <div class="msg-erro">
                    Este email já foi cadastrado!
                </div>
                <?php
            }
        }
        else
        {
            ?>
            <div class="msg-erro">
                <?php echo "Erro: ".$u->msgErro; ?>
            </div>
            <?php
        }
    }
    else
    {
        ?>
        <div class="msg-erro">
            Todos os campos devem ser preenchidos!
        </div>
        <?php
    }
}

?>

</body>

</html>