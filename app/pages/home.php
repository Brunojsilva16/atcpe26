<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
        <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./src/styles/carousel1.css">
    <link rel="stylesheet" href="./src/styles/navbar.css">
    <link rel="stylesheet" href="./src/styles/home1.css">
    <link rel="stylesheet" href="./src/styles/associe-se.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="icon" href="./assets/favicon.png" sizes="32x32">
</head>


<body class="font-sans">    

    <?php
        include './includes/navbar.php'
    ?>

    <section class="home mt-12">

        <div id="descri_home" class="page-content container">
            <div class="inner-content">
                <h1>Bem-vindo à Nova Página!</h1>
                <p>
                    A ATC-PE é uma associação civil, sem fins lucrativos, com finalidade social e educacional. Ela visa promover, no estado de Pernambuco, com ética e rigor científico, o estudo das terapias cognitivas, assim como a prática clínica de seus profissionais associados.
                </p>
                <p>
                    A ATC-PE é vinculada à Federação Brasileira de Terapias Cognitivas (FBTC) e, desta maneira, busca continuamente a promoção de eventos científicos, discussão de casos clínicos e palestras, além de realizar a divulgação de notícias referentes às Terapias Cognitivas, sempre com o objetivo maior de compartilhar experiências e incentivar a produção científica no âmbito dessas abordagens.
                </p>

                <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type .</p>

                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type .</p> -->
                <div>
                    <div id="logoof" class="h-96">
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="container my-5">
        <h2 class="text-center mb-4">Encontre um(a) profissional</h2>
        <h2 class="text-center mb-4"></h2>
        <div id="professional-carousel" class="carousel slide" data-bs-ride="false">
            <div class="carousel-inner" id="carousel-container">
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#professional-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#professional-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Próximo</span>
            </button>
        </div>
        <!-- <div class="buscaAvancada">
            <a href="pesquisa">Busca Avançada</a>
        </div> -->

        <button type="button" class="btn btn-info">
            <a href="pesquisa">
                Encontre um(a) profissional <i class="fas fa-arrow-right"></i>
            </a>
        </button>
    </div>
    <hr>

    <h2 style="text-align: center;">ASSOCIE-SE AGORA</h2>
    <div id="associado" class="card-container">

        <a href="https://app.associatec.com.br/AreaAssociados/ATCPE" class="card-link">
            <div class="card card-light-green">
                <div class="card-content">
                    <h2 class="title">Estudante&nbsp;de<br>graduação</h2>
                    <div class="price">70,00</div>
                    <span class="mais">Saiba mais...</span>
                </div>
            </div>
        </a>
        <a href="https://app.associatec.com.br/AreaAssociados/ATCPE" class="card-link">
            <div class="card card-light-green">
                <div class="card-content">
                    <h2 class="title">Profissional&nbsp;de<br>Psicologia</h2>
                    <div class="price">110,00</div>
                    <span class="mais">Saiba mais...</span>
                </div>
            </div>
        </a>
        <a href="https://app.associatec.com.br/AreaAssociados/ATCPE" class="card-link">
            <div class="card card-light-green highlighted">
                <div class="card-content">
                    <h2 class="title">Profissional&nbsp;de<br>Psiquiatria</h2>
                    <div class="price">110,00</div>
                    <span class="mais">Saiba mais...</span>
                </div>
            </div>
        </a>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./src/js/carousel.js"></script>
    <script src="./src/js/navbar.js"></script>
    <?php
        include './includes/footer.php'
    ?>
</body>

</html>