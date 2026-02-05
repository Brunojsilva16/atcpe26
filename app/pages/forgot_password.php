<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueceu a Senha?</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./src/styles/footer.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">

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
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            width: 100%;
            max-width: 32rem;
            text-align: center;
            margin: 1.5rem;
            border-top: 5px solid #527d76;
        }


        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            font-size: 1rem;
            line-height: 1.5;
            outline: none;
            transition: border-color 0.2s ease-in-out;
        }

        .input-field:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2);
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

        .btn-green {
            background-color: #10b981;
            color: #ffffff;
        }

        .btn-green:hover {
            background-color: #059669;
            transform: translateY(-1px);
        }

        .btn-gray {
            background-color: #6b7280;
            color: #ffffff;
        }

        .btn-gray:hover {
            background-color: #4b5563;
            transform: translateY(-1px);
        }

        .message-box {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-top: 1rem;
            font-size: 0.875rem;
            text-align: left;
        }

        .message-box.error {
            background-color: #fef2f2;
            color: #ef4444;
        }

        .message-box.success {
            background-color: #ecfdf5;
            color: #10b981;
        }

        @media (max-width: 512px) {
            .card {
                max-width: 25rem!important;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Esqueceu a Senha?</h1>
        <p class="text-gray-600 mb-6">Confirme seu e-mail para receber as instruções de recuperação de senha.</p>

        <form id="emailForm" class="space-y-4">
            <div>
                <label for="email" class="block text-left text-gray-700 text-sm font-medium mb-1">Seu e-mail</label>
                <input type="email" id="email" name="email" placeholder="exemplo@dominio.com" class="input-field" autocomplete="email" required>
            </div>
            <div class="message-box" id="messageBox"></div>
            <div class="flex justify-between mt-6">
                <a href="editar-perfil" class="btn btn-gray">Voltar ao Login</a>
                <button type="submit" id="forgotPasswordLink" class="btn btn-green">Enviar</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="./src/js/forgot.js"></script>
    <?php
    include './includes/footer.php'
    ?>
</body>

</html>