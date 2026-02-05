<?php

// Define o fuso horário padrão para São Paulo, Brasil
date_default_timezone_set('America/Sao_Paulo');

// Garanta que o cabeçalho JSON seja sempre enviado
header('Content-Type: application/json');

// O resto do seu código...
// require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Este é um placeholder para a página de recup0eração de senha.
// require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config_email.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

// //Carregue suas constantes de email
// // Usa a classe com seu namespace
use Dsource\DataSource;

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    try {
        $database = new DataSource();
        // 1. Verificar se o e-mail existe no banco de dados
        $sql = "SELECT id_associados FROM associados_25 WHERE email = ?";
        $params = [$email];
        $user = $database->select($sql, $params);

        if ($user) {
            // E-mail encontrado, agora geramos o token e o armazenamos
            // 2. Gerar um token único e seguro
            // bin2hex(random_bytes(32)) gera uma string hexadecimal de 64 caracteres
            $token = bin2hex(random_bytes(32));
            // Definir a expiração do token (ex: 1 hora a partir de agora)
            $expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

            try {
                // Armazenar o token no banco de dados associado ao e-mail do usuário
                $sql = "UPDATE associados_25 SET reset_token = ?, reset_token_expires = ? WHERE id_associados = ?";
                $params = [
                    $token,
                    $expires,
                    $user['id_associados']
                ];

                $affectedRows = $database->update($sql, $params);

                if ($affectedRows > 0) {
                    $output['status'] = true;
                    $output['email'] = $email;
                    $output['token'] = $token;
                    // 4. Enviar um e-mail para o usuário com um link contendo o token
               } else {
                    // E-mail não encontrado, mas por segurança, damos a mesma mensagem para não revelar se o e-mail existe ou não.
                    $output['message'] = "Se o e-mail estiver cadastrado, você receberá um link para redefinir sua senha.";
                }
            } catch (PDOException $e) {
                // Em caso de erro no banco de dados, registra o erro e exibe uma mensagem genérica
                error_log("Erro ao processar recuperação de senha: " . $e->getMessage());
                $output['message'] = "Ocorreu um erro interno ao tentar processar sua solicitação. Tente novamente.";
            }
        } else {
            $output['message'] = 'Nenhuma alteração foi realizada ou cadastro não foi encontrado!';
        }
    } catch (Exception $e) {
        error_log($e->getMessage());
        $output['message'] = 'Ocorreu um erro ao processar sua solicitação. Tente novamente mais tarde.';
        http_response_code(500); // Internal Server Error
    }

    echo json_encode($output);
}
