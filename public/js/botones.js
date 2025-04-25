
    document.addEventListener('DOMContentLoaded', function () {
        // Manejar el clic en el botón de incrementar
        document.querySelectorAll('.boton-mas').forEach(button => {
            button.addEventListener('click', function () {
                const quantityElement = this.previousElementSibling; // El <span> antes del botón
                let quantity = parseInt(quantityElement.textContent);
                quantity++;
                quantityElement.textContent = quantity;
            });
        });

        // Manejar el clic en el botón de decrementar
        document.querySelectorAll('.boton-menos').forEach(button => {
            button.addEventListener('click', function () {
                const quantityElement = this.nextElementSibling; // El <span> después del botón
                let quantity = parseInt(quantityElement.textContent);
                if (quantity > 0) {
                    quantity--;
                    quantityElement.textContent = quantity;
                }
            });
        });
    });

