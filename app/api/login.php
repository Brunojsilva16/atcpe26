<?php
// login.php

// Define o cabeçalho para retornar JSON
header('Content-Type: application/json');

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;

// Validação básica
if (!isset($_POST['email']) || empty($_POST['email'])) {
    http_response_code(400); // Requisição inválida.
    echo json_encode(['status' => false, 'message' => 'E-mail inválidos.']);
    exit;
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    http_response_code(400); // Requisição inválida.
    echo json_encode(['status' => false, 'message' => 'Senha inválidos.']);
    exit;
}


$database = new DataSource();
try {
    // Prepara a consulta SQL para buscar o usuário pelo e-mail
    $sql = "SELECT id_associados, email, senha FROM associados_25 WHERE email = ?";
    $params = [$_POST['email']];
    $user = $database->select($sql, $params);

    // echo json_encode(['success' => false, 'message' => $user]);

    // Verifica se o usuário existe e se a senha está correta
    if ($user && password_verify($_POST['password'], $user['senha'])) {
        // Inicia a sessão (opcional, mas comum para autenticação)
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['user_id'] = $user['id_associados'];
        $_SESSION['user_email'] = $user['email'];

        echo json_encode(['success' => true, 'message' => 'Login bem-sucedido.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'E-mail ou senha incorretos.']);
    }
} catch (PDOException $e) {
    // Em caso de erro no banco de dados, retorna uma mensagem de erro
    error_log("Erro ao fazer login: " . $e->getMessage()); // Loga o erro para depuração
    echo json_encode(['success' => false, 'message' => 'Erro interno do servidor.']);
}
