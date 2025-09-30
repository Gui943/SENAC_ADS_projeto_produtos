<?php
session_start();
include "conexao.php";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <h1>Cadastro de Produtos</h1>
    <div class= "container">

    <?php if(!isset($_GET['editar'])){

    ?>

        <!-- Começo da parte do formulario -->
        <form action="/cadastroprodutos/acao.php?a=cadastrar" method="post">

            <div class= "mb-3">
                <label for="">
                    Status
                </label>
                <select name= "StatusProduto" required>
                    <option value="" disable selected>Status...</option>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Categoria do Produto
                </label>
                <select name="CategoriaProduto" class="form-select" required>
                    <option value="" disabled selected>Categoria...</option>
                    <option value="eletronicos">Eletrônicos</option>
                    <option value="moveis">Móveis</option>
                    <option value="roupas">Roupas</option>
                    <option value="alimentos">Alimentos</option>
                    <option value="outros">Sem Categoria</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Nome do Produto
                </label>
                <input type="text" class="form-control" name="NomeProduto" placeholder="Informe o produto" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Descrição do Produto
                </label>
                <textarea class="form-control" name="DescricaoProduto"></textarea>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Preço do Produto
                </label>
                <input type="number" min="0" step="0.01" class="form-control" name="PrecoProduto" required>
            </div>

            <div class="mb-3">
                <label for="">
                    Estoque
                </label>
                <input type="number" min="0" class="form-control" name="EstoqueProduto" placeholder= "1,2,3..."required>
            </div>

            <div>
                <button type="submit" name= "cadastrar" class="btn btn-primary">Cadastrar</button>
            </div>
    </form>
    
    <?php 
    }else{
        $produtos= $_GET['editar'];

        $sql= "SELECT * FROM produtos WHERE id= $produtos";
        $execucao = $pdo->query($sql);
        $produtos =  $execucao->fetchAll(PDO::FETCH_ASSOC);
        foreach($produtos as $key => $value){
    ?>

    <form action="/cadastroprodutos/acao.php?a=editar&id=<?php echo $value['id'];?>" method="post">
            <div class= "mb-3">
                <label for="">
                    Status (editar)
                </label>
                <select name= "StatusProduto" required>
                    <option value="" disable selected>Status...</option>
                    <option value="ativo">Ativo</option>
                    <option value="inativo">Inativo</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Categoria do Produto (editar)
                </label>
                <select name="CategoriaProduto" class="form-select" required>
                    <option value="" disabled selected>Categoria...</option>
                    <option value="eletronicos">Eletrônicos</option>
                    <option value="moveis">Móveis</option>
                    <option value="roupas">Roupas</option>
                    <option value="alimentos">Alimentos</option>
                    <option value="outros">Sem Categoria</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Nome do Produto (editar)
                </label>
                <input type="text" class="form-control" name="NomeProduto" placeholder="Informe o produto" required
                value="<?php echo $value['nome']; ?>">
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Descrição do Produto (editar)
                </label>
                <textarea class="form-control" name="DescricaoProduto"><?php echo $value['descricao']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">
                    Preço do Produto (editar)
                </label>
                <input type="number" class="form-control" name="PrecoProduto" required
                value="<?php echo $value['preco']; ?>">
            </div>

            <div class="mb-3">
                <label for="">
                    Estoque (editar)
                </label>
                <input type="integer" class="form-control" name="EstoqueProduto" placeholder= "1,2,3..."required
                value="<?php echo $value['estoque']; ?>">
                
            </div>

            <div>
            <button type="submit" value= "editar" class="btn btn-primary">Editar</button>
            </div>
        </form>
    <?php
        }
    }
        ?>
    </div>

    <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Preco</th>
                    <th scope="col">Estoque</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>

             <?php
             //Comando para trazer os dados do banco e mostrar na tela
                  $sql = "SELECT * FROM produtos ORDER BY id DESC";
                  $execucao = $pdo->query($sql);
                  $produtos =  $execucao->fetchAll(PDO::FETCH_ASSOC);
                  foreach ($produtos as $key => $value) {
                    
                    switch($value['status']){
                        case 'ativo':
                            $tipo_linha= 'table-success';
                            break;
                        case 'inativo':
                            $tipo_linha= 'table-danger';
                            break;
                        default:
                            $tipo_linha= '';
                    }
             ?>

                <tr class="<?php echo $tipo_linha; ?>">
                    <th scope="row"><?php echo $value['id']; ?></th>
                    <td><?php echo $value['nome']; ?></td>      
                    <td><?php echo $value['descricao']; ?></td>      
                    <td><?php echo $value['preco']; ?></td>  
                    <td> <?php echo $value['estoque']; ?></td>     
                    <td> <?php echo $value['categoria']; ?></td> 
                    <td><?php echo $value['status']; ?></td>      
                    
                    <td>
                    <a href="/cadastroprodutos/acao.php?a=deletar&id=<?php echo $value['id']?>" onclick= "return confirm('Deseja mesmo deletar esse produto?')">
                            Deletar
                        </a>

                    <a href="/cadastroprodutos/index.php?editar=<?php echo $value['id']?>" class= "ms-2">
                            Editar
                        </a>
                    </td>
                    <?php
                    }
                ?>
            </tbody>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
<?php echo "nome" ?>