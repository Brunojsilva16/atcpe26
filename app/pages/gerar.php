<?php
// Em seu script que envia o e-mail de redefinição...

$baseUrl = "http://localhost/atcpe_newsite"; // Defina a URL base do seu site
$token = "80a01715193b37bc1f193f9b5e944a0ff8c732e027f47af1764eb59e85165941";
$email = "brunojsilva16@gmail.com";

// Construa a URL correta para a rota, não para o arquivo
$resetLink = $baseUrl . "/reset_password?token=" . $token . "&email=" . urlencode($email);

// Agora use $resetLink no corpo do e-mail
echo "Clique aqui para redefinir sua senha: " . $resetLink;

// Saída: https://localhost/meusite/reset_password?token=80a01...&email=brunojsilva16%40gmail.com
