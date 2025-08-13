<?php
session_start();
require_once 'conexao.php';
require_once 'funcoes_email.php'; //arquivo com as funcoes que geram a senha e simulam o envio

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];

    $sql = "SELECT * FROM usuario WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindparam(':email',$email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if($usuario){
        // Gera uma senha temporaria e aleatoria 
        $senha_temporaria = gerarSenhaTemporaria();
        $senha_hash = password_hash($senha_temporaria,PASSWORD_DEFAULT);

        //Atualiza a senha do usuario no banco
        $sql = "UPDATE usuario SET senha = :senha, senha_temporaria = TRUE WHERE email = :email";
        $stmt= $pdo->prepare($sql);
        $stmt->bindparam(':senha',$senha_hash);
        $stmt->bindparam(':email',$email);
        $stmt->execute();

        //Simula o envio do email(Grava em txt)
        simularEnvioEmail($email,$senha_temporaria);
        echo"<script>alert('Uma senha temporaria foi gerada e enviada(simulação). Verifique o arquivo email_simulado.txt');window.location.href=login.php';</script>";
    }else{
        echo"<script>alert('E-mail não encontrado');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Recuperar Senha</h2>
    <form action='recuperar_senha' method="POST">
    <label for="email">Digite o seu e-mail cadastrado</label>
        <input type="email" id="email" name="email" required>

        <button type="submit">Enviar Senha Temporaria</button>
</form>
</body>
</html>