// script.js

document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os elementos do DOM
    const emailForm = document.getElementById('emailForm');
    const emailInput = document.getElementById('email');
    const passwordSection = document.getElementById('passwordSection');
    const passwordInput = document.getElementById('password');
    const nextButton = document.getElementById('nextButton');
    const backButton = document.getElementById('backButton');
    const firstAccessLink = document.getElementById('firstAccessLink');
    const forgotPasswordLink = document.getElementById('forgotPasswordLink');
    const messageBox = document.getElementById('messageBox');
    const urlApiPassword = './app/api/login.php';
    const urlApiCheck = './app/api/check_email.php';

    // Estado para controlar se o e-mail foi verificado
    let emailVerified = false;

    // Função para exibir mensagens na caixa de mensagem
    function showMessage(message, type = 'error') {
        messageBox.textContent = message;
        messageBox.style.display = 'block';
        if (type === 'error') {
            messageBox.style.backgroundColor = '#fef2f2';
            messageBox.style.color = '#ef4444';
        } else if (type === 'success') {
            messageBox.style.backgroundColor = '#ecfdf5';
            messageBox.style.color = '#10b981';
        }
    }

    // Função para esconder a caixa de mensagem
    function hideMessage() {
        messageBox.style.display = 'none';
        messageBox.textContent = '';
    }

    // Event listener para o envio do formulário de e-mail
    emailForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Previne o comportamento padrão de envio do formulário

        const email = emailInput.value;

        hideMessage(); // Esconde qualquer mensagem anterior

        // Se o e-mail ainda não foi verificado, verifica a existência
        if (!emailVerified) {
            try {
                const formData = new FormData();
                formData.append('email', email);

                const response = await fetch(urlApiCheck, {
                    method: 'POST',
                    body: formData
                });

                if (!response.ok) {
                    throw new Error(`Erro HTTP: ${response.status}`);
                }

                let result;
                try {
                    result = await response.json();
                    console.log(result);
                } catch (jsonError) {
                    throw new Error("Resposta não é JSON válido");
                }

                if (result.exists) {
                    passwordSection.classList.remove('hidden');
                    emailInput.disabled = true;
                    nextButton.textContent = 'Entrar';
                    emailVerified = true;
                    passwordInput.focus();
                    showMessage('E-mail encontrado. Por favor, insira sua senha.', 'success');
                } else {
                    showMessage('E-mail não encontrado. Por favor, verifique ou clique em "Primeiro Acesso".');
                    passwordSection.classList.add('hidden');
                    emailInput.disabled = false;
                    nextButton.textContent = 'Avançar';
                    emailVerified = false;
                }

            } catch (error) {
                console.error('Erro ao verificar e-mail:', error);
                showMessage('Ocorreu um erro ao verificar o e-mail. Tente novamente.');
            }



        } else {
            // Se o e-mail já foi verificado, tenta fazer login com a senha
            const password = passwordInput.value;
            if (!password) {
                showMessage('Por favor, insira sua senha.');
                return;
            }

            try {
                const formDataSenha = new FormData();
                formDataSenha.append('email', email);
                formDataSenha.append('password', password);
                // Faz uma requisição para o endpoint PHP de login
                const response = await fetch(urlApiPassword, {
                    method: 'POST',
                    body: formDataSenha
                });

                const result = await response.json();
                if (result.success) {
                    showMessage('Login bem-sucedido! Redirecionando...', 'success');
                    // Redireciona para a página de edição de perfil
                    window.location.href = 'edit-profile'; // Substitua pelo URL da sua página de edição
                } else {
                    showMessage('Senha incorreta. Tente novamente.');
                }
            } catch (error) {
                console.error('Erro ao fazer login:', error);
                showMessage('Ocorreu um erro ao tentar fazer login. Tente novamente.');
            }
        }
    });

    // Event listener para o botão "Voltar"
    backButton.addEventListener('click', () => {
        emailInput.value = ''; // Limpa o campo de e-mail
        emailInput.disabled = false; // Habilita o campo de e-mail
        passwordInput.value = ''; // Limpa o campo de senha
        passwordSection.classList.add('hidden'); // Esconde a seção de senha
        nextButton.textContent = 'Avançar'; // Restaura o texto do botão
        emailVerified = false; // Reseta o estado de verificação
        hideMessage(); // Esconde a mensagem
    });

});
