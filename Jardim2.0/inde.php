<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Menu de Navegação</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
   
</head>
<body>
    <!-- Bem-vindo -->
    <div class="welcome-bar">
        <i class="fas fa-user"></i>
        <span>Bem-vindo ao Jardim de Aroma!</span>
    </div>
    
    <!-- Menu principal -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="./img/logo/logo.png" alt="Logo">
            <span>JARDIM DE AROMA</span>
        </a>
        <div class="search-bar">
            <input class="form-control" type="search" placeholder="O que você busca hoje?" aria-label="Search">
            <button class="btn " style="background-color: #48b30a; color: whitesmoke;" type="submit">Buscar</button>
        </div>
    </nav>
    
    <!-- Menu ícones -->
    <div class="container">
        <div class="border-top"></div>
        <div class="icon-menu">
            <div class="icon-item dropdown">
                <a href="#">
                    <i class="fas fa-water"></i>
                    <span>Velas Aromáticas</span>
                </a>
                <div class="dropdown-content">
                    <a href="#">Clássicas</a>
                    <a href="#">Esculturais</a>
                </div>
            </div>
            <a class="icon-item" href="#">
                
                <span>Home Spray</span>
            </a>
            <a class="icon-item" href="#">
                <i class="fas fa-water"></i>
                <span>Wax Melts</span>
            </a>
            <a class="icon-item" href="#">
                <i class="fas fa-water"><img src="./img/icones/12856034.png" style="width:42px;height:42px;"></i>
                <span>Difusor de Varetas</span>
            </a>
            <a class="icon-item" href="#">
                <i class="fas fa-water"></i>
                <span>Sabonete Líquido</span>
            </a>
            <a class="icon-item" href="#">
                <i class="fas fa-water"></i>
                <span>Lembrancinhas</span>
            </a>
        </div>
    </div>

    <!-- Carrossel -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="./img/publi/publi2.jpg" class="d-block mx-auto" alt="Imagem 1" style="max-width: 800px; height: auto;">
            </div>
            <div class="carousel-item">
                <img src="./img/publi/publi2.jpg" class="d-block mx-auto" alt="Imagem 2" style="max-width: 800px; height: auto;">
            </div>
            <div class="carousel-item">
                <img src="./img/publi/publi2.jpg" class="d-block mx-auto" alt="Imagem 3" style="max-width: 800px; height: auto;">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>

    <!-- Linha separadora com título -->
    <div class="separator">
        <h1 style="font-family: m;">Lavanda</h1>
        <div class="line"></div>
    </div>

    <!-- Cards -->
    </div>

    <main class="container mt-2">
        <div class="row justify-content-center d-flex flex-wrap">
      

            <?php include './produtos/produtos.php'; Vela::exibirProdutos(); ?>
        </div>
    </main>




    <!-- Scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>

