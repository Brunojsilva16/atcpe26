<?php

// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Inclui a classe de conexão com o banco de dados
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;

/**
 * Verifica se um e-mail já existe na tabela 'associados_25'.
 *
 * @param string $email O e-mail a ser verificado.
 * @return bool Retorna true se o e-mail existir, false caso contrário.
 */
function checkIfEmailExists($email) {
    try {
        $database = new DataSource();
        $sql = "SELECT COUNT(*) as count FROM associados_25 WHERE email = ?";
        
        // selectFetchOne retorna um único array associativo com o resultado da consulta
        $result = $database->select($sql, [$email]);
        
        // Verifica se a contagem é maior que zero.
        if ($result && $result['count'] > 0) {
            return true;
        } else {
            return false;
        }
    } catch (\Exception $e) {
        // Loga o erro, mas retorna false para evitar expor detalhes internos.
        error_log("Erro ao verificar email: " . $e->getMessage());
        return false;
    }
}

// Verifica se o e-mail foi enviado via método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = trim($_POST['email']);
    
    // Valida o formato do e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Formato de e-mail inválido.']);
        exit;
    }
    
    $exists = checkIfEmailExists($email);
    
    echo json_encode(['success' => true, 'exists' => $exists]);
} else {
    // Retorna um erro se o método ou os dados estiverem incorretos
    http_response_code(400); // Bad Request
    echo json_encode(['success' => false, 'message' => 'Requisição inválida.']);
}
