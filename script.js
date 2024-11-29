document.addEventListener("DOMContentLoaded", function() {
    // Validación de formularios
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.addEventListener("submit", function(event) {
            let valid = true;

            // Obtener campos del formulario
            const email = form.querySelector("input[type='email']");
            const password = form.querySelector("input[type='password']");
            const nombre = form.querySelector("input[name='nombre']");
            const carrera = form.querySelector("input[name='carrera']");
            const matricula = form.querySelector("input[name='matricula']");

            // Validar campos requeridos
            if (!nombre.value || !carrera.value || !matricula.value || !email.value || !password.value) {
                valid = false;
                alert("Por favor, completa todos los campos requeridos.");
            }

            // Validar formato del email
            const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (email.value && !emailPattern.test(email.value)) {
                valid = false;
                alert("Por favor, ingresa un email válido.");
            }

            if (!valid) {
                event.preventDefault(); // Evitar el envío del formulario si hay errores
            }
        });

        // Confirmaciones para acciones críticas
        if (form.querySelector("button[name='prestamo']")) {
            form.addEventListener("submit", function(event) {
                const confirmAction = confirm("¿Estás seguro de que deseas prestar este libro?");
                if (!confirmAction) {
                    event.preventDefault(); // Evitar el envío del formulario si el usuario cancela
                }
            });
        }
    });

    // Manejo de mensajes (opcional)
    window.showMessage = function(message, isError) {
        const messageBox = document.getElementById('messageBox'); // Asegúrate de tener un contenedor para mensajes
        messageBox.textContent = message;
        messageBox.style.color = isError ? 'red' : 'green';
        messageBox.style.display = 'block';
    };
});