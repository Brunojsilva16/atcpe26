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
    <link rel="stylesheet" href="./src/styles/navbar.css">
    <link rel="stylesheet" href="./src/styles/home1.css">
    <link rel="stylesheet" href="./src/styles/quem-somos.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="icon" href="./assets/favicon.png" sizes="32x32">
</head>

<body>
    <?php
    include './includes/navbar.php'
    ?>

    <!-- Container Principal -->
    <div class="container">

        <!-- Cabeçalho do Perfil -->
        <header class="profile-header">
            <img class="profile-picture"
                src="./assets/foto/248037gabrielmedeiros1994.jpeg"
                alt="Foto do CEO"
                onerror="this.onerror=null;this.src='https://placehold.co/200x200/E2E8F0/4A5568?text=Foto+Indispon%C3%ADvel';">
            <h1 class="profile-name">Gabriel Medeiros</h1>
            <p class="profile-title">Presidente</p>
        </header>

        <!-- Seção de Conteúdo Principal (Coluna Única) -->
        <main class="content-section">

            <!-- Card: Quem Somos -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h4a2 2 0 012 2v1m-4 0h4" />
                    </svg>
                    <h2 class="card-title">Quem Somos</h2>
                </div>
                <p class="card-body">A ATC-PE é uma associação civil, sem fins lucrativos, com finalidade social e educacional. Ela visa promover, no estado de Pernambuco, com ética e rigor científico, o estudo das terapias cognitivas, assim como a prática clínica de seus profissionais associados.</p>
                <p class="card-body">A ATC-PE é vinculada à Federação Brasileira de Terapias Cognitivas (FBTC) e, desta maneira, busca continuamente a promoção de eventos científicos, discussão de casos clínicos e palestras, além de realizar a divulgação de notícias referentes às Terapias Cognitivas, sempre com o objetivo maior de compartilhar experiências e incentivar a produção científica no âmbito dessas abordagens.</p>

            </div>

            <!-- Card: Objetivos -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-9.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222 4 2.222V20M12 12L8 9.778 4 12l4 2.222L12 12z" />
                    </svg>
                    <h2 class="card-title">Objetivos</h2>
                </div>
                <p class="card-body">Estimular o desenvolvimento e divulgar as Terapias Cognitivas no estado de Pernambuco, zelando pela ética e pelo padrão científico das abordagens e da prática clínica de seus profissionais associados.
                </p>
                <p class="card-body">Contribuir para o aperfeiçoamento dos estudantes e profissionais que se dedicam ao estudo e ao trabalho com as abordagens das Terapias Cognitivas, promovendo e apoiando discussões de casos clínicos, palestras, workshops, simpósios e cursos de curta duração referentes a essa temática.</p>
                <p class="card-body">Divulgar notícias e eventos referentes às Terapias Cognitivas de forma a manter seus associados atualizados sobre o que está acontecendo nessa temática em nosso país.
                </p>
                <p class="card-body">Apoiar e Desenvolver ações articuladas com a Federação Brasileira de Terapias Cognitivas e com as demais ATC’s do país, para a integração e fortalecimento das Terapias Cognitivas no Brasil.
                </p>
                <p class="card-body">Colaborar com estudos e pesquisas sobre as Terapias Cognitivas, que atendam aos padrões éticos e científicos, de modo a contribuir para a avaliação e desenvolvimento de intervenções mais eficazes nessa área.
                </p>

            </div>

            <!-- Card: Atividades Desenvolvidas -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    <h2 class="card-title">Atividades Desenvolvidas</h2>
                </div>
                <p class="card-body">Organização e realização de cursos básicos, atualização e capacitação em Terapia Cognitivo-Comportamental;
                </p>
                <p class="card-body">Organização e realização de palestras, encontros, jornadas e simpósios que proporcionem, aos sócios e aos interessados, o aprofundamento e a atualização de conhecimento técnico-científico em Terapia Cognitivo-Comportamental;
                </p>
                <p class="card-body">Promoção de intercâmbio técnico-profissional entre os associados da ATC e entidades congêneres;
                </p>
                <p class="card-body">Promoção de estudos e pesquisas que colaborem com o desenvolvimento da Terapia Cognitivo-Comportamental;
                </p>
                <p class="card-body">Promoções voltadas ao acesso dos associados a publicações e informações na área da Terapia Cognitivo-Comportamental.
                </p>
            </div>

            <!-- Card: Histórico -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h2 class="card-title">Histórico</h2>
                </div>
                <p class="card-body">No dia 29 de setembro de 2004, como o resultado de esforços de psicólogos e médicos psiquiatras do estado de Pernambuco, foi fundada, com o intuito de promover e divulgar as terapias cognitivo-comportamentais, uma associação, à época, denominada de Associação Pernambucana de Psicoterapia Cognitivo Comportamental (APC).

                </p>
                <p class="card-body">No mês de abril do ano de 2009, houve a oportunidade de vinculação à Federação Brasileira de Terapias Cognitivas (FBTC) e, diante isso, a então APC, passou a se denominar-se Associação de Terapias Cognitivas do Estado de Pernambuco (ATC-PE). Uma associação civil com finalidade educacional e social.
                </p>
                <p class="card-body">Desde sua fundação já foram realizados 10 simpósios estaduais, além de diversos encontros, workshops e demais formatos de eventos. Em 2021, a Liga Acadêmica da ATC-PE foi fundada. Em 2024 fora aprovado um novo estatuto, aproximando ainda mais a ATC-PE da FBTC.
                </p>
            </div>

            <!-- Card: Estatuto Social -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    <h2 class="card-title">Estatuto Social</h2>
                </div>
                <p class="card-body">Acesse o documento completo com as diretrizes e normas que regem nossa organização.</p>
                <a href="./assets/edital/ATCPE_Estatuto2023.pdf" target="_blank" class="card-button">Leia nosso estatuto, clique aqui. (Download)</a>
            </div>

                            <!-- Card: Nossa Visão -->
                            <!-- <div class="card">
                <div class="card-header">
                <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h2 class="card-title">Nossa Visão</h2>
                </div>
                <p class="card-body">Texto sobre a visão da empresa e do CEO.</p>
                <a href="#" class="card-button">Explore a estratégia</a>
                </div> -->

                            <!-- Card: Liderança e Pessoas -->
                            <!-- <div class="card">
                <div class="card-header">
                <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <h2 class="card-title">Liderança e Pessoas</h2>
                </div>
                <p class="card-body">Texto sobre a cultura da empresa e a importância da equipe.</p>
                <a href="#" class="card-button">Conheça nossa cultura</a>
                </div>
                -->

            <!-- Card: Proposta de Gestão -->
            <div class="card">
                <div class="card-header">
                    <svg class="card-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    <h2 class="card-title">Proposta de Gestão - 2024-2026</h2>
                </div>
                <h4 class="card-title">Reconhecendo e integrando a TCC em Pernambuco</h4>
                <p class="card-body">Publicação de Conteúdo nas Redes Sociais, com maior interação e participação dos associados</p>
                <p class="card-body">Realização do XI Simpósio Estadual</p>
                <p class="card-body">Dar continuidade à realização dos Encontros Pernambucanos anuais</p>
                <p class="card-body">Realização de minicursos ou formações exclusivas para associados</p>
                <p class="card-body">Divulgar eventos e formações propostas por associados e instituições parceiras</p>
                <p class="card-body">Identificação do perfil dos terapeutas cognitivo-comportamentais no interior de Pernambuco, identificando seus processos formativos, atuação e necessidades</p>
                <p class="card-body">Promover eventos de promoção das Terapias Cognitivo-Comportamentais no interior do Estado</p>
                <p class="card-body">Dar maior visibilidade aos associados, facilitando seus contatos ao público geral</p>
                <p class="card-body">Cadastrar e apoiar as Ligas Acadêmicas de Terapias Cognitivo-Comportamentais para apoio e divulgação</p>
                <p class="card-body">Otimização de processos administrativos da ATC-PE</p>
                <p class="card-body">Buscar parcerias para aumentar os benefícios para os associados</p>
                <p class="card-body">Desenvolver política de valor ajustado para pessoas de baixa renda em eventos</p>
                <a href="#" class="card-button">Leia o proposta completa</a>
            </div>

        </main>

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