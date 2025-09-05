// Card principal
document.addEventListener("change", function (event) {
    if (!event.target.classList.contains("tipo-conta")) return;

    const tipo = event.target.value;
    const card = event.target.closest("[data-card]");

    if (!card) return; // evita o erro se o card não for encontrado

    const toggleFields = (selector, condition) => {
        card.querySelectorAll(selector).forEach(field => {
            field.style.display = condition ? "block" : "none";

            // Gerenciar os inputs internos (habilitar/desabilitar)
            field.querySelectorAll("input, select, textarea").forEach(input => {
                if (condition) {
                    input.disabled = false; // habilita
                    if (input.dataset.required === "true") {
                        input.setAttribute("required", true); // recoloca required original
                    }
                } else {
                    if (input.hasAttribute("required")) {
                        input.dataset.required = "true"; // marca que era required
                    }
                    input.removeAttribute("required"); // remove required para evitar erro
                    input.disabled = true; // desabilita para não enviar
                }
            });
        });
    };

    // Exibe/oculta os grupos
    document.querySelector(".boletos-alugueis").style.display =
        tipo === "Aluguel" ? "block" : "none";

    toggleFields(".aluguel-field", tipo === "Aluguel");
    toggleFields(".condominio-field", tipo === "Condomínio");
    toggleFields(".iptu-field", tipo === "IPTU");
    toggleFields(".seguro-field", tipo === "Seguro");
    toggleFields(".agua-field", tipo === "Água");
    toggleFields(".luz-field", tipo === "Luz");
    toggleFields(".gas-field", tipo === "Gás");
    toggleFields(".seguro-incendio-field", tipo === "Seguro incêndio");
    toggleFields(".outros-anexos-field", tipo === "Outros anexos");
    toggleFields(".orcamento-field", tipo === "Orçamentos de Reparos");
    toggleFields(".orcamento-container", tipo === "Orçamentos de Reparos");

    const boletoOriginal = card.querySelector("#comprovante-boleto-original");
    const multaRescisoria = card.querySelector(".multa-rescisoria-container-novo");

    if (boletoOriginal && multaRescisoria) {
        boletoOriginal.style.display = tipo === "Multa rescisória" ? "none" : "block";
        multaRescisoria.style.display = tipo === "Multa rescisória" ? "block" : "none";
    }

    // Elementos globais (fora do card)
    const globais = ["Condomínio", "IPTU", "Seguro", "Água", "Luz", "Gás", "Seguro incêndio", "Outros anexos"];
    if (globais.includes(tipo)) {
        document.getElementById("selecionar_mais_boletos").style.display = "none";
        document.getElementById("bloco-comprovantes").style.display = "none";
        document.getElementById("comprovantes-container").innerHTML = "";
    }
});

const radios = document.querySelectorAll('input[name="maisBoletos"]');
const contasDiv = document.getElementById("selecionar_mais_boletos");

radios.forEach((radio) => {
    radio.addEventListener("change", function () {
        if (this.value === "sim") {
            contasDiv.style.display = "block";
        } else {
            contasDiv.style.display = "none";
            document.getElementById("bloco-comprovantes").style.display =
                "none";
        }
    });
});

const buttons = document.querySelectorAll(".conta-btn");
const container = document.getElementById("comprovantes-container");
const blocoComprovantes = document.getElementById("bloco-comprovantes");
const slugify = (text) =>
    (text || "")
        .toString()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "")
        .toLowerCase()
        .replace(/\s+/g, "_")
        .replace(/[^\w\-]+/g, "");
const updateVisibility = () => {
    // Verifica se há algum bloco renderizado
    const blocosVisiveis = container.querySelectorAll('div[id^="bloco-"]');
    blocoComprovantes.style.display =
        blocosVisiveis.length > 0 ? "block" : "none";
};

buttons.forEach((btn) => {
    btn.addEventListener("click", () => {
        const contaNome = btn.dataset.conta;
        if (!contaNome) return;

        const contaSlug = slugify(contaNome);
        const blocoId = `bloco-${contaSlug}`;
        const blocoExistente = document.getElementById(blocoId);

        // Toggle de seleção
        btn.classList.toggle("ativo");

        if (blocoExistente) {
            blocoExistente.remove(); // Remove bloco se já existe
        } else {
            // Cria novo bloco se não existe
            const bloco = document.createElement("div");
            bloco.classList.add("mt-4");
            bloco.id = blocoId;

            bloco.innerHTML = `
                    <h5 class="m-0">${contaNome}</h5>
                    <p class="m-0 p-0">
                        Caso não tenha boleto exato desta conta, anexe um
                        documento que comprove a existência dela. Tamanho máximo 5MB
                    </p>

                    <div class="row gy-6 mt-3">
                        <div class="col-12">
                            <input class="form-control" name="anexos-${contaSlug}" type="file" id="formFile">
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-4">
                            <label for="valor_${contaSlug}_principal[]" class="form-label">Valor original sem multa e juros*</label>
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_${contaSlug}_principal[]"
                                name="valor_${contaSlug}_principal[]"
                                placeholder="R$ 0,00"
                            />
                        </div>

                        <div class="col-4">
                            <label for="vencimento_${contaSlug}_principal[]" class="form-label">Vencimento original*</label>
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_${contaSlug}_principal[]"
                                name="vencimento_${contaSlug}_principal[]"
                            />
                        </div>
                    </div>
                    <hr />
                `;

            container.appendChild(bloco);
        }

        updateVisibility();
    });
});

document.querySelectorAll(".select-btn").forEach((button) => {
    button.addEventListener("click", () => {
        button.classList.toggle("bg-black");
        button.classList.toggle("text-white");
        button.classList.toggle("border-gray-900");
    });
});

document.addEventListener("change", function (event) {
    if (!event.target.classList.contains("tipo-conta-novo")) return;

    const tipo = event.target.value;
    const card = event.target.closest("[data-card-novo]");
    if (!card) return;

    const toggleFields = (selector, condition) => {
        card.querySelectorAll(selector).forEach(field => {
            field.style.display = condition ? "block" : "none";
        });
    };

    // Mostra/esconde apenas dentro do card atual
    const boletosAlugueis = card.querySelector(".boletos-alugueis-novos");
    if (boletosAlugueis) {
        boletosAlugueis.style.display = tipo === "Aluguel" ? "block" : "none";
    }

    toggleFields("#card_aluguel", tipo === "Aluguel");
    toggleFields("#card_condominio", tipo === "Condomínio");
    toggleFields("#card_iptu", tipo === "IPTU");
    toggleFields("#card_seguro", tipo === "Seguro");
    toggleFields("#card_agua", tipo === "Água");
    toggleFields("#card_luz", tipo === "Luz");
    toggleFields("#card_gas", tipo === "Gás");
    toggleFields("#card_seguro_incendio", tipo === "Seguro incêndio");
    toggleFields("#card_outros_anexos", tipo === "Outros anexos");

    toggleFields(".orcamento-field-novo", tipo === "Orçamentos de Reparos");
    toggleFields(".orcamento-container-novo", tipo === "Orçamentos de Reparos");
    toggleFields(".orcamento-container-novo", tipo === "Orçamentos de Reparos");

    // toggleFields("#anexos_novo_aluguel", tipo === "Aluguel");
    // toggleFields("#anexos_novo_condominio", tipo === "Condomínio");
    // toggleFields("#anexos_novo_iptu", tipo === "IPTU");
    // toggleFields("#anexos_novo_seguro", tipo === "Seguro");
    // toggleFields("#anexos_novo_agua", tipo === "Água");
    // toggleFields("#anexos_novo_luz", tipo === "Luz");
    // toggleFields("#anexos_novo_gas", tipo === "Gás");
    // toggleFields("#anexos_novo_seguro-incendio", tipo === "Seguro incêndio");
    // toggleFields("#anexos_novo_outros-anexos", tipo === "Outros anexos");
    // toggleFields(".orcamento", tipo === "Orçamentos de Reparos");
    // toggleFields(".orcamento-container-novo", tipo === "Orçamentos de Reparos");
    // toggleFields(".orcamento-container-novo", tipo === "Orçamentos de Reparos");

    const orcamentos = card.querySelector(".orcamento-container-novo");
    const multaRescisoria = card.querySelector(".multa-rescisoria-container-novo");
    const boletoOriginal = card.querySelector("#comprovante-boleto-original-novo");

    if (boletoOriginal && multaRescisoria && orcamentos) {
        boletoOriginal.style.display = tipo === "Multa rescisória" ? "none" : "block";
        boletoOriginal.style.display = tipo === "Orçamentos de Reparos" ? "none" : "block";
        multaRescisoria.style.display = tipo === "Multa rescisória" ? "block" : "none";
    }

    const blocoComprovantes = card.querySelector("#bloco-comprovantes-novo");
    const selecionarMaisBoletos = card.querySelector("#selecionar_mais_boletos_novo");
    const container = card.querySelector("#comprovantes-container-novo");

    // Reseta quando não for aluguel
    if (tipo !== "Aluguel" && selecionarMaisBoletos && blocoComprovantes) {
        selecionarMaisBoletos.style.display = "none";
        blocoComprovantes.style.display = "none";
        if (container) container.innerHTML = "";
    }
});

// Radios do card novo
document.addEventListener("change", function (event) {
    if (!event.target.name.includes("possuiMaisBoletosNovo")) return;

    const card = event.target.closest("[data-card-novo]");
    if (!card) return;

    const selecionarMaisBoletos = card.querySelector("#selecionar_mais_boletos_novo");
    const blocoComprovantes = card.querySelector("#bloco-comprovantes-novo");

    if (event.target.value === "sim") {
        selecionarMaisBoletos.style.display = "block";
    } else {
        selecionarMaisBoletos.style.display = "none";
        blocoComprovantes.style.display = "none";
    }
});

// Botões de selecionar contas no card novo
document.addEventListener("click", function (event) {
    if (!event.target.classList.contains("conta-btn-novo")) return;

    const btn = event.target;
    const contaNome = btn.dataset.novo;
    console.log(contaNome)
    const contaSlug = slugify(contaNome);
    const card = btn.closest("[data-card-novo]");
    const container = card.querySelector("#comprovantes-container-novo");
    const blocoComprovantes = card.querySelector("#bloco-comprovantes-novo");

    const blocoId = `bloco-novo-${contaSlug}`;
    const blocoExistente = container.querySelector(`#${blocoId}`);

    btn.classList.toggle("ativo");

    if (blocoExistente) {
        blocoExistente.remove();
    } else {
        const bloco = document.createElement("div");
        bloco.classList.add("mt-4");
        bloco.id = blocoId;

        bloco.innerHTML = `
            <h5 class="m-0">${contaNome}</h5>
            <p class="m-0 p-0">Anexe um documento que comprove essa conta.</p>
            <div class="row gy-6 mt-3">
                <div class="col-12">
                    <input class="form-control" name="anexos_novo_${contaSlug}[]" type="file">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4">
                    <label class="form-label">Valor original*</label>
                    <input required type="text" class="form-control" name="valor_${contaSlug}_novo[]" placeholder="R$ 0,00"/>
                </div>
                <div class="col-4">
                    <label class="form-label">Vencimento original*</label>
                    <input required type="date" class="form-control" name="vencimento_${contaSlug}_novo[]"/>
                </div>
            </div>
            <hr/>
        `;

        container.appendChild(bloco);
    }

    blocoComprovantes.style.display = container.children.length > 0 ? "block" : "none";
});
