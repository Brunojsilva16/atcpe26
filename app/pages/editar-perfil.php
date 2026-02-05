<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cadastro - Identificação</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./src/styles/edit-style1.css">
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" href="./favicon.png" sizes="32x32">

    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            /* Cor de fundo suave */
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: #ffffff;
            border-radius: 1rem;
            /* Cantos arredondados */
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            /* Sombra suave */
            padding: 2.5rem;
            width: 100%;
            max-width: 28rem;
            /* Largura máxima para o card */
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            /* Borda cinza */
            border-radius: 0.5rem;
            /* Cantos arredondados */
            font-size: 1rem;
            line-height: 1.5;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        .input-field:focus {
            border-color: #3b82f6;
            /* Borda azul ao focar */
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
            /* Sombra azul ao focar */
        }

        .btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.1s ease-in-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-yellow {
            background-color: #facc15;
            /* Amarelo */
            color: #1f2937;
            /* Texto escuro */
        }

        .btn-yellow:hover {
            background-color: #eab308;
            /* Amarelo mais escuro no hover */
            transform: translateY(-1px);
        }

        .btn-green {
            background-color: #10b981;
            /* Verde */
            color: #ffffff;
            /* Texto branco */
        }

        .btn-green:hover {
            background-color: #059669;
            /* Verde mais escuro no hover */
            transform: translateY(-1px);
        }

        .link-text {
            color: #3b82f6;
            /* Azul */
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease-in-out;
        }

        .link-text:hover {
            color: #2563eb;
            /* Azul mais escuro no hover */
            text-decoration: underline;
        }

        .message-box {
            background-color: #fef2f2;
            color: #ef4444;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            display: none;
            /* Escondido por padrão */
            font-size: 0.875rem;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="mb-3">Editar Perfil Profissional</h2>
        <p class="text-muted mb-4">Para começar, por favor, informe o seu e-mail de cadastro para que possamos localizar seus dados.</p>

        <form id="emailForm" class="space-y-4">
            <div>
                <label for="email" class="block text-left text-gray-700 text-sm font-medium mb-1">Seu e-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@dominio.com" class="input-field" autocomplete="email" required>
            </div>
            <div id="passwordSection" class="space-y-4 hidden">
                <label for="password" class="block text-left text-gray-700 text-sm font-medium mb-1">Senha</label>
                <input type="password" id="password" name="password" placeholder="Sua senha" autocomplete="current-password" class="input-field">
                <div class="flex justify-between items-center text-sm">
                    <!-- <a href="#" id="firstAccessLink" class="link-text">Primeiro Acesso?</a> -->
                    <a href="forgot_password" class="link-text">Esqueceu a senha?</a>
                </div>
            </div>
            <div class="message-box" id="messageBox"></div>
            <div class="flex justify-between mt-6">
                <a href="home">
                    <button type="button" id="backButton" class="btn btn-yellow">Voltar</button>
                </a>
                <button type="submit" id="nextButton" class="btn btn-green">Avançar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./src/js/editar_perfil.js"></script>
<?php
include './includes/footer.php'
?>
</body>

</html>