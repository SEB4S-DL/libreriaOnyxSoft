# 📚 API REST - Librería OnyxSoft

Documentación de los endpoints disponibles para la gestión de libros y géneros en el sistema.

---

## 📌 Endpoints disponibles

---

### ✅ 1. Crear Libro

- **URL:** `/functions/crearLibro.php`
- **Método:** `POST`
- **Parámetros esperados:**
  - `titulo` (string): Solo letras y espacios. **Obligatorio**.
  - `autor` (string): Solo letras y espacios. **Obligatorio**.
  - `genero` (int): ID del género. **Obligatorio**.
  - `anio` (int): Año de publicación. **Obligatorio**.

- **Validaciones aplicadas:**
  - Todos los campos son obligatorios.
  - `titulo` y `autor` no pueden contener números ni caracteres especiales.
  - `anio` debe ser un número entero.
  - Se evita la creación de registros duplicados (por combinación título + autor).

- **Respuesta (éxito):**
```json
{ "status": "success", "message": "Libro creado exitosamente." }
```

- **Respuesta (error):**
```json
{ "status": "error", "message": "El título solo puede contener letras y espacios." }
```

---

### ✏️ 2. Editar Libro

- **URL:** `/functions/editarLibro.php`
- **Método:** `POST`
- **Parámetros esperados:**
  - `id_libro` (int): ID del libro a editar.
  - `titulo` (string): Nuevo título.
  - `genero` (int): Nuevo ID de género.
  - `anio` (int): Año actualizado.

- **Validaciones aplicadas:**
  - Todos los campos deben estar presentes.
  - El `titulo` debe ser una cadena de texto sin números ni símbolos.
  - El `anio` debe ser un número entero.

- **Respuesta (éxito):**
```json
{ "status": "success", "message": "Libro actualizado correctamente." }
```

- **Respuesta (error):**
```json
{ "status": "error", "message": "Faltan datos para actualizar el libro." }
```

---

### 🗑️ 3. Eliminar Libro

- **URL:** `/functions/eliminarLibro.php`
- **Método:** `POST`
- **Parámetro esperado:**
  - `id_libro` (int): ID del libro a eliminar.

- **Comportamiento:**
  - Elimina el libro de forma lógica o física dependiendo de la implementación.
  - En esta versión, se elimina de forma definitiva.

- **Respuesta (éxito):**
```text
Libro eliminado correctamente.
```

- **Respuesta (error):**
```text
Error al eliminar el libro.
```

---

### ➕ 4. Crear Género

- **URL:** `/functions/crearGenero.php`
- **Método:** `POST`
- **Parámetro esperado:**
  - `nombre` (string): Nombre del género.

- **Validaciones aplicadas:**
  - Campo obligatorio.
  - Solo texto (letras y espacios).
  - No se permite repetir el nombre de género si ya existe.

- **Respuesta (éxito):**
```json
{ "status": "success", "message": "Género creado correctamente." }
```

- **Respuesta (error):**
```json
{ "status": "error", "message": "Ya existe un género con ese nombre." }
```

---

## 🔐 Seguridad y validaciones

- **Protección del lado del servidor (PHP):**
  - Validación de entradas.
  - Prevención de duplicados.
  - Rechazo de caracteres no válidos.
  - Blindaje ante campos vacíos.

- **Validación del lado del cliente (JavaScript):**
  - Evita que el usuario escriba números en campos de texto como autor y título.
  - Se muestra retroalimentación clara en cada formulario.

- **Recomendaciones adicionales:**
  - Usa HTTPS en entornos reales.
  - Desactiva `display_errors` en producción.
  - Considera un middleware de autenticación para seguridad avanzada.

---

## 🧪 Formatos de ejemplo

### Crear libro (POST)

**Body (x-www-form-urlencoded o JSON):**
```json
{
  "titulo": "Cien Años de Soledad",
  "autor": "Gabriel García Márquez",
  "genero": 2,
  "anio": 1967
}
```

---

## 📄 Notas adicionales

- Cada formulario ha sido optimizado con estilos responsive y validaciones anti-spam / duplicados.
- Puedes añadir un endpoint de consulta (`GET libros`, `GET generos`) si necesitas integraciones móviles o con otra plataforma.
- La arquitectura es escalable, modular y fácilmente ampliable.

---

**Versión:** 1.0  
**Autor:** Sebas Duque  
**Proyecto:** Librería OnyxSoft  
**Fecha:** Junio 2025  
