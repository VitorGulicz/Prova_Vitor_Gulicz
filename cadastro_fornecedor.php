<?php 
session_start();
require_once 'conexao.php';
require_once 'menudrop.php';

//Verifica se o usuario tem permissão
//supondo que o perfil 1 seja o ADM
if($_SESSION['perfil']!= 1){
    echo "Acesso negado";
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $contato = $_POST['contato'];

    $sql = "INSERT into fornecedor(nome_fornecedor, endereco, telefone, email, contato) values(:nome_fornecedor, :endereco, :telefone, :email, :contato)";
    $stmt = $pdo ->prepare($sql);
    $stmt->bindparam(':nome_fornecedor', $nome_fornecedor);
    $stmt->bindparam(':endereco', $endereco);
    $stmt->bindparam(':telefone', $telefone);
    $stmt->bindparam(':email', $email);
    $stmt->bindparam(':contato', $contato);

    if($stmt->execute()){
        echo "<script>alert('Fornecedor Cadastrado com sucesso');</script>";
    }else{
        echo "<script>alert('Erro ao cadastrar fornecedor');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedor</title>
    <link rel="stylesheet" href="styles.css">
    <script src="mascara.js"></script>
    <link rel="stylesheet" href="tabela.css">
</head>
<body>
    <h2>Cadastrar Fornecedor</h2>
    <form action="cadastro_fornecedor.php" method="POST">
        <label for="nome_fornecedor">Nome do Fornecedor: </label>
        <input type="text" id="nome_fornecedor" name="nome_fornecedor" required onkeypress="mascara(this,nome1)">

        <label for="endereco">Endereço do Fornecedor: </label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="telefone">Telefone do Fornecedor: </label>
        <input type="text" id="telefone" name="telefone" required onkeypress="mascara(this,telefone1)" maxlength="15" >

        <label for="email">Email do Fornecedor: </label>
        <input type="email" id="email" name="email" required>

        <label for="contato">Contato do Fornecedor: </label>
        <input type="text" id="contato" name="contato" required onkeypress="mascara(this,nome1)">

        <button type="submit">Salvar</button>
        <button type="submit">Cancelar</button>
</form>
    <a href="principal.php" class="voltar">Voltar</a>
    </body>
</html>