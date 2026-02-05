<?php
// Define um cabeçalho de resposta JSON, ideal para requisições AJAX.
header('Content-Type: application/json');

// Inclui a classe DataSource para manipulação do banco de dados.
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

use Dsource\DataSource;

try {
    // Garante que a requisição seja do tipo POST.
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405); // Método não permitido.
        echo json_encode(['status' => false, 'message' => 'Método inválido.']);
        exit;
    }

    // Validação inicial dos dados. É essencial ter o ID do associado.
    if (!isset($_POST['id_associados']) || empty($_POST['id_associados'])) {
        http_response_code(400); // Requisição inválida.
        echo json_encode(['status' => false, 'message' => 'Dados insuficientes para a atualização.']);
        exit;
    }

    $database = new DataSource();
    $data = $_POST; // Recebe os dados do formulário.

    
    // $output['status'] = true;
    // $output['message3'] = $data;
    // $output['message2'] = $params;

    // echo json_encode($output);
    // exit;

    $id_associados = $data['id_associados'];
    $output = ['status' => false, 'message' => 'Nenhuma alteração foi necessária.']; // Resposta padrão

    // 1. LÓGICA DE UPLOAD DE FOTO
    // Processa o upload antes de construir a query.
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        // Define a pasta de destino de forma segura.
        $folderfoto = dirname(__DIR__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'foto' . DIRECTORY_SEPARATOR;

        // Garante que o diretório exista.
        if (!is_dir($folderfoto)) {
            mkdir($folderfoto, 0755, true);
        }

        $filenameDoc = basename($_FILES['foto']['name']);
        $ext = pathinfo($filenameDoc, PATHINFO_EXTENSION);

        // Gera um nome de arquivo único para evitar conflitos.
        $setstr = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $code = substr(str_shuffle($setstr), 0, 5);
        $new_filenameDoc = $code . time() . '.' . $ext;

        // Move o arquivo e, se for bem-sucedido, adiciona ao array de dados para atualização.
        if (move_uploaded_file($_FILES['foto']['tmp_name'], $folderfoto . $new_filenameDoc)) {
            // **CORREÇÃO IMPORTANTE**: Adiciona o novo nome do arquivo aos dados que serão processados.
            $data['foto'] = $new_filenameDoc;
        }
    }

    // Remove o ID dos dados para não tentar atualizá-lo na query SET.
    unset($data['id_associados']);

    // 2. MAPEAMENTO E CONSTRUÇÃO DA QUERY DINÂMICA
    // O mapa que "traduz" os nomes do formulário para os nomes das colunas do banco.
    $fieldMap = [
        'curriculo' => 'mini_curr',
        'mod_atendimento' => 'modalidade',
        'cidade' => 'cidade_at',
        'bairro' => 'bairro_at',
        'foto' => 'perfil_f'
    ];

    // A lista de campos permitidos vindos do formulário (Whitelist de segurança).
    $allowedFields = ['nome', 'nomever', 'celular', 'curriculo', 'publico_atend', 'mod_atendimento', 'cidade', 'bairro', 'uf', 'rede_social', 'foto'];

    $setParts = [];
    $params = [];

    // Itera sobre os campos permitidos para construir a query de forma segura.
    foreach ($allowedFields as $field) {
        if (isset($data[$field])) {
            // Usa o mapa para obter o nome correto da coluna do banco.
            // Se não houver mapeamento, usa o próprio nome do campo.
            $columnName = $fieldMap[$field] ?? $field;

            $setParts[] = "{$columnName} = ?";
            $params[] = $data[$field];
        }
    }

    // 3. EXECUÇÃO DA QUERY
    // Prossiga apenas se houver pelo menos um campo para atualizar.
    if (!empty($setParts)) {
        // Adiciona o ID do associado ao final do array de parâmetros para a cláusula WHERE.
        $params[] = $id_associados;

        // Monta a string SQL final.
        $sql = "UPDATE associados_25 SET " . implode(', ', $setParts) . " WHERE id_associados = ?";


        // **CORREÇÃO IMPORTANTE**: Usa a variável correta `$db`.
        $rowCount = $database->update($sql, $params);

        if ($rowCount > 0) {
            $output['status'] = true;
            $output['message'] = 'Perfil atualizado com sucesso!';
        } else {
            // Se a query rodou mas não afetou linhas (dados iguais aos já existentes).
            $output['message'] = 'Nenhuma alteração foi detectada nos dados.';
        }
    }
    echo json_encode($output);
} catch (PDOException $e) {
    // Em caso de erro, retorna um status 500 e a mensagem de erro
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao conectar ou consultar o banco de dados: ' . $e->getMessage()]);
}
