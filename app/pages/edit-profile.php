<?php
// Silencia erros de notice para variáveis não definidas, mas mantém outros erros visíveis.
error_reporting(E_ALL & ~E_NOTICE);

// Inclui a classe DataSource para interagir com o banco de dados.
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'dataSource.php';
use Dsource\DataSource;


if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header('Location: home'); // Redireciona para a página de login se não estiver logado
    exit;
}

// $userEmail = $_SESSION['user_email'] ?? 'Usuário';
$message = '';
$userData = [];

try {
    $database = new DataSource();
    // Carrega os dados do usuário logado
    $sql = "SELECT * FROM associados_25 WHERE id_associados = ?";
    $params = [$_SESSION['user_id']];
    $userData = $database->select($sql, $params);

    if (!$userData) {
        // Se o usuário não for encontrado (situação incomum), desloga e redireciona
        session_destroy();
        header('Location: index.php');
        exit;
    }
} catch (PDOException $e) {
    error_log("Erro ao carregar dados do usuário: " . $e->getMessage());
    $message = "Erro ao carregar seus dados. Tente novamente.";
}

// Define o caminho padrão para a foto de perfil.
$photoPath = './assets/foto/';
$defaultPhoto = 'sem-foto.png'; // Uma imagem padrão caso o usuário não tenha foto.
$photoFile = !empty($userData['perfil_f']) && file_exists($photoPath . $userData['perfil_f']) ? $userData['perfil_f'] : $defaultPhoto;

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="./src/styles/edit-style1.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="form-container">
        <?php if ($userData) : // Se o profissional foi encontrado no banco de dados 
        ?>
            <h2>Olá, <?php echo htmlspecialchars(explode(' ', $userData['nome'])[0]); ?>!</h2>
            <p class="text-muted">Altere os campos que desejar e clique em "Salvar Alterações" no final da página.</p>

            <form id="formProfile" method="POST" enctype="multipart/form-data" class="mt-4 needs-validation" novalidate onsubmit="return false;">
                <!-- Campos ocultos para enviar o ID e o e-mail, essenciais para a atualização e redirecionamento. -->
                <input type="hidden" id="id_associados" name="id_associados" value="<?php echo $userData['id_associados']; ?>">

                <!-- Seção da Foto -->
                <div class="text-center mb-4">
                    <label class="form-label fw-bold">Sua Foto de Perfil</label>
                    <div class="photo-preview-wrapper mx-auto">
                        <img id="photo-preview" src="<?php echo $photoPath . $photoFile; ?>" alt="Pré-visualização da foto">
                    </div>
                    <label for="foto" class="btn btn-secondary mt-3">
                        <i class="fas fa-upload me-2"></i> Escolher Arquivo
                    </label>
                    <input class="form-control d-none" type="file" id="foto" name="foto" accept="image/png, image/jpeg, image/gif">
                    <div id="file-name-display" class="form-text mt-2">Nenhum arquivo novo selecionado.</div>
                </div>

                <!-- Campos de Dados -->
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Completo</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($userData['nome'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="nomever" class="form-label">Nome de visualização</label>
                    <input type="text" class="form-control" id="nomever" name="nomever" value="<?php echo htmlspecialchars($userData['nomever'] ?? ''); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="celular" name="celular" value="<?php echo htmlspecialchars($userData['celular'] ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="curriculo" class="form-label">Mini curriculo</label>
                    <textarea class="form-control" id="curriculo" name="curriculo" rows="8" maxlength="1200"><?php echo htmlspecialchars($userData['mini_curr'] ?? ''); ?>"</textarea>
                </div>

                <div class="mb-3">
                    <label for="publico_atend" class="form-label">Público de Atendimento</label>
                    <input type="text" class="form-control" id="publico_atend" name="publico_atend" value="<?php echo htmlspecialchars($userData['publico_atend'] ?? ''); ?>">
                </div>

                <div class="mb-3">
                    <label for="mod_atendimento" class="form-label">Modalidade de Atendimento</label>
                    <select id="mod_atendimento" class="form-select" name="mod_atendimento">
                        <?php
                        // Array com as opções para o campo de seleção.
                        $opcoes_modalidade = ['Ambos', 'Presencial', 'Online'];
                        // Itera sobre as opções e cria cada tag <option>.
                        foreach ($opcoes_modalidade as $opcao) {
                            // Verifica se a opção atual é a que está salva no banco de dados.
                            $selected = ($userData['modalidade'] == $opcao) ? 'selected' : '';
                            // Imprime a tag <option> com o atributo 'selected' se for o caso.
                            echo "<option value=\"$opcao\" $selected>" . htmlspecialchars($opcao) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo htmlspecialchars($userData['cidade_at'] ?? ''); ?>">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo htmlspecialchars($userData['bairro_at'] ?? ''); ?>">
                    </div>
                    <div class="col-md-2 mb-3">
                        <label for="uf" class="form-label">UF</label>
                        <input type="text" class="form-control" id="uf" name="uf" maxlength="2" value="<?php echo htmlspecialchars($userData['uf'] ?? ''); ?>">
                    </div>
                </div>

                <div class="mb-4">
                    <label for="rede_social" class="form-label">Rede Social (URL)</label>
                    <input type="url" class="form-control" id="rede_social" name="rede_social" placeholder="@seu_perfil" value="<?php echo htmlspecialchars($userData['rede_social'] ?? ''); ?>">
                </div>

                <div style="display: flex; justify-content:space-between">
                    <a href="./app/api/logout.php"><button type="button" class="btn btn-warning">Voltar</button></a>
                    <button type="submit" id="btn-to-update" class="btn btn-primary">Salvar Alterações</button>
                </div>

            </form>
        <?php else : // Se nenhum cadastro foi encontrado com o e-mail fornecido. 
        ?>
            <div class="alert alert-warning text-center" role="alert">
                <h4 class="alert-heading">Cadastro não encontrado!</h4>
                <p>Nenhum perfil foi localizado com o e-mail <strong><?php echo htmlspecialchars($email); ?></strong>.</p>
                <hr>
                <p class="mb-0">Por favor, verifique se o e-mail está correto e <a href="editar-perfil" class="alert-link">tente novamente</a>.</p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="./src/js/edit_profile.js"></script>
</body>

</html>