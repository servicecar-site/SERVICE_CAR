document.addEventListener("DOMContentLoaded", () => {

    const formulario = document.querySelector(".cadastro-empresa form");

    const cnpj = document.getElementById("cnpj");
    const cep = document.getElementById("cep");
    const senha = document.getElementById("senha");
    const confirmarSenha = document.getElementById("confirmar_senha");

    if (!formulario) return;

    cnpj.addEventListener("input", () => {

        cnpj.value = cnpj.value
            .toUpperCase()
            .replace(/[^A-Z0-9./-]/g, "");

        cnpj.setCustomValidity("");

    });

    cep.addEventListener("input", () => {

        cep.setCustomValidity("");

    });

    confirmarSenha.addEventListener("input", () => {

        confirmarSenha.setCustomValidity("");

    });

    senha.addEventListener("input", () => {

        confirmarSenha.setCustomValidity("");

    });

    formulario.addEventListener("submit", (event) => {

        const cnpjLimpo = cnpj.value
            .toUpperCase()
            .replace(/[^A-Z0-9]/g, "");

        const cepLimpo = cep.value.replace(/\D/g, "");

        if (!/^[A-Z0-9]{12}[0-9]{2}$/.test(cnpjLimpo)) {

            event.preventDefault();

            cnpj.setCustomValidity(
                "Informe um CNPJ com 14 caracteres válidos."
            );

            cnpj.reportValidity();
            return;

        }

        if (cepLimpo.length !== 8) {

            event.preventDefault();

            cep.setCustomValidity(
                "Informe um CEP com 8 números."
            );

            cep.reportValidity();
            return;

        }

        if (senha.value !== confirmarSenha.value) {

            event.preventDefault();

            confirmarSenha.setCustomValidity(
                "As senhas não coincidem."
            );

            confirmarSenha.reportValidity();
            return;

        }

    });

});