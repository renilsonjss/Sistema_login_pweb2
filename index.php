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

    <div class="formulario">

        <h1>Login</h1>

        <form method="POST">

            <label for="email">Email:</label>
            <input type="email" name="email" maxlength="50">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" maxlength="20">
            <input type="submit" value="Entrar">
            <a href="cadastro.php">Cadastrar-se</a>

        </form>

    </div>

<?php

if(isset($_POST['email']))
{
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);

    if(!empty($email) && !empty($senha))
    {
        $u->conectarBanco("sistema_login","localhost","root","");
        if($u->msgErro == "")
        {
            if($u->logar($email, $senha))
            {
                header("location: lista_usuarios.php");
            }
            else
            {
                ?>
                <div class="msg-erro">
                    Email e/ou senha incorretos!
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