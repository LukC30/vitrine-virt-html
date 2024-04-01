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
        .carousel-item img {
            width: 50%;
            height: auto;
            margin: 0 auto;
            display: block;
        }
    </style>
    
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="produtos.php?categoria=utilitarios">Utilitarios</a>
                            <a class="dropdown-item" href="produtos.php?categoria=adaptadores">Adaptadores</a>
                            <a class="dropdown-item" href="produtos.php?categoria=lampadas">Lampadas</a>
                        </div>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0" onsubmit="return buscaItens()">
                    <input id="pesquisa" class="form-control mr-sm-2" type="search" placeholder="Pesquise aqui" aria-label="Search">
                    <button class="btn btn-primary my-2 my-sm-0" type="submit">Buscar</button>
                    <a href="carrinho.php"> <i style="font-size: 24px; margin-left: 80%;" class="fa">&#xf290;</i></a>
                </form>
            </div>

        </div>
    </nav>

    <!--final da navbar-->
    <script defer>
        function buscaItens(){
            var busca = document.getElementById('pesquisa').value;
            window.location.href = `./Produtos.php?nome=${busca}`
            return false;
        }
    </script>
    <br>
    <br>
    <br>
    <div id="cardContainer" class="cardContainer" style="display: flex; flex-direction: row; flex-wrap: wrap;">
    
    </div>
    <?php
    include './Php/env.php';
    $url = HostBackEnd;
    echo "<script>";
    echo "let urlProduto = '$url';";
    $categoria = $_GET['categoria'] ??'';
    $nome = $_GET['nome']??'';
    echo "let categoria = '$categoria';";
    echo "let nome = '$nome';";
    echo "</script>";
    ?>
    <script defer>
        
        let produtos = [];
        let url = `${urlProduto}api.php`;
        console.log(url)
        if(categoria != ""){
            url += `?categoria=${categoria}`
            console.log(url);
        } else if (nome != ""){
            url+=`?nome=${nome}`
        }
        fetch(url)
            .then(response => response.json())
            .then(data => {
                produtos = data;
                if(produtos.error){
                    alert("Não encontramos pelo item buscado, volte a pagina inicial")
                    window.location.href = 'index.php'
                }
                console.log(data);
                const cardContainer = document.getElementById('cardContainer');
                let cardHtml = "";
                produtos.forEach(produto => {
                    produto.preco
                    cardHtml += `
                        <div class="product-card">
                            <div class="badge">${produto.nome_grupo}</div>
                            <div class="product-tumb">
                                <img src="${produto.caminho}" alt="">
                            </div>
                            <div class="product-details">
                                <span class="product-catagory">${produto.grupo}</span>
                                <h4><a href="produto.php?id=${produto.id}">${produto.descricao}</a></h4>
                                <div class="product-bottom-details">
                                    <div class="product-price"><small></small>R$ ${(produto.preco).toFixed(2)}</div>
                                    <div class="product-links">
                                        <a href="produto.php?id=${produto.id}"><i class="fa fa-shopping-cart"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
                cardContainer.innerHTML = cardHtml;
            })
            .catch(error => console.log("erro na criacao do card" + error))
    </script>

    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
