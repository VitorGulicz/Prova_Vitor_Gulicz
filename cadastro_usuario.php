<?php 
session_start();
require_once 'conexao.php';

//Verifica se o usuario tem permissão
//supondo que o perfil 1 seja o ADM
if($_SESSION['perfil']!= 1){
    echo "Acesso negado";
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'],PASSWORD_DEFAULT);
    $id_perfil = $_POST['id_perfil'];

    $sql = "INSERT into usuario(nome, email, senha, id_perfil) values(:nome, :email, :senha, :id_perfil)";
    $stmt = $pdo ->prepare($sql);
    $stmt->bindparam(':nome', $nome);
    $stmt->bindparam(':email', $email);
    $stmt->bindparam(':senha', $senha);
    $stmt->bindparam(':id_perfil', $id_perfil);

    if($stmt->execute()){}
}
?>