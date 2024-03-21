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
    <script src="./bootstrap/js/bootstrap.js"></script>
    <style>
        .navbar-brand img {
            max-width: 100px;
            
            height: auto;
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
    <br>
    <br>
    <div class="divTabelinha">
        <table id="tabelaItens" class="table table-striped table-hover" style="font-size: smaller;">
            <thead>
                <tr>
                    <th>Numero de pedidos</th>
                    <th>Nome do produto</th>
                    <th>Quantidade</th>
                    <th>Preço Unitario</th>
                    <th>Preço total do produto</th>
                </tr>
            </thead>

        </table>
        <h4 id="total">Total: </h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Enviar
        </button>
        
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Enviar itens</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Deseja enviar os itens do carrinho? Após o envio, o carrinho será limpo.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" onclick="enviarItens()">Enviar</button>
                </div>
            </div>
        </div>
    </div>
    <script defer src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script defer src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script defer>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')
    
        let precoCarrinho = 0;
        let carrinho = localStorage.getItem("produtos")
        let carrinhoJson = JSON.parse(carrinho);
        console.log(carrinhoJson);
        let itemList = "Olá, essa é minha lista:\n";
        if(carrinhoJson === null){
            alert("Que pena, seu carrinho não tem nenhum item ainda")
            window.location.href ="index.html"
        }
        const tabelaItens = document.getElementById('tabelaItens');
        let lista = "";
        let index = 1
        carrinhoJson.forEach((produto)=>{
            precoCarrinho += parseFloat(produto.precoTotal.replace(/[^\d.-]/g, ''));
            lista +=` 
                        <tr>
                            <th>${index}</th>
                            <th>${produto.nome}</th>
                            <th>${produto.quantidade}</th>
                            <th>${produto.precoUnit}</th>
                            <th>${produto.precoTotal}</th>
                        </tr>`;
                        index++;
        })
        tabelaItens.innerHTML += lista;
        document.getElementById('total').innerText +=" R$ " + (precoCarrinho).toFixed(2)
        function verificarCarrinho() {
            if (carrinho == null) {
                window.location.href = 'produtos.html'
                alert("Parece que você não comprou nada ainda, vamos voltar para o site!")
    
            }
        }
        function enviarItens() {
            
            carrinhoJson.forEach((produto) => {
                
                itemList += `\n\nNome: ${produto.nome} \nQuantidade: ${produto.quantidade} \nPreço Unitário: ${produto.precoUnit} \nPreço total: R$: ${(produto.precoTotal)}`;
            })
            itemList += `\n\nPreço Total: R$: ${(precoCarrinho).toFixed(2)}`
            let mensagem = encodeURIComponent(itemList)
            localStorage.clear();
            window.location.href = `https://wa.me/5521981981510?text=${mensagem}`
    
        }
    </script>
</body>

</html>