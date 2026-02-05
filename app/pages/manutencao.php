<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site em Manutenção</title>
    <!-- Carregando o Tailwind CSS para um design moderno e responsivo -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Carregando a fonte Inter do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* Aplicando a fonte Inter como padrão */
        body {
            font-family: 'Inter', sans-serif;
        }

        div#log {
            background-image: url(./assets/img/logo.png);
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            height: 20rem;
        }

        /* Definindo uma animação de rotação mais lenta */
        @keyframes spin-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin-slow {
            animation: spin-slow 4s linear infinite;
        }
    </style>
</head>

<body class="bg-green-50">
    <!-- Container principal que centraliza o conteúdo na tela -->
    <div class="min-h-screen flex items-center justify-center p-4">

        <!-- Card de conteúdo -->
        <div class="bg-white max-w-lg w-full rounded-2xl shadow-lg p-8 md:p-12 text-center">

            <!-- Ícone de Engrenagem Animado (SVG) -->
            <div class="mb-8">
                <!-- O ícone agora é maior e aplica a animação 'animate-spin-slow' -->
                <svg class="w-24 h-24 mx-auto text-green-500 animate-spin-slow" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.438.995s.145.755.438.995l1.003.827c.48.398.668 1.05.26 1.431l-1.296 2.247a1.125 1.125 0 01-1.37.49l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.127c-.331.183-.581.495-.644.87l-.213 1.281c-.09.543-.56.94-1.11.94h-2.593c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.645-.87a6.52 6.52 0 01-.22-.127c-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.437-.995s-.145-.755-.437-.995l-1.004-.827a1.125 1.125 0 01-.26-1.431l1.296-2.247a1.125 1.125 0 011.37-.49l1.217.456c.355.133.75.072 1.076-.124.072-.044.146-.087.22-.127.331-.183.581-.495.644-.87l.213-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>

            <!-- Título Principal -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Nosso site está em manutenção
            </h1>

            <!-- Mensagem de explicação -->
            <p class="text-gray-600 text-lg mb-8">
                Estamos fazendo algumas melhorias para deixar tudo ainda melhor para você. Voltaremos a ficar online em breve!
            </p>

            <!-- Rodapé com agradecimento -->
            <div class="border-t border-green-100 pt-6">
                <p class="text-gray-500">
                    Agradecemos a sua compreensão.
                </p>
            </div>

            <div id="log" class="mb-6">

            </div>

        </div>
    </div>
</body>

</html>