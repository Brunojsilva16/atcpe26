document.addEventListener('DOMContentLoaded', () => {
    const resetPasswordForm = document.getElementById('resetPasswordForm');
    const statusMessageElement = document.getElementById('statusMessage');
    const urlApiPassword = './app/api/update_password.php';
    
    // NOVO: Capturar o botão de submit para poder desabilitá-lo
    const submitButton = resetPasswordForm ? resetPasswordForm.querySelector('button[type="submit"]') : null;

    // Função para exibir mensagens na caixa de mensagem
    function showMessage(message, type = 'error') {
        statusMessageElement.textContent = message;
        statusMessageElement.className = 'text-gray-600 mb-6 message-box ' + type;
    }

    if (resetPasswordForm) {
        // NOVO: Verificar se token e email existem na URL ao carregar a página
        const urlParamsOnLoad = new URLSearchParams(window.location.search);
        const tokenOnLoad = urlParamsOnLoad.get('token');
        const emailOnLoad = urlParamsOnLoad.get('email');

        if (!tokenOnLoad || !emailOnLoad) {
            showMessage('Link de redefinição de senha inválido ou incompleto.', 'error');
            resetPasswordForm.style.display = 'none'; // Esconde o formulário se não houver token/email
            return; // Interrompe a execução
        }


        resetPasswordForm.addEventListener('submit', async (event) => {
            event.preventDefault(); // Previne o envio padrão do formulário

            // O token e email são pegos novamente aqui para garantir, mas a verificação inicial já foi feita
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
            const email = urlParams.get('email');

            const newPassword = document.getElementById('password').value;
            const confirmPassword = document.getElementById('confirm_password').value;
            
            // Validação client-side básica
            if (newPassword === '' || confirmPassword === '') {
                showMessage('Por favor, preencha todos os campos da senha.', 'error');
                return;
            }
            if (newPassword !== confirmPassword) {
                showMessage('As senhas não coincidem.', 'error');
                return;
            }
            // AJUSTE: Corrigida a lógica da validação de tamanho da senha
            if (newPassword.length < 6) {
                showMessage('A senha deve ter pelo menos 6 caracteres.', 'error');
                return;
            }

            // NOVO: Desabilitar botão e mostrar estado de carregamento
            submitButton.disabled = true;
            submitButton.textContent = 'Redefinindo...';

            try {
                const resetFormData = new FormData();
                resetFormData.append('token', token);
                resetFormData.append('email', email);
                resetFormData.append('password', newPassword);
                resetFormData.append('confirm_password', confirmPassword);

                const response = await fetch(urlApiPassword, {
                    method: 'POST',
                    body: resetFormData
                });

                const result = await response.json();
                console.log(result);

                if (result.success) {
                    showMessage(result.message, 'success');
                    // Esconde o formulário após o sucesso
                    resetPasswordForm.style.display = 'none';
                    // Exibe o botão de voltar ao login
                    const backToLoginDiv = document.createElement('div');
                    backToLoginDiv.className = 'flex justify-center mt-6';
                    backToLoginDiv.innerHTML = '<a href="edit-profile" class="btn btn-gray">Voltar ao Login</a>';
                    resetPasswordForm.parentNode.insertBefore(backToLoginDiv, resetPasswordForm.nextSibling);

                } else {
                    showMessage(result.message, 'error');
                }
            } catch (error) {
                console.error('Erro ao redefinir senha via fetch:', error);
                showMessage('Ocorreu um erro ao tentar redefinir sua senha. Tente novamente.', 'error');
            } finally {
                // NOVO: Reabilitar o botão em caso de sucesso ou falha, se o formulário ainda estiver visível
                if (resetPasswordForm.style.display !== 'none') {
                    submitButton.disabled = false;
                    submitButton.textContent = 'Redefinir Senha';
                }
            }
        });
    }
});