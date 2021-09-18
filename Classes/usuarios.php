<?php

Class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectarBanco($nome, $host, $usuario, $senha)
    {
        global $pdo;
        global $msgErro;

        try
        {
            $pdo = new PDO("mysql:dbname=".$nome.";host=".$host,$usuario,$senha);
        } catch (PDOException $e) {
            $msgErro = $e->getMessage();
        }
    }

    public function cadastrar($nome, $usuario, $email, $senha)
    {
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e;");
        $sql->bindValue(":e",$email);
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            return false;
        }
        else
        {
            $sql = $pdo->prepare("INSERT INTO usuarios (nome, usuario, email, senha) VALUES (:n, :u, :e, :s);");
            $sql->bindValue(":n",$nome);
            $sql->bindValue(":u",$usuario);
            $sql->bindValue(":e",$email);
            $sql->bindValue(":s",md5($senha));
            $sql->execute();
            
            return true;
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s;");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();

        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id'] = $dado['id'];

            return true;
        }
        else
        {
            return false;
        }
    }

    public function listar($nome, $usuario, $email, $senha)
    {
        global $pdo;
        global $msgErro;

        $sql = $pdo->prepare("SELECT * FROM usuarios");
        $sql->execute();
    }
}

?>