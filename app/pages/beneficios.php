<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisa</title>
    <!-- Google Fonts: Inter -->
    <link rel="icon" href="./assets/favicon.png" sizes="32x32">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="./src/styles/home1.css">
    <link rel="stylesheet" href="./src/styles/beneficiosv2.css">
    <link rel="stylesheet" href="./src/styles/navbar.css">
    <link rel="stylesheet" href="./src/styles/footer.css">

    <style>
        /* --- Container Principal --- */
        .container {
            /* max-width: 00px; */
            margin: 10px auto;
            background-color: #ffffff;
            padding: 1.2rem 1.8rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        /* --- Título --- */
        h1 {
            color: #527d76;
            text-align: center;
            margin-bottom: 1.5em;
        }

        /* --- Lista de Benefícios --- */
        ul {
            list-style: none;
            /* Remove os marcadores padrão da lista */
            padding: 0;
        }

        li.iconlist {
            display: flex;
            /* Alinha o ícone e o texto lado a lado */
            align-items: flex-start;
            /* Alinha os itens no topo */
            margin-bottom: 1em;
            /* Espaçamento entre os itens da lista */
        }

        /* --- Ícone de Check --- */
        .checklist-icon {
            font-size: 1.5em;
            /* Tamanho do ícone */
            color: #27ae60;
            /* Cor verde para o ícone */
            margin-right: 15px;
            /* Espaço entre o ícone e o texto */
            line-height: 1.2;
            /* Ajusta o alinhamento vertical com o título */
        }

        /* --- Conteúdo do Item --- */
        .item-content strong {
            display: block;
            /* Faz o título ocupar sua própria linha */
            font-size: 1.1em;
            color: #34495e;
            margin-bottom: 0.5em;
            text-align: left;
        }

        .item-content p {
            margin: 0;
            color: #555;
            text-align: justify;
            hyphens: auto;
        }
    </style>
</head>

<body>
    <?php
    include './includes/navbar.php'
    ?>

     <div id="beneficiosAss" class="container">
        <h1>Benefícios do(a) associado(a)</h1>
        <ul>
            <li class="iconlist">
                <!-- Ícone -->
                <span class="checklist-icon">✓</span>
                <!-- Conteúdo de Texto -->
                <div class="item-content">
                    <strong>Descontos em eventos de parceiros</strong>
                </div>
            </li>
            <li class="iconlist">
                <!-- Ícone -->
                <span class="checklist-icon">✓</span>
                <!-- Conteúdo de Texto -->
                <div class="item-content">
                    <strong>Gratuidade ou valores diferenciados em evento da ATC-PE</strong>
                </div>
            </li>
            <li class="iconlist">
                <!-- Ícone -->
                <span class="checklist-icon">✓</span>
                <!-- Conteúdo de Texto -->
                <div class="item-content">
                    <strong>Eventos exclusivos para associados:</strong>
                    <p>Associados(as) tem acesso a eventos exclusivos, presenciais ou on-line. Workshops, grupos de estudo e outros formatos são ofertados apenas para quem está com a associação em dia. Os eventos poderão ser gratuitos ou pagos, a depender da proposta e custos envolvidos em sua organização.</p>
                </div>
            </li>

            <li class="iconlist">
                <!-- Ícone -->
                <span class="checklist-icon">✓</span>
                <!-- Conteúdo de Texto -->
                <div class="item-content">
                    <strong>Grupo no WhatsApp exclusivo para associado:</strong>
                    <p>No grupo de associados, você fica por dentro em primeira mão das novidades promovidas pela ATC-PE e instituições parceiras. Também é uma ótima oportunidade de estar em contato com colegas espalhados por todo Pernambuco.</p>
                </div>
            </li>

            <li class="iconlist">
                <!-- Ícone -->
                <span class="checklist-icon">✓</span>
                <!-- Conteúdo de Texto -->
                <div class="item-content">
                    <strong>Network com psicólogos, psiquiatras e estudantes:</strong>
                    <p>O(A) profissional de psicologia desde os primeiros passos necessita de uma rede de colaboração para por em seus planos em prática. Saber o que os colegas andam produzindo e promovendo nos favorece o aprendizado contínuo e compartilhado, além de projetos profissionais para uma carreira bem sucedida. Estar associado torna facilita, virtual ou presencialmente, estar próximo de colegas TCCistas.</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="container">

        <h1 class="main-title">Conheça nossos parceiros</h1>

        <main class="content-section">

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/b02.png" alt="Logo da Federação Brasileira de Terapias Cognitivas" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Federação Brasileira de Terapias Cognitivas (FBTC)</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> associação nacional dos profissionais e estudantes que se dedicam ao estudo e à prática das diferentes abordagens das Terapias Cognitivas e Contextuais no Brasil.
                        <br><br>
                        <strong>Benefícios:</strong> associados têm 50% na associação à FBTC.; associados FBTC também têm 50% na associação à ATC-PE.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/b01.jpg" alt="Logo do Centro Pernambucano de Psicologia Aplicada" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Centro Pernambucano de Psicologia Aplicada (CEPPA)</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> o CEPPA é um agente atuante na formação continuada em psicologia em Pernambuco. Responsável pela promoções de congressos e cursos, além de venda de materiais relacionados à avaliação psicológica, neuropsicológica e TCC.
                        <br><br>
                        <strong>Benefícios:</strong> 5% de desconto em jogos, baralhos e livros relacioandos à TCC; 10% em cursos promovidos pelo CEPPA.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/rioitaguary.png" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Empresarial Rio Itaguary</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> O Empresarial Rio Itaguary é um centro empresarial inovador, estrategicamente localizado (Rua Pintor Lula Cardoso Aires, 3196, Imbiribeira, Recife-PE) e com infraestrutura acessível e moderna com espaços pensados para promover networking. Possui dois espaços pensados para realização de eventos corporativos, científicos e treinamentos; um auditório com capacidade para 40 pessoas e a Arena de Negócios, com capacidade para até 100 pessoas e área para coffee break.
                        <br><br>
                        <strong>Benefícios:</strong> Para incentivar que nossos associados promovam seus próprios eventos, é ofertado 10% de desconto no valor dos alugueis do auditório e da Arena de Negócios.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/crescere.jpg" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">CRESCERE</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> CRESCERE / Reginete Cavalcanti. Com uma postura ética e comprometida com o ensino, temos como missão oferecer aos profissionais de psicologia e medicina qualificação com ênfase na Terapia Cognitivo-Comportamental. @crescere.pe.
                        <br><br>
                        <strong>Benefícios:</strong> 30% de desconto na matrícula e 5% nas mensalidades no Curso de Formação em Terapia Cognitivo-Comportamental (TCC) que é oferecido anualmente e 10% em cursos de curta duração.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/b04.png" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">PSICUIDAR & EDUCAR</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> A Psicuidar & Educar é uma empresa do ramo educacional e da saúde, fundada pela CEO Dr.ª Suely Santana, cujas ações são desenvolvidas atualmente em parceria com uma equipe de psicólgos. Tem por objetivo promover ações no âmbito da promoção, prevenção e tratamento em saúde, envolvendo diversas atividades em parceria com outros profissionais e/ou instituições. Compõe-se de dois núcleos: saúde e educação. @crescere.pe.
                        <br><br>
                        <strong>Benefícios:</strong> 10% nas atividades propostas pelo núcleo educacional.


                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/hubtcc.jpg" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">HubTCC</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> O HubTCC é uma plataforma de educação continuada voltada para a capacitação e atualização de profissionais na área de Terapias Cognitivas e Contextuais. Seu principal objetivo é contribuir para qualificação de estudantes de psicologia, psicólogos e psiquiatras, oferecendo um espaço de formação continuada e diálogo para o aprofundamento do conhecimento teórico e prático, de maneira criteriosa e embasada nas melhores práticas baseadas em evidências na área.
                        <br><br>
                        <strong>Benefícios:</strong> 25% em todos os cursos e conteúdos disponíveis na plataforma, mediante a utilização do cupom ATCPE.
                    </p>
                </div>
            </div>

            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/logo_001.png" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">ASSISTA Saúde Emocional</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> A Clínica ASSISTA é uma referência em saúde emocional, com mais de 20 anos de experiência, oferecendo serviços especializados em psicologia (com enfoque em terapia cognitivo-comportamental), fonoaudiologia e terapia ocupacional. O ASSISTA Conecta é o “braço institucional” da Clínica ASSISTA, voltado para liderar projetos educacionais, estreitar a conexão com a comunidade acadêmica e promover a capacitação profissional de psicólogos e demais profissionais da saúde. O ASSISTA Conecta organiza eventos acadêmicos, workshops, grupos de estudo e ações psicoeducativas tanto para o público profissional quanto para a comunidade em geral.
                        <br><br>
                        <strong>Benefícios:</strong> 20% de desconto em todos os eventos promovidos pela Clínica ASSISTA, além de um desconto equivalente nos serviços de psicoterapia com nossos profissionais.
                    </p>
                </div>
            </div>

            <!-- <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/eventos.jpg" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Eventos exclusivos para associados</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> Associados(as) tem acesso a eventos exclusivos, presenciais ou on-line. Workshops, grupos de estudo e outros formatos são ofertados apenas para quem está com a associação em dia. Os eventos poderão ser gratuitos ou pagos, a depender da proposta e custos envolvidos em sua organização.
                        <br><br>
                        <strong></strong>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/whatsapp.png" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Grupo no WhatsApp exclusivo para associado</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> No grupo de associados, você fica por dentro em primeira mão das novidades promovidas pela ATC-PE e instituições parceiras. Também é uma ótima oportunidade de estar em contato com colegas espalhados por todo Pernambuco.
                        <br><br>
                        <strong></strong>
                    </p>
                </div>
            </div>
            <div class="card">
                <div class="card-image-container">
                    <img src="./assets/img/network.jpg" alt="Logo do Empresarial Rio Itaguary" class="card-image">
                </div>
                <div class="card-text-content">
                    <h2 class="card-title">Network com psicólogos, psiquiatras e estudantes</h2>
                    <p class="card-body">
                        <strong>Sobre:</strong> O(A) profissional de psicologia desde os primeiros passos necessita de uma rede colaboração para por em seus planos em prática. Saber o que os colegas andam produzindo e promovendo nos favorece o aprendizado contínuo e compartilhado, além de projetos profissionais para uma carreira bem sucedida. Estar associado torna facilita, virtual ou presencialmente, estar próximo de colegas TCCistas.
                        <br><br>
                        <strong></strong>
                    </p>
                </div>
            </div> -->

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