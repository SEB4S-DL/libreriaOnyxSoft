const responseDiv = document.getElementById("respuesta3");

document.querySelectorAll("form[id='eliminarLibro']").forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();

        const BASE_URL = '/libreriaOnyxSoft/';
        const formData = new FormData(form);

        fetch(BASE_URL + "functions/eliminarLibro.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text()) 
        .then(data => {
            console.log("Respuesta del servidor:", data);
            responseDiv.textContent = "✅ Libro eliminado exitosamente";
            setTimeout(() => {
                window.location.href = BASE_URL + "index.php";
            }, 1000);
        })
        .catch(error => {
            console.error("Error en el envío:", error);
            responseDiv.textContent = "❌ Error al enviar el formulario";
        });
    });
});
