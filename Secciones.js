function cargarSeccion(seccion) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', `http://localhost/Proyectos/Sistema_De_Inventario_Pecosol/App/Controllers/ControladorSeccion.php?seccion=${seccion}`, true);

    xhr.onload = function() {
        if (this.status === 200) {
            document.querySelector('.contenido').innerHTML = this.responseText;
        } else {
            document.querySelector('.contenido').innerHTML = `<p>Error al cargar la sección. Código de estado: ${this.status}</p>`;
        }
    };

    xhr.onerror = function() {
        document.querySelector('.contenido').innerHTML = '<p>Error de conexión.</p>';
    };

    xhr.send();
}
