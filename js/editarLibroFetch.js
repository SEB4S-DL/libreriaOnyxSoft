const responseDiv = document.getElementById("respuesta2");

document.getElementById("editarLibro").addEventListener("submit", function(e) {
    e.preventDefault();

    const BASE_URL = '/libreriaOnyxSoft/';
    const form = e.target;
    const formData = new FormData(form);

    fetch(BASE_URL + "functions/editarLibro.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text()) // o .json() si devuelves JSON
    .then(data => {
        console.log("Respuesta del servidor:", data);
        responseDiv.textContent = "✅ Libro actualizado exitosamente";
         setTimeout(() => {
             window.location.href = BASE_URL + "index.php";
         }, 2000);
    })
    .catch(error => {
        console.error("Error en el envío:", error);
        responseDiv.textContent = "❌ Error al enviar el formulario";
    });
});
