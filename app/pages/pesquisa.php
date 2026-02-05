<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
        <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./src/styles/carousel1.css">
    <link rel="stylesheet" href="./src/styles/navbar.css">
    <link rel="stylesheet" href="./src/styles/home1.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="icon" href="./assets/favicon.png" sizes="32x32">
</head>

<body>
    <?php
    include './includes/navbar.php'
    ?>


    <div class="container" style="margin-top: 10rem;">
        <h2 class="text-center mb-4" style="margin-top: 4rem;">PESQUISA AVANÇADA</h2>

        <div class="p-4 mb-5" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 2.3rem;">
            <form id="filtro-form">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label for="filtro-nome" class="form-label">Profissional:</label>
                        <input type="text" id="filtro-nome" class="form-control" name="nome">
                    </div>
                    <div class="col-md-4">
                        <label for="filtro-publico" class="form-label">Público de atendimento:</label>
                        <select id="filtro-publico" class="form-select" name="publico_atend">
                            <option selected>Todos</option>
                            <option>Criança</option>
                            <option>Adolescente</option>
                            <option>Adulto</option>
                            <option>Idoso</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filtro-modalidade_atendimento" class="form-label">Modalidade de atendimento:</label>
                        <select id="filtro-modalidade_atendimento" class="form-select" name="mod_atendimento">
                            <option selected>Todos</option>
                            <option>Ambos</option>
                            <option>Presencial</option>
                            <option>Online</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="filtro-plano" class="form-label">Atende Plano de Saúde:</label>
                        <select id="filtro-plano" class="form-select" name="plano_saude">
                            <option selected>Todos</option>
                            <option>Sim</option>
                            <option>Não</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filtro-cidade" class="form-label">Cidade:</label>
                        <input type="text" id="filtro-cidade" class="form-control" name="cidade">
                    </div>
                    <div class="col-md-4">
                        <label for="filtro-bairro" class="form-label">Bairro:</label>
                        <input type="text" id="filtro-bairro" class="form-control" name="bairro">
                    </div>

                </div>
                <div class="row col mt-4">
                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_profissional_radio" id="radio-psicologos" value="Profissional">
                            <label class="form-check-label" for="radio-psicológos">Apenas psicólogos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_profissional_radio" id="radio-psiquiatras" value="Psiquiatra">
                            <label class="form-check-label" for="radio-psiquiatras">Apenas psiquiatras</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="tipo_profissional_radio" id="radio-todos" value="" checked>
                            <label class="form-check-label" for="radio-todos">Todos</label>
                        </div>
                    </div>
                </div>
                <div class="row-md-3 mt-3">
                    <button type="button" id="btn-filtrar" class="btn btn-success">
                        <i class="fas fa-search"></i> Filtro
                    </button>
                    <button type="button" id="btn-limpar" class="btn btn-secondary">
                        <i class="fas fa-sync"></i> Limpar
                    </button>
                    <button type="button" class="btn btn-info" id="volta">
                        <a href="home">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                    </button>

                </div>
            </form>
        </div>
        <h4 id="contador-resultados" class="mb-3 d-none"></h4>
        <div id="resultado-pesquisa" class="row">
            <p class="text-center text-muted">Utilize os filtros acima para iniciar sua busca.</p>
        </div>

        <!-- <button id="voltar" type="button" class="btn btn-info voltar">
            <a href="home">
                <i class="fas fa-arrow-left"></i> voltar 
            </a>
        </button> -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="./src/js/pesquisa.js"></script>
    <script src="./src/js/navbar.js"></script>

    <?php
    include './includes/footer.php'
    ?>
</body>

</html>