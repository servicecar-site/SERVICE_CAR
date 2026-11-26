
/* ========================================
   SERVICE CAR - JAVASCRIPT GLOBAL
======================================== */

document.addEventListener("DOMContentLoaded", () => {

    const menuToggle = document.getElementById("menu-toggle");
    const headerNav = document.getElementById("header-nav");

    if (menuToggle && headerNav) {

        function fecharMenu() {
            headerNav.classList.remove("active");
            menuToggle.setAttribute("aria-expanded", "false");
            menuToggle.setAttribute("aria-label", "Abrir menu");
        }

        // Abrir e fechar o menu
        menuToggle.addEventListener("click", () => {

            const aberto = headerNav.classList.toggle("active");

            menuToggle.setAttribute("aria-expanded", String(aberto));

            menuToggle.setAttribute(
                "aria-label",
                aberto ? "Fechar menu" : "Abrir menu"
            );

        });

        // Fechar ao clicar em um link
        headerNav.querySelectorAll("a").forEach(link => {

            link.addEventListener("click", fecharMenu);

        });

        // Fechar ao pressionar ESC
        document.addEventListener("keydown", event => {

            if (event.key === "Escape") {
                fecharMenu();
            }

        });

        // Fechar ao retornar para a versão desktop
        window.addEventListener("resize", () => {

            if (window.innerWidth > 992) {
                fecharMenu();
            }

        });

    }

});
