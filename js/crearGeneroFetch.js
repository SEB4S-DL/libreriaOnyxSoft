const responseDiv = document.getElementById("respuesta4");

document.getElementById("crearGenero").addEventListener("submit", function(e) {
    e.preventDefault();

    const BASE_URL = '/libreriaOnyxSoft/';
    const form = e.target;
    const formData = new FormData(form);

    fetch(BASE_URL + "functions/crearGenero.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log("Respuesta del servidor:", data);

        if (data.status === "success") {
            responseDiv.textContent = "✅ " + data.message;
            setTimeout(() => {
                window.location.href = BASE_URL + "index.php";
            }, 2000);
        } else {
            responseDiv.textContent = "❌ " + data.message;
        }
    })
    .catch(error => {
        console.error("Error en el envío:", error);
        responseDiv.textContent = "❌ Error al enviar el formulario";
    });
});
