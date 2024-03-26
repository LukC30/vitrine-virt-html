<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/card.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .navbar-brand img {
            max-width: 100px;
            
            height: auto;
        }
    </style>
            <?php
            $id = $_GET['id'] ?? '';
            echo "<script>";
            echo "let url = '$id';";
            echo "</script>";
        ?>
</head>

<body>
    <!--começo da navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./index.php"><img src="./images/MT.dd489150c93fe88a14be.png" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="./Produtos.php">Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Item 1</a>
                            <a class="dropdown-item" href="#">Item 2</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Item 3</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Pesquise aqui" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
                   <a href="carrinho.php"> <i style="font-size: 24px; margin-left: 80%;" class="fa">&#xf290;</i></a>         
                </form>
            </div>

        </div>
    </nav>
    <?php
        include './Php/env.php';
        $url = HostBackEnd;
        echo "<script defer>";
        echo "let urlProduto = '$url';";
        echo "</script>";
    ?>
    <script>
        let produto = []
        console.log(`${urlProduto}produtos.php?id=${url}`);
        fetch(`${urlProduto}produtos.php?id=${url}`)
        .then((response)=>{
            return response.json();
        })
        .then((data)=>{
            produto = data;
            document.getElementById('imgLivro').src = produto.caminho;
            document.getElementById('tituloLivro').innerText = produto.descricao;
            document.getElementById('preco').innerText = `R$${(produto.preco).toFixed(2)}`;
            document.getElementById('precoDesconto').innerText = (produto.preco*1.3).toFixed(2);
            document.getElementById('nomeGrupo').innerText = produto.nome_grupo;
        })
        let num = 0
        function adicionarItem(){
            num = parseInt(document.getElementById('qtd').innerText);
            num++;
            console.log(num);
            document.getElementById('qtd').innerText = num.toString();
            document.getElementById('preco').innerText = `R$${(produto.preco*num).toFixed(2)}`
            document.getElementById('precoDesconto').innerText = `R$${(produto.preco*1.3*num).toFixed(2)}`
        }

        function removerItem(){
            num = parseInt(document.getElementById('qtd').innerText);
            num--;
            if(num <= 0){
                num = 1;
            }
            console.log(num);
            document.getElementById('qtd').innerText = num.toString();
            document.getElementById('preco').innerText = `R$${(produto.preco*num).toFixed(2)}`
            document.getElementById('precoDesconto').innerText = `R$${(produto.preco*1.3*num).toFixed(2)}`
        }
        
        function cart(){
        let cartJson = localStorage.getItem("produtos");
        let carrinho = cartJson ? JSON.parse(cartJson) : [];
        let precoTot = document.getElementById('preco').innerText;
        let produtoCart = {
        nome: document.getElementById('tituloLivro').innerText,
        quantidade: document.getElementById('qtd').innerText,
        precoUnit: (produto.preco).toFixed(2),
        precoTotal: precoTot
        };
        document.getElementById('qtd').innerText = "1";
        removerItem();
        carrinho.push(produtoCart);
        localStorage.setItem("produtos", JSON.stringify(carrinho));
        console.log(localStorage.getItem("produtos"));
        alert("Seu produto foi adicionado ao carrinho!");
    }
    </script>

    <br>
    <br>
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="cardImagem">
                    <img id="imgLivro" class="imagem" src="" alt="{altImagem}" style="width: 100%; height: auto;" />
                </div>
            </div>
            <div class="col-md-6">
                <div style="border-radius: 15px; max-width: 200px; text-align: center; color: white;" class="bg-primary"><span>30% DE DESCONTO</span></div>
                <br/>
                <div class="divTexto" style="width: 100%;">
                    <h1 class="tituloLivro" id="tituloLivro">
                         
                    </h1><span class="tipoLivro" id="nomeGrupo"></span>
                    <hr class="hr" />
                    <p class="descricao">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Amet culpa incidunt dolores rerum commodi, beatae voluptatum cupiditate consectetur minus cum perferendis accusantium explicabo quia suscipit dolor sint sunt numquam corrupti.
                    </p>
                    <hr class="hr"/>
                    <span>De: </span>
                    <span style="text-decoration: line-through; color: gray;" id="precoDesconto"></span>
                    <div class="row">
                        <div class="col">
                            <span style="justify-content: right; font-size: 150%; color: #000000;" id="preco">R$ {(preco * qtd).toFixed(2)}</span>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-light" onclick="removerItem()"> - </button>
                            <span style="color: #000000;" id="qtd">1</span>
                            <button type="button" class="btn btn-light" onclick="adicionarItem()"> + </button>
                        </div>
                    </div>
                    <br />
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary" type="button" onclick="cart()">Enviar ao carrinho</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
