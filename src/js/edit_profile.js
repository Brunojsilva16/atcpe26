document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os elementos do DOM necessários.
    const photoInput = document.getElementById('foto');
    const photoPreview = document.getElementById('photo-preview');
    const fileNameDisplay = document.getElementById('file-name-display');
    const botaoUpdate = document.getElementById('btn-to-update')
    const urlApiUpdate = './app/api/update_profile.php';

    // Verifica se todos os elementos existem na página.
    if (photoInput && photoPreview && fileNameDisplay) {
        // Adiciona um listener para o evento 'change' no input de arquivo.
        photoInput.addEventListener('change', function () {
            // Pega o primeiro arquivo selecionado.
            const file = this.files[0];

            if (file) {
                // Cria uma instância do FileReader para ler o arquivo.
                const reader = new FileReader();

                // Define o que acontece quando a leitura do arquivo é concluída.
                reader.onload = function (e) {
                    // Atualiza o atributo 'src' da imagem de pré-visualização com o resultado da leitura.
                    photoPreview.setAttribute('src', e.target.result);
                }

                // Inicia a leitura do arquivo como uma Data URL.
                reader.readAsDataURL(file);

                // Exibe o nome do arquivo selecionado para o usuário.
                fileNameDisplay.textContent = `Arquivo selecionado: ${file.name}`;
            } else {
                // Se nenhum arquivo for selecionado, restaura a mensagem padrão.
                fileNameDisplay.textContent = 'Nenhum arquivo novo selecionado.';
            }
        });
    }

    async function updateProfile() {
        // setLoading('loader-cupom', true);
        // showMessage('message-cupom', '');

        const formData = new FormData();
        formData.append('id_associados', document.getElementById('id_associados').value);
        formData.append('nome', document.getElementById('nome').value);
        formData.append('nomever', document.getElementById('nomever').value);
        formData.append('celular', document.getElementById('celular').value);
        formData.append('curriculo', document.getElementById('curriculo').value);
        formData.append('publico_atend', document.getElementById('publico_atend').value);
        formData.append('mod_atendimento', document.getElementById('mod_atendimento').value);
        formData.append('cidade', document.getElementById('cidade').value);
        formData.append('bairro', document.getElementById('bairro').value);
        formData.append('uf', document.getElementById('uf').value);
        formData.append('rede_social', document.getElementById('rede_social').value);

        // 1. Encontrar o input do arquivo
        const fileInput = document.getElementById('foto');

        // 2. Verificar se um arquivo foi selecionado
        if (fileInput.files.length > 0) {
            // 3. Obter o arquivo
            const file = fileInput.files[0];
            // 4. Anexar o arquivo ao FormData. 
            // O nome 'docfile' deve corresponder ao `name` do seu input e ao que o backend espera.
            formData.append('foto', file);
        }

        try {
            const response = await fetch(urlApiUpdate, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error(`Erro na requisição: ${response.status}`);
            }

            const resultado = await response.json();
            // A API deve retornar { "exists": true } ou { "exists": false }
            return resultado;

        } catch (error) {
            console.error("Falha ao verificar campos:", error);
            showMessage('message-cupom', 'Não foi possível conectar ao servidor. Tente novamente.');
            return false;
        } finally {
            // setLoading('loader-cupom', false);
        }
    }

    botaoUpdate.addEventListener('click', async () => {


        // const nomeDigitado = document.getElementById('nome');

        // //   // --- INÍCIO DA MODIFICAÇÃO DE VALIDAÇÃO ---
        // const fileInput = document.getElementById('imagefile');
        // const docUpContainer = document.getElementById('foto');

        // // Verifica se o campo de upload está visível (exigido) e se um arquivo foi selecionado
        // if (docUpContainer.style.display !== 'none' && fileInput.files.length === 0) {
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Comprovante Necessário',
        //         text: 'Para esta modalidade, você precisa anexar um arquivo comprovante.'
        //     });
        //     return; // Impede o prosseguimento
        // }
        // // --- FIM DA MODIFICAÇÃO DE VALIDAÇÃO ---

        // let nomeLimpo = nomeDigitado.value.trim();
        // var names = nomeLimpo.split(' ');
        // if (nomeLimpo === '') {
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'O campo Nome é obrigatório',
        //         text: 'Por favor, preencha todos os campos obrigatórios.'
        //     });
        //     // Você pode adicionar mais lógica aqui, como focar no campo ou exibir uma mensagem de erro em um elemento HTML.
        //     nomeDigitado.focus();
        //     return; // Impede o envio do formulário ou prosseguimento.
        // }

        // setLoading('pague', false);
        // setLoading('precce', true);

        const savedUpdate = await updateProfile();

        if (savedUpdate.status) {
            Swal.fire({
                position: "top",
                icon: "success",
                // title: "Sucesso!",
                text: savedUpdate.message,
                showConfirmButton: false,
                timer: 2500,
                willClose: () => {
                        window.location.href = "home";
                },

            });

        } else {

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: savedUpdate.message,
                showConfirmButton: false,
                timer: 2500
                // text: 'Cupom não fornecido ou inválido',
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
        }

    });

    callMaskRes();
});

function callMaskRes() {
    // Máscara para Telefone: (99) 99999-9999
    $('#celular').mask('(00) 00000-0000');
    // Máscara para CPF: 999.999.999-99
    $('#cpf').mask('000.000.000-00')
}
