<?php
// Habilita a exibição de erros para depuração (desative em produção)
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

// Define o fuso horário e o cabeçalho de resposta
date_default_timezone_set('America/Sao_Paulo');

header('Content-Type: application/json');

// Inclui os arquivos necessários
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' .  DIRECTORY_SEPARATOR . 'config_email.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'mailer.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';

// Usa as classes com seus namespaces
use Dsource\DataSource;
use Mail\Mailer;

$output = ['status' => false, 'message' => 'Ocorreu um erro inesperado.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $output = ['message' => 'Por favor, forneça um endereço de e-mail válido.'];
        echo json_encode($output);
        exit;
    }

    try {
        $database = new DataSource();
        // 1. Verificar se o e-mail existe no banco de dados
        $sql = "SELECT id_associados FROM associados_25 WHERE email = ?";
        $user = $database->select($sql, [$email]);

        if ($user) {
            // 2. Gerar um token único e seguro e a data de expiração
            $token = bin2hex(random_bytes(32));
            $expires = date('Y-m-d H:i:s', strtotime('+2 hour'));

            // 3. Armazenar o token no banco de dados
            $updateSql = "UPDATE associados_25 SET reset_token = ?, reset_token_expires = ? WHERE id_associados = ?";
            $updateParams = [$token, $expires, $user['id_associados']];
            $affectedRows = $database->update($updateSql, $updateParams);

            if ($affectedRows > 0) {
                // 4. Se o token foi salvo, enviar o e-mail de redefinição
                try {
                    $mailer = new Mailer();
                    $resetLink = "https://www.atcpe.org.br/reset_password?token=" . $token . "&email=" . urlencode($email);

                    $subject = "Redefinição de Senha - Site associados - ATCPE";

                    $body = "<div class='alert alert-success' role='alert' style='margin-top: 50px;'>
            
                            <h3><b>Redefinição de Senha para sua conta</b></h3>
                            <p>Olá,</p>
                            <p>Você solicitou uma redefinição de senha para sua conta. Por favor, clique no link abaixo para redefinir sua senha:</p>
                            <p><a href='{$resetLink}'>Link para redefinir</a></p>
                            <p>Este link expirará em 2 horas. Se você não solicitou esta redefinição, por favor, ignore este e-mail.</p>
                            <p>Atenciosamente, </p>
                            <p>Equipe - ATCPE</p>
                        ";

                    $remetente = 'ATCPE';
                    $emailSent = $mailer->send($email, $subject, $body, $remetente);

                    if ($emailSent) {
                        $output = ['status' => true, 'message' => 'Email enviado com sucesso!'];
                    } else {
                        $output = ['status' => true, 'message' => "Se o e-mail estiver cadastrado, você receberá um link para redefinir sua senha.", 'email' => $email, 'token' => $token];
                    }
                } catch (Exception $e) {
                    $output = ['messagem' => "Mailer Exception: " . $e->getMessage()];
                }
            } else {
                // Mensagem genérica mesmo que o update falhe, para segurança
                // Retornamos true para não revelar se o usuário existe
                $output = ['status' => true, 'message' => "Se o e-mail estiver cadastrado, você receberá um link para redefinir sua senha.", 'email' => $email, 'token' => $token];
            }
        } else {
            // E-mail não encontrado, mas por segurança, damos a mesma mensagem
            // para não revelar se um e-mail existe ou não no sistema.
            // Retornamos true para não revelar se o usuário existe
            $output = ['status' => true, 'message' => "E-mail não cadastrado, verifique o email digitado!"];
        }
    } catch (Exception $e) {
        $output = ['message' => "Erro ao processar recuperação de senha: " . $e->getMessage()];
        http_response_code(500); // Internal Server Error
    }
} else {
    $output = ['message' => 'Método de requisição inválido.'];
    http_response_code(405); // Method Not Allowed
}

echo json_encode($output);
