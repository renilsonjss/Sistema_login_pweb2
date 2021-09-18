<?php

    require_once 'Classes/usuarios.php';

?>

<?php

session_start();
if(!isset($_SESSION['id']))
{
    header(":location index.php");
    exit;
}
else
{
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_login", "root", "");
    $sistema_login = $pdo->query("SELECT * FROM usuarios;");
    if ($sistema_login != NULL)
    { 
        ?>
        <h1>Lista de Usuários</h1>
            <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nome de usuário</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
        <?php 
            while($row = $sistema_login->fetch(PDO::FETCH_ASSOC))
            { 
                ?>
                    <tr>
                        <td><?php echo $row["nome"] ?></td>
                        <td><?php echo $row["usuario"] ?></td>
                        <td><?php echo $row["email"] ?></td>
                    </tr>
                <?php
            }
            
            ?>
                </tbody>
                </table>
            <?php 
    }
    else 
    { 
        ?>
            <p>Não há usuários cadastrados!</p>
        <?php
    }
}
    ?>


<a href="sair.php">Sair</a>