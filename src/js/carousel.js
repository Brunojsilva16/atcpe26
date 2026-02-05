document.addEventListener('DOMContentLoaded', () => {

    const carouselContainer = document.getElementById('carousel-container');
    const urlApi = './app/api/fetch_carousel.php';

    // Função para embaralhar um array (algoritmo Fisher-Yates)
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    // Função para adicionar os listeners aos botões de collapse
    function initializeCollapseButtons() {
        // 1. Seleciona todos os botões que controlam o collapse
        const collapseButtons = document.querySelectorAll('.btn-collapse');

        // 2. Itera sobre cada botão encontrado
        collapseButtons.forEach(button => {
            // Define o texto inicial do botão
            button.textContent = '+ Mostrar mais...';

            // Pega o alvo do colapso a partir do atributo 'data-bs-target'
            const targetId = button.getAttribute('data-bs-target');
            const collapseElement = document.querySelector(targetId);

            // Adiciona os eventos somente se o elemento alvo existir
            if (collapseElement) {
                // Evento que dispara QUANDO A EXPANSÃO COMEÇA
                collapseElement.addEventListener('show.bs.collapse', () => {
                    button.textContent = '- Mostrar menos...';
                });

                // Evento que dispara QUANDO A RETRAÇÃO COMEÇA
                collapseElement.addEventListener('hide.bs.collapse', () => {
                    button.textContent = '+ Mostrar mais...';
                });
            }
        });
    }

    // Função para buscar e carregar os profissionais
    async function loadProfessionals() {
        try {
            const formData = new FormData();

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
            populateCarousel(shuffledProfessionals);

        } catch (error) {
            console.error("Erro ao buscar os dados dos profissionais:", error);
            carouselContainer.innerHTML = `<p class="text-center text-danger">Não foi possível carregar os perfis.</p>`;
        }
    }

    // Função para popular o carrossel com os dados
    function populateCarousel(professionals) {
        carouselContainer.innerHTML = ''; // Limpa o container
        const itemsPerSlide = 3; // Quantidade de perfis por slide (ajuste conforme necessário)
        let isActive = true;

        for (let i = 0; i < professionals.length; i += itemsPerSlide) {
            const slide = document.createElement('div');
            slide.className = `carousel-item ${isActive ? 'active' : ''}`;

            const row = document.createElement('div');
            row.className = 'row';

            const slideProfessionals = professionals.slice(i, i + itemsPerSlide);

            slideProfessionals.forEach(prof => {
                const col = document.createElement('div');
                col.className = 'col-lg-4 col-md-6 mb-4';

                // ALTERAÇÃO 1: Use 'let' em vez de 'const' para permitir a modificação.
                let finalNome;

                // ALTERAÇÃO 2: Lógica simplificada e segura.
                // Verifica se 'prof.nomever' existe e não é uma string vazia.
                if (prof.nomever && prof.nomever.trim() !== '') {
                    finalNome = prof.nomever;
                } else {
                    // Se não existir, use a lógica original como padrão.
                    const palavras = prof.nome.trim().split(" ");
                    const primeiroNome = palavras[0];
                    const ultimoNome = palavras[palavras.length - 1];
                    finalNome = primeiroNome + ' ' + ultimoNome;
                }

                const foto = prof.perfil_f != null ? prof.perfil_f : 'sem-foto.png';

                // Estrutura do Card
                // AJUSTE: Trocado data-toggle por data-bs-toggle e data-target por data-bs-target
                col.innerHTML = `
                    <div class="card-professional">

                        <div class="profile-img-wrapper">
                            <img src="./assets/foto/${foto}" alt="Foto de ${finalNome}" class="profile-img">
                        </div>

                        <h5>${capitalizarNomeCompleto(finalNome)}</h5>
                        <p class="cargo">${prof.tipo_ass !== 'Psiquiatra' ? 'Psicológo(a)' : 'Psiquiatra'}</p>
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
                row.appendChild(col);
            });

            slide.appendChild(row);
            carouselContainer.appendChild(slide);
            isActive = false;
        }

        // CHAVE DA CORREÇÃO:
        // Inicializa os botões de collapse DEPOIS de adicionar os cards ao DOM
        initializeCollapseButtons();

        // Inicia o carrossel do Bootstrap com intervalo
        const carouselElement = document.getElementById('professional-carousel');
        new bootstrap.Carousel(carouselElement, {
            interval: 5000, // Intervalo de 5 segundos
            wrap: true
        });
    }

    function capitalizarNomeCompleto(nomeCompleto) {
        // Validação inicial para garantir que a entrada é uma string válida.
        if (!nomeCompleto || typeof nomeCompleto !== 'string') return '';

        /**
         * Função auxiliar interna que recebe uma palavra e a retorna com a primeira
         * letra em maiúscula e as demais em minúscula.
         * @param {string} str A string a ser formatada.
         * @returns {string} A string formatada.
         */
        const capitalize = (str) => {
            if (!str) return '';
            const primeiraLetra = str.charAt(0).toUpperCase();
            const restoDaString = str.slice(1).toLowerCase();
            return primeiraLetra + restoDaString;
        };

        // Lista de conectivos e preposições que devem permanecer em minúsculo.
        const excecoes = ['de', 'do', 'da', 'dos', 'das', 'e'];

        // 1. Converte todo o nome para minúsculas e depois o divide em um array de palavras.
        const palavras = nomeCompleto.toLowerCase().split(' ');

        // 2. Itera sobre cada palavra para aplicar a capitalização seletiva.
        const palavrasFormatadas = palavras.map((palavra, index) => {
            // 3. Verifica se a palavra atual está na lista de exceções.
            // A exceção não se aplica à primeira palavra do nome (index === 0).
            if (excecoes.includes(palavra) && index > 0) {
                // Se for uma exceção (e não a primeira palavra), retorna a palavra em minúsculas.
                return palavra;
            }
            // Se não for uma exceção, utiliza a função auxiliar 'capitalize' para formatá-la.
            return capitalize(palavra);
        });

        // 4. Junta as palavras formatadas de volta em uma única string, separadas por espaços.
        return palavrasFormatadas.join(' ');
    };

    // Inicia o processo
    loadProfessionals();
});