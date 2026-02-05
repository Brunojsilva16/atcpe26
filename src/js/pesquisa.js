document.addEventListener('DOMContentLoaded', () => {

    // --- Seletores do DOM ---
    const form = document.getElementById('filtro-form');
    const resultadoContainer = document.getElementById('resultado-pesquisa');
    const btnFiltrar = document.getElementById('btn-filtrar');
    const btnLimpar = document.getElementById('btn-limpar');
    // const btnVoltar = document.getElementById('voltar');
    // NOVO: Seletor para o contador de resultados
    const contadorResultados = document.getElementById('contador-resultados');
    const urlApi = './app/api/fetch_pesquisa.php';

    // Função para embaralhar um array (algoritmo Fisher-Yates)
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    // --- Funções Auxiliares (reaproveitadas do seu script) ---

    // Função para adicionar os listeners aos botões de collapse
    function initializeCollapseButtons() {
        const collapseButtons = document.querySelectorAll('.btn-collapse');
        collapseButtons.forEach(button => {
            button.textContent = '+ Mostrar mais...';
            const targetId = button.getAttribute('data-bs-target');
            const collapseElement = document.querySelector(targetId);
            if (collapseElement) {
                collapseElement.addEventListener('show.bs.collapse', () => {
                    button.textContent = '- Mostrar menos...';
                });
                collapseElement.addEventListener('hide.bs.collapse', () => {
                    button.textContent = '+ Mostrar mais...';
                });
            }
        });
    }

    // Função para capitalizar nomes
    function capitalizarNomeCompleto(nomeCompleto) {
        if (!nomeCompleto || typeof nomeCompleto !== 'string') return '';
        const capitalize = (str) => {
            if (!str) return '';
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        };
        const excecoes = ['de', 'do', 'da', 'dos', 'das', 'e'];
        const palavras = nomeCompleto.toLowerCase().split(' ');
        const palavrasFormatadas = palavras.map((palavra, index) => {
            if (excecoes.includes(palavra) && index > 0) {
                return palavra;
            }
            return capitalize(palavra);
        });
        return palavrasFormatadas.join(' ');
    };

    // --- Funções Principais da Pesquisa ---

    /**
     * Função principal que realiza a busca.
     * Pega os dados do formulário e envia para o backend.
     */
    async function realizarPesquisa() {
        // Esconde o contador antigo antes de iniciar uma nova busca
        contadorResultados.classList.add('d-none');
        // btnVoltar.classList.remove('d-none');
        // Mostra um feedback de carregamento
        resultadoContainer.innerHTML = `<p class="text-center w-100">Buscando profissionais...</p>`;

        // Coleta os dados do formulário
        const formData = new FormData(form);

        // for (var pair of formData.entries()) {
        //     console.log(pair[0] + ': ' + (pair[1] instanceof File ? pair[1].name : pair[1]));
        // }
        try {
            const response = await fetch(urlApi, {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const professionals = await response.json();
            //Embaralha a lista de profissionais antes de exibi-los
            const shuffledProfessionals = shuffleArray(professionals);
            //Passa a lista embaralhada para a função de exibição
            popularResultados(shuffledProfessionals);

        } catch (error) {
            console.error("Erro ao buscar os dados dos profissionais:", error);
            resultadoContainer.innerHTML = `<p class="text-center text-danger w-100">Não foi possível carregar os perfis. Tente novamente mais tarde.</p>`;
        }
    }

    /**
     * Função para popular a área de resultados com os dados dos profissionais.
     * (Adaptada da sua função populateCarousel)
     */
    function popularResultados(professionals) {
        resultadoContainer.innerHTML = ''; // Limpa o container

        // NOVO: Lógica para atualizar e exibir o contador
        const totalEncontrado = professionals.length;
        contadorResultados.textContent = `${totalEncontrado} resultado(s) encontrado(s).`;
        contadorResultados.classList.remove('d-none'); // Torna o contador visível
        // btnVoltar.classList.add('d-none');

        if (professionals.length === 0) {
            resultadoContainer.innerHTML = `<p class="text-center text-muted w-100">Nenhum profissional encontrado com os critérios selecionados.</p>`;
            return;
        }

        professionals.forEach(prof => {
            const col = document.createElement('div');
            // Usamos col-lg-4 e col-md-6 para melhor responsividade
            col.className = 'col-lg-4 col-md-6 mb-4';

            let finalNome;
            if (prof.nomever && prof.nomever.trim() !== '') {
                finalNome = prof.nomever;
            } else {
                const palavras = prof.nome.trim().split(" ");
                const primeiroNome = palavras[0];
                const ultimoNome = palavras[palavras.length - 1];
                finalNome = primeiroNome + ' ' + ultimoNome;
            }

            const foto = prof.perfil_f != null ? prof.perfil_f : 'sem-foto.png';

            // Estrutura do Card (idêntica à sua)
            col.innerHTML = `
                    <div class="card-professional">

                        <div class="profile-img-wrapper">
                            <img src="./assets/foto/${foto}" alt="Foto de ${finalNome}" class="profile-img">
                        </div>

                        <h5>${capitalizarNomeCompleto(finalNome)}</h5>
                        <p class="cargo">${prof.tipo_ass}</p>
                        <span class="registro">${prof.crp || ''}</span>
                        
                        <button type="button" class="btn btn-collapse btn-light" data-bs-toggle="collapse" data-bs-target="#collapse-${prof.id_associados}" aria-expanded="false" aria-controls="collapse-${prof.id_associados}"></button>
                        
                            <div class="collapse" id="collapse-${prof.id_associados}">
                                <div class="collapse-content">

                                    ${prof.celular && prof.celular !== 'null' ? `
                                        <span class="perfil">                                    
                                            <strong>Celular:</strong> 
                                            <a href="https://web.whatsapp.com/send?phone=55${prof.celular.replace(/\D/g, '')}" target="_blank">
                                                ${prof.celular} <i class="fab fa-whatsapp"></i>
                                            </a>
                                        </span>
                                    ` : ''}

                                    ${prof.mini_curr && prof.mini_curr !== 'null' ? `
                                        <span class="perfil curri">
                                            <strong>Mini&nbsp;Currículo:</strong> ${prof.mini_curr}
                                        </span>
                                    ` : ''}

                                    ${prof.publico_atend && prof.publico_atend !== 'null' ? `
                                        <span class="perfil">
                                            <strong>Público de atendimento:</strong> ${prof.publico_atend}
                                        </span>
                                    ` : ''}

                                    ${prof.rede_social && prof.rede_social !== 'null' ? `
                                        <span class="perfil">
                                            <strong>Rede Social:</strong> ${prof.rede_social} 
                                        </span>
                                    ` : ''}

                                </div>
                            </div>  

                    </div>                  
                `;
            resultadoContainer.appendChild(col);
        });

        // Inicializa os botões de collapse DEPOIS de adicionar os cards ao DOM
        initializeCollapseButtons();
    }

    /**
     * Função para limpar o formulário e os resultados da busca.
     */
    function limparFiltro() {
        form.reset(); // Reseta todos os campos do formulário
        resultadoContainer.innerHTML = `<p class="text-center text-muted w-100">Utilize os filtros acima para iniciar sua busca.</p>`;

        // NOVO: Esconde o contador ao limpar o filtro
        contadorResultados.classList.add('d-none');
        // btnVoltar.classList.remove('d-none');
    }


    // --- Adiciona os Event Listeners ---
    btnFiltrar.addEventListener('click', realizarPesquisa);
    btnLimpar.addEventListener('click', limparFiltro);

    // Opcional: para fazer a pesquisa ser acionada ao pressionar Enter em um campo de texto
    form.addEventListener('submit', (event) => {
        event.preventDefault(); // Impede o envio padrão do formulário
        realizarPesquisa();
    });

});