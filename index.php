<?php

// session_start();
require_once __DIR__ . '/vendor/autoload.php';
// require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'config_email.php';

// LÓGICA DE ROTEAMENTO (ROUTING) - Esta parte é idêntica à versão com Dotenv
$route = filter_input(INPUT_GET, 'params', FILTER_SANITIZE_URL) ?? 'home';
$route = trim($route, '/'); // Remove barras no início/fim
$route = ($route === '') ? 'home' : $route;

// 5. WHITELIST DE SEGURANÇA - Idêntica
$allowedPages = [
    'home',
    'sobre',
    'contato',
    'pesquisa',
    'edit-profile',
    'editar-perfil',
    'associe-se',
    'quem-somos',
    'gestao',
    'beneficios',
    'forgot_password',
    'reset_password',
    'gerar',
    'process_envia'
];
if (!in_array($route, $allowedPages)) {
    http_response_code(404);
    $route = 'page404'; // Assuming you have a page404.php in app/pages/
}

// PREPARAR VARIÁVEIS PARA O TEMPLATE
$page_title = ucfirst($route);

// Determine the correct path for the page content file
$page_content_file = __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . "{$route}.php";


// CARREGAR O LAYOUT PRINCIPAL
// Ensure the file exists before requiring to avoid fatal errors if the path is wrong
if (file_exists($page_content_file)) {
    require_once $page_content_file;
} else {
    // Fallback to 404 if the file determined by the routing logic doesn't exist
    http_response_code(404);
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . 'page404.php';
}
