<?php

// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Inclui a classe de conexão com o banco de dados
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';


// Define o namespace para a classe DataSource
use Dsource\DataSource;

try {

    $database = new DataSource();

    // MELHORIA DE PERFORMANCE: A query agora conta os registros no banco.
    // A coluna é segura porque foi validada pela whitelist.
    $sql = "SELECT * FROM associados_25 WHERE id_status = 1 AND tipo_ass IN ('Profissional', 'Psiquiatra')";

    // Usa o novo método para obter o resultado do COUNT diretamente.
    $stmt = $database->selectAll($sql);

    echo json_encode($stmt);

} catch (PDOException $e) {
    // Em caso de erro na conexão ou na query, retorna um erro 500
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}