// Opção: Aluguel
document
    .getElementById("defaultSelect")
    .addEventListener("change", function () {
        document.querySelector(".boletos-alugueis").style.display =
            this.value === "Aluguel" ? "block" : "none";

        const aluguelFields = document.querySelectorAll(".aluguel-field");

        aluguelFields.forEach((field) => {
            field.style.display =
                this.value === "Aluguel" ? "block" : "none";
        });

        const condominioFields = document.querySelectorAll(".condominio-field");

        condominioFields.forEach((field) => {
            field.style.display =
                this.value === "Condomínio" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });

        const iptuFields = document.querySelectorAll(".iptu-field");

        iptuFields.forEach((field) => {
            field.style.display =
                this.value === "IPTU" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });

        const seguroFields = document.querySelectorAll(".seguro-field");

        seguroFields.forEach((field) => {
            field.style.display =
                this.value === "Seguro" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });

        const aguaFields = document.querySelectorAll(".agua-field");

        aguaFields.forEach((field) => {
            field.style.display =
                this.value === "Água" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });

        const luzFields = document.querySelectorAll(".luz-field");

        luzFields.forEach((field) => {
            field.style.display =
                this.value === "Luz" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });

        const gasFields = document.querySelectorAll(".gas-field");

        gas.forEach((field) => {
            field.style.display =
                this.value === "Gás" ? "block" : "none";
            document.getElementById("selecionar_mais_boletos").style.display = 'none'
            document.getElementById("bloco-comprovantes").style.display = 'none'
            document.getElementById("comprovantes-container").html = ''
        });
    });

const radios = document.querySelectorAll('input[name="customRadioTemp"]');
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

                    <div class="row gy-6 mt-4">
                        <div class="col-12">
                            <div class="dropzone needsclick dz-clickable" id="dropzone-${contaSlug}">
                                <div class="dz-message needsclick">
                                    Clique ou arraste o arquivo aqui
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-4">
                            <label for="valor_original_${contaSlug}" class="form-label">Valor original sem multa e juros*</label>
                            <input
                                required
                                type="text"
                                class="form-control"
                                id="valor_original_${contaSlug}"
                                name="valor_original_${contaSlug}"
                                placeholder="R$ 0,00"
                            />
                        </div>

                        <div class="col-4">
                            <label for="vencimento_original_${contaSlug}" class="form-label">Vencimento original*</label>
                            <input
                                required
                                type="date"
                                class="form-control"
                                id="vencimento_original_${contaSlug}"
                                name="vencimento_original_${contaSlug}"
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
