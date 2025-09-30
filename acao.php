<?php
session_start();
include "conexao.php";

switch ($_GET['a']){
    case 'cadastrar':
        if(isset($_POST['cadastrar'])){
        $status = $_POST['StatusProduto'];
        $categoria = $_POST['CategoriaProduto'];
        $nome = $_POST['NomeProduto'];
        $descricao= $_POST['DescricaoProduto'];
        $preco = $_POST['PrecoProduto'];
        $estoque = $_POST['EstoqueProduto'];

        $sql="INSERT INTO produtos(status, categoria, nome, descricao, preco, estoque) VALUES (:status, :categoria, :nome, :descricao, :preco, :estoque)";

        $execucao = $pdo->prepare($sql);

        $execucao->execute([':status'=>$status, ':categoria'=>$categoria, ':nome'=>$nome, ':descricao'=>$descricao, ':preco'=>$preco, ':estoque'=>$estoque]);
        
    }
    header("Location: /cadastroprodutos/index.php");
    exit;
    break;
    case 'editar':
        
            $produto = $_GET['id'];
            $status = $_POST['StatusProduto'];
            $categoria = $_POST['CategoriaProduto'];
            $nome = $_POST['NomeProduto'];
            $descricao= $_POST['DescricaoProduto'];
            $preco = $_POST['PrecoProduto'];
            $estoque = $_POST['EstoqueProduto'];
    
            $sql="UPDATE produtos SET status= :status, categoria= :categoria, nome= :nome, descricao= :descricao, preco= :preco, estoque= :estoque WHERE id= :id";
    
            $preparacao = $pdo->prepare($sql);
    
            $executa = $preparacao->execute([
            ':status'=>$status,
            ':categoria'=>$categoria,
            ':nome'=>$nome,
            ':descricao'=>$descricao,
            ':preco'=>$preco,
            ':estoque'=>$estoque,
            ':id'=>$produto]);
            
        
        header("Location: /cadastroprodutos/index.php");
        exit;
        break;
    case 'deletar':
        $qual= $_GET['id'];
        $sql= "DELETE FROM produtos WHERE id= $qual";
        $execucaod= $pdo->query($sql);
        header("Location: /cadastroprodutos/index.php");
}
?>
