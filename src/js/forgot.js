document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os elementos do DOM
    const emailForm = document.getElementById('emailForm');
    const emailInput = document.getElementById('email');
    const messageBox = document.getElementById('messageBox');

    // URL do novo script PHP unificado
    const urlApiProcess = './app/api/process_reset_password.php';

    // Função para exibir mensagens (pode ser usada como fallback para o SweetAlert)
    function showMessage(message, type = 'error') {
        messageBox.textContent = message;
        messageBox.style.display = 'block';
        messageBox.className = `message-box ${type}`; // Adiciona classes para estilização
    }

    // Função para esconder a caixa de mensagem
    function hideMessage() {
        messageBox.style.display = 'none';
        messageBox.textContent = '';
    }

    // Event listener para o envio do formulário de e-mail
    emailForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Previne o comportamento padrão de envio do formulário

        if (!emailInput.checkValidity()) {
            showMessage('Por favor, insira um e-mail válido.', 'error');
            return;
        }

        hideMessage(); // Esconde qualquer mensagem anterior

        const formData = new FormData();
        formData.append('email', emailInput.value);

        // Adiciona um feedback visual de carregamento
        emailForm.querySelector('button[type="submit"]').disabled = true;
        emailForm.querySelector('button[type="submit"]').textContent = 'Enviando...';

        try {
            // Faz uma única requisição para o endpoint que processa tudo
            const response = await fetch(urlApiProcess, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            // A mensagem de sucesso é sempre a mesma por segurança (não informa se o email existe)
            // A distinção entre sucesso e erro é feita pelo 'status' para a lógica do Swal.fire
            if (result.status) {
                Swal.fire({
                    position: "top",
                    icon: "success",
                    text: result.message,
                    showConfirmButton: false,
                    timer: 3200,
                    willClose: () => {
                        window.location.href = "home";
                    },

                });
            } else {
                // Erros (ex: falha no envio do email, erro no servidor)
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: result.message,
                    showConfirmButton: true
                });
            }

        } catch (error) {
            console.error('Erro na requisição:', error);
            Swal.fire({
                icon: "error",
                title: "Erro de Conexão",
                text: 'Não foi possível conectar ao servidor. Verifique sua internet e tente novamente.',
                showConfirmButton: true
            });
        } finally {
            // Restaura o botão de envio
            emailForm.querySelector('button[type="submit"]').disabled = false;
            emailForm.querySelector('button[type="submit"]').textContent = 'Enviar Link';
        }
    });
});