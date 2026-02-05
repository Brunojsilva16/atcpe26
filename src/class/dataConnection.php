<?php

// 1. O require deve vir antes de tudo.
// Assumindo que este arquivo está na raiz e config.php em /app/

namespace DataConnection;

use PDO;
use PDOException;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config.php';

/**
 * Classe de conexão com o banco de dados usando o padrão Singleton.
 * Garante que apenas uma conexão seja criada por requisição.
 */
class DatabaseConnection
{
    // 2. Propriedade estática para armazenar a única instância da classe
    private static $instance = null;

    // 3. Propriedade para armazenar o objeto PDO
    private $conn;

    // 4. Opções de conexão
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    // 5. O construtor é privado para impedir a criação de novas instâncias com 'new'
    private function __construct()
    {
        // 6. DSN (Data Source Name) mais moderno, incluindo o charset
        $dsn = 'mysql:host=' . DB_HOST_S . ';dbname=' . DB_NAME_S . ';charset=utf8mb4';

        try {
            $this->conn = new PDO($dsn, DB_USER_S, DB_PASSWORD_S, $this->options);
        } catch (PDOException $e) {
            // 7. NUNCA exiba o erro para o usuário.
            // Registre o erro em um log para o desenvolvedor.
            error_log('Connection Error: ' . $e->getMessage());

            // Exiba uma mensagem genérica e segura e pare a execução.
            die('Ocorreu um erro ao conectar com o servidor. Por favor, tente novamente mais tarde.');
        }
    }

    /**
     * 8. O método estático que controla o acesso à instância.
     * Este é o ponto de entrada para obter a conexão.
     */
    public static function getInstance(): PDO
    {
        if (self::$instance === null) {
            // Cria a instância apenas na primeira vez que for chamada
            self::$instance = new self();
        }

        // Retorna a conexão PDO da instância existente
        return self::$instance->conn;
    }

    /**
     * Impede que a instância seja clonada.
     */
    private function __clone() {}

    /**
     * Impede que a instância seja recriada a partir de uma string.
     */
    public function __wakeup() {}
}
