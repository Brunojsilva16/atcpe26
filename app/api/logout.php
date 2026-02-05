<?php
// Inicia a sessão para poder acessá-la.
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Apaga todas as variáveis da sessão.
$_SESSION = [];

// Se desejar destruir a sessão completamente, apague também o cookie de sessão.
// Nota: Isso destruirá a sessão e não apenas os dados da sessão!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destrói a sessão.
session_destroy();

// Redireciona o usuário para a página de login/home.
// Usei 'home' pois é para onde seu script redireciona quando o usuário não está logado.
header("Location: ../../home");
exit;
?>