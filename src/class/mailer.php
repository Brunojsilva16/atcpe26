<?php
// Use namespaces para melhor organização
namespace Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    private PHPMailer $mailer;

    // Recebe o objeto PHPMailer via injeção de dependência
    public function __construct()
    {
        $this->mailer = new PHPMailer(true); // Habilita exceções
        $this->configure();
    }
    /**
     * Configura as definições SMTP padrão para o PHPMailer.
     */
    private function configure(): void
    {
        // As constantes (MAIL_HOST, etc.) devem ser carregadas antes de instanciar     esta classe
        $this->mailer->CharSet    = MAIL_CHARSET;
        $this->mailer->IsSMTP();
        // $this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;
        $this->mailer->Debugoutput = 'html';
        $this->mailer->SMTPAuth   = true;
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $this->mailer->Host       = MAIL_HOST;
        $this->mailer->Port       = MAIL_PORT;       // Ex: 465 ou 587
        $this->mailer->IsHTML(true);
        $this->mailer->Username   = MAIL_USERNAME_AFECT;
        $this->mailer->Password   = MAIL_PASSWORD;

        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
    }

    /**
     * Envia um email.
     *
     * @param string $recipientEmail O email do destinatário.
     * @param string $subject O assunto do email.
     * @param string $body O corpo do email em HTML.
     * @param string $remetente do email.
     * @param string|null $embeddedImagePath O caminho para uma imagem a ser embutida.
     * @return bool Retorna true em caso de sucesso, false em caso de falha.
     */
    public function send(string $recipientEmail, string $subject, string $body, string $remetente): bool
    {
        try {
            // Remetente e Destinatários
            $this->mailer->setFrom(MAIL_USERNAME_AFECT, $remetente);
            $this->mailer->addReplyTo(MAIL_USERNAME_NOREPLAY, 'Não reponder');
            $this->mailer->addAddress($recipientEmail);
            // $this->mailer->addBCC(MAIL_USERNAME_PRINC); // Usar BCC é melhor para cópias ocultas
            // Conteúdo
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;


            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            // Em um cenário real, você deveria logar este erro em um arquivo
            // em vez de apenas usar echo.
            error_log("Mailer Error: {$this->mailer->ErrorInfo}");
            return false;
        } finally {
            // Limpa os destinatários para o próximo envio, se o objeto for reutilizado.
            $this->mailer->clearAddresses();
            $this->mailer->clearAttachments();
            $this->mailer->clearBCCs();
        }
    }
}
