<?php
// reset_password.php
// Este arquivo lida com a redefinição de senha após o usuário clicar no link do e-mail.
// Define o fuso horário padrão para São Paulo, Brasil
date_default_timezone_set('America/Sao_Paulo');

// Inclui o arquivo de configuração do banco de dados para a conexão PDO
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;


$message = ''; // Variável para armazenar mensagens de feedback ao usuário
$token = $_GET['token'] ?? ''; // Obtém o token da URL
$email = $_GET['email'] ?? ''; // Obtém o e-mail da URL

// Variável para controlar se o formulário de redefinição deve ser exibido
$showResetForm = false;

// echo $email . '<br>' . $token;
// exit;

// 1. Validar o token e o e-mail da URL
if (empty($token) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $message = "Link de redefinição de senha inválido ou incompleto.";
} else {

    $database = new DataSource();
    try {
        // 2. Verificar se o token existe no banco de dados e se não está expirado
        $sql = "SELECT id_associados, email, reset_token_expires FROM associados_25 WHERE email = ? AND reset_token = ?";
        $params = [$email, $token];
        $user = $database->select($sql, $params);

        if ($user) {
            $expiresAt = new DateTime($user['reset_token_expires']);
            $now = new DateTime();

            if ($now < $expiresAt) {
                // Token válido e não expirado, pode exibir o formulário de redefinição
                $showResetForm = true;
                $message = "Por favor, digite sua nova senha.";
            } else {
                // Token expirado
                $message = "O link de redefinição de senha expirou. Por favor, solicite um novo.";
                // Opcional: Limpar o token expirado do banco de dados
                $sql = "UPDATE associados_25 SET reset_token = ?, reset_token_expires = ? WHERE id_associados = ?";
                $params = ['NULL', 'NULL', $user['id_associados']];
                $database->update($sql, $params);
            }
        } else {
            // Token ou e-mail não correspondem ou não existem
            $message = "Link de redefinição de senha inválido ou já utilizado.";
        }
    } catch (PDOException $e) {
        error_log("Erro ao verificar token de redefinição: " . $e->getMessage());
        $message = "Ocorreu um erro interno. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">

    <link rel="icon" href="./favicon.png" sizes="32x32">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            background-color: #ffffff;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
            width: 100%;
            max-width: 28rem;
            text-align: center;
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
    </style>
</head>

<body>
    <div class="card">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">Redefinir Senha</h1>
        <p class="text-gray-600 mb-6" id="statusMessage">
            <?php echo htmlspecialchars($message); ?>
        </p>

        <?php if ($showResetForm): ?>
            <form id="resetPasswordForm" class="space-y-4">
                <div>
                    <label for="password" class="block text-left text-gray-700 text-sm font-medium mb-1">Nova Senha</label>
                    <input type="password" id="password" name="password" placeholder="Sua nova senha" class="input-field" autocomplete="password" required>
                </div>
                <div>
                    <label for="confirm_password" class="block text-left text-gray-700 text-sm font-medium mb-1">Confirmar Nova Senha</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirme sua nova senha" class="input-field" autocomplete="confirm_password" required>
                </div>
                <div class="flex justify-center mt-6">
                    <button type="submit" class="btn btn-green">Redefinir Senha</button>
                </div>
            </form>
        <?php else: ?>
            <div class="flex justify-center mt-6">
                <a href="home" class="btn btn-gray">Voltar ao Login</a>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="./src/js/reset_passwordss.js"></script>
</body>

</html>