<?php

// Define o tipo de conteúdo da resposta como JSON
header('Content-Type: application/json');

// Inclui a classe de conexão com o banco de dados
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;

try {
    $database = new DataSource();

    // A base da query SQL
    $sql = "SELECT * FROM associados_25 WHERE id_status = 1 AND tipo_ass IN ('Profissional', 'Psiquiatra')";
    
    // Array para armazenar as condições do WHERE e os parâmetros para o bind
    $conditions = [];
    $params = [];

    // 1. Filtro por Nome (profissional)
    if (!empty($_POST['nome'])) {
        $conditions[] = "(nome LIKE ? OR nomever LIKE ?)";
        $params[] = '%' . $_POST['nome'] . '%';
        $params[] = '%' . $_POST['nome'] . '%'; // Adiciona o mesmo parâmetro para o nomever
    }

    // 2. Filtro por Público de Atendimento
    if (!empty($_POST['publico_atend']) && $_POST['publico_atend'] !== 'Todos') {
        $conditions[] = "publico_atend LIKE ?";
        $params[] = '%' .  $_POST['publico_atend'] . '%';
    }

    // 3. Filtro por Tipo de Atendimento
    if (!empty($_POST['mod_atendimento']) && $_POST['mod_atendimento'] !== 'Todos') {
        $conditions[] = "modalidade = ?";
        $params[] = $_POST['mod_atendimento'];
    }
    
    // 4. Filtro por Plano de Saúde (assumindo que a coluna seja 'plano_saude' e os valores 'Sim'/'Não')
    if (!empty($_POST['plano_saude']) && $_POST['plano_saude'] !== 'Todos') {
        $conditions[] = "plano_s = ?";
        $params[] = $_POST['plano_saude'];
    }
    
    // 5. Filtro por Cidade
    if (!empty($_POST['cidade'])) {
        $conditions[] = "cidade_at LIKE ?";
        $params[] = '%' . $_POST['cidade'] . '%';
    }

    // 6. Filtro por Bairro
    if (!empty($_POST['bairro'])) {
        $conditions[] = "bairro_at LIKE ?";
        $params[] = '%' . $_POST['bairro'] . '%';
    }

    // 6. Filtro por Bairro
    if (!empty($_POST['tipo_profissional_radio']) && $_POST['tipo_profissional_radio'] !== 'Todos') {
        $conditions[] = "tipo_ass = ?";
        $params[] = $_POST['tipo_profissional_radio'];
    }

    // Se houver condições, anexa à query SQL
    if (count($conditions) > 0) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }
    
    // Adiciona uma ordenação para consistência
    $sql .= " ORDER BY nome ASC";

    // Prepara e executa a query de forma segura
    $stmt = $database->selectAll($sql, $params);
    // Retorna os resultados como JSON
    echo json_encode($stmt);

} catch (PDOException $e) {
    // Em caso de erro, retorna um status 500 e a mensagem de erro
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ou consultar o banco de dados: ' . $e->getMessage()]);
}