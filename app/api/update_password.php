<?php
/**
 * Este arquivo recebe a nova senha via AJAX (fetch) e a atualiza no banco de dados,
 * após validar o token, o e-mail e a data de expiração do token.
 */

// Define o cabeçalho para retornar JSON
header('Content-Type: application/json');

// Define o fuso horário padrão para São Paulo, Brasil
date_default_timezone_set('America/Sao_Paulo');

// Inclui o arquivo de configuração do banco de dados
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;

// Inicializa a resposta padrão
$response = ['success' => false, 'message' => 'Ocorreu um erro desconhecido.'];

// --- BOA PRÁTICA: Verificar o método da requisição ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    $response['message'] = 'Método não permitido.';
    echo json_encode($response);
    exit;
}

// --- VALIDAÇÃO: Verificar se todos os campos necessários foram enviados ---
$required_fields = ['token', 'email', 'password', 'confirm_password'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $response['message'] = 'Dados incompletos ou inválidos para redefinição de senha.';
        echo json_encode($response);
        exit;
    }
}

try {
    $database = new DataSource();
    $now = new DateTime();

    // 1. Verificar se o token existe, pertence ao e-mail e AINDA É VÁLIDO (não expirou)
    $sql = "SELECT id_associados, reset_token_expires FROM associados_25 WHERE email = ? AND reset_token = ?";
    $params = [$_POST['email'], $_POST['token']];
    $user = $database->select($sql, $params);

    // --- CORREÇÃO DE SEGURANÇA E LÓGICA: Validar o usuário e a expiração do token ---
    if (!$user) {
        $response['message'] = 'Token inválido ou não encontrado. Por favor, solicite a redefinição de senha novamente.';
        echo json_encode($response);
        exit;
    }

    $token_expires_at = new DateTime($user['reset_token_expires']);

    if ($now > $token_expires_at) {
        $response['message'] = 'Este token de redefinição de senha expirou. Por favor, solicite a redefinição novamente.';
        echo json_encode($response);
        exit;
    }

    // Se a validação passou, podemos prosseguir com a atualização    
    // --- CORREÇÃO: Usar $_POST (maiúsculas) ---
    $hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $currentLocalTime = $now->format('Y-m-d H:i:s');

    // 2. Atualizar a senha do usuário e limpar o token de redefinição
    // --- CORREÇÃO: Usar null em vez da string 'NULL' ---
    $sql_update = "UPDATE associados_25 SET senha = ?, reset_token = ?, reset_token_expires = ?, updated_at = ? WHERE id_associados = ?";
    $params_update = [$hashedPassword, null, null, $currentLocalTime, $user['id_associados']];
    $affectedRows = $database->update($sql_update, $params_update);

    if ($affectedRows > 0) {
        $response['success'] = true;
        $response['message'] = 'Sua senha foi redefinida com sucesso! Você já pode fazer login com a nova senha.';
    } else {
        // Isso pode acontecer se a nova senha for igual à antiga ou um erro no DB.
        $response['message'] = 'Não foi possível atualizar a senha. Tente novamente.';
    }

} catch (PDOException $e) {
    // Logar o erro real para depuração interna
    error_log("Erro no banco de dados ao redefinir senha: " . $e->getMessage());
    // Mensagem genérica para o usuário
    $response['message'] = 'Ocorreu um erro interno ao processar sua solicitação. Tente novamente mais tarde.';
    http_response_code(500); // Internal Server Error
} catch (Exception $e) {
    // Captura outros erros, como falhas no DateTime
    error_log("Erro geral ao redefinir senha: " . $e->getMessage());
    $response['message'] = 'Ocorreu um erro inesperado. Tente novamente mais tarde.';
    http_response_code(500);
}

// Retorna a resposta final em formato JSON
echo json_encode($response);