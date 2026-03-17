// Cargar jugadores
function cargarJugadores() {
    const tabla = document.getElementById('tablaJugadores');
    
    fetch('obtener_jugador.php')
        .then(response => response.json())
        .then(jugadores => {
            tabla.innerHTML = '';
            
            if (jugadores.length > 0) {
                jugadores.forEach(jugador => {
                    const fila = document.createElement('tr');
                    
                    const celdaNombre = document.createElement('td');
                    celdaNombre.textContent = jugador.nombre;
                    
                    const celdaPosicion = document.createElement('td');
                    celdaPosicion.textContent = jugador.posicion;
                    
                    const celdaEquipo = document.createElement('td');
                    celdaEquipo.textContent = jugador.equipo_nombre || 'Sin equipo';
                    
                    const celdaEdad = document.createElement('td');
                    celdaEdad.textContent = jugador.edad;
                    
                    const celdaAcciones = document.createElement('td');
                    celdaAcciones.className = 'acciones';
                    
                    const btnEditar = document.createElement('button');
                    btnEditar.className = 'btn editar';
                    btnEditar.textContent = 'Editar';
                    btnEditar.onclick = function() {
                        abrirModalEditar(jugador.id, jugador.nombre, jugador.posicion, jugador.equipo_id, jugador.edad);
                    };
                    
                    const btnEliminar = document.createElement('button');
                    btnEliminar.className = 'btn eliminar';
                    btnEliminar.textContent = 'Eliminar';
                    btnEliminar.onclick = function() {
                        eliminarJugador(jugador.id, jugador.nombre);
                    };
                    
                    celdaAcciones.appendChild(btnEditar);
                    celdaAcciones.appendChild(btnEliminar);
                    
                    fila.appendChild(celdaNombre);
                    fila.appendChild(celdaPosicion);
                    fila.appendChild(celdaEquipo);
                    fila.appendChild(celdaEdad);
                    fila.appendChild(celdaAcciones);
                    
                    tabla.appendChild(fila);
                });
            } else {
                tabla.innerHTML = '<tr><td colspan="5">No hay jugadores registrados</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error al cargar jugadores:', error);
            tabla.innerHTML = '<tr><td colspan="5">Error al cargar jugadores</td></tr>';
        });
}

// Cargar equipos en los selects
function cargarEquiposEnSelect() {
    fetch('obtener_equipos.php')
        .then(response => response.json())
        .then(equipos => {
            const selectAgregar = document.getElementById('selectEquipoAgregar');
            const selectEditar = document.getElementById('editarEquipo');
            
            // Limpiar opciones anteriores (excepto "Sin equipo")
            selectAgregar.innerHTML = '<option value="">Sin equipo</option>';
            selectEditar.innerHTML = '<option value="">Sin equipo</option>';
            
            // Agregar cada equipo como opción
            equipos.forEach(equipo => {
                const optionAgregar = document.createElement('option');
                optionAgregar.value = equipo.id;
                optionAgregar.textContent = `${equipo.nombre} - Dorsal: ${equipo.dorsal} - $${parseFloat(equipo.precio).toFixed(2)}`;
                selectAgregar.appendChild(optionAgregar);
                
                const optionEditar = document.createElement('option');
                optionEditar.value = equipo.id;
                optionEditar.textContent = `${equipo.nombre} - Dorsal: ${equipo.dorsal} - $${parseFloat(equipo.precio).toFixed(2)}`;
                selectEditar.appendChild(optionEditar);
            });
        })
        .catch(error => {
            console.error('Error al cargar equipos:', error);
        });
}

// Modal Agregar
function abrirModalAgregar() {
    cargarEquiposEnSelect();
    document.getElementById('modalAgregar').style.display = 'block';
}

function cerrarModalAgregar() {
    document.getElementById('modalAgregar').style.display = 'none';
    document.getElementById('formAgregar').reset();
}

// Modal Editar
function abrirModalEditar(id, nombre, posicion, equipo_id, edad) {
    cargarEquiposEnSelect();
    
    // Esperar un poco para que carguen los equipos
    setTimeout(() => {
        document.getElementById('editarId').value = id;
        document.getElementById('editarNombre').value = nombre;
        document.getElementById('editarPosicion').value = posicion;
        document.getElementById('editarEquipo').value = equipo_id || '';
        document.getElementById('editarEdad').value = edad;
        document.getElementById('modalEditar').style.display = 'block';
    }, 100);
}

function cerrarModalEditar() {
    document.getElementById('modalEditar').style.display = 'none';
    document.getElementById('formEditar').reset();
}

// Agregar jugador
function agregarJugador(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    
    fetch('agregar_jugador.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(respuesta => {
            alert(respuesta.message);
            
            if (respuesta.success) {
                cerrarModalAgregar();
                cargarJugadores();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al agregar jugador');
        });
}

// Editar jugador
function editarJugador(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    
    fetch('editar_jugador.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(respuesta => {
            alert(respuesta.message);
            
            if (respuesta.success) {
                cerrarModalEditar();
                cargarJugadores();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al editar jugador');
        });
}

// Eliminar jugador
function eliminarJugador(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar a ${nombre}?`)) {
        const formData = new FormData();
        formData.append('id', id);
        
        fetch('eliminar_jugador.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(respuesta => {
                alert(respuesta.message);
                
                if (respuesta.success) {
                    cargarJugadores();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar jugador');
            });
    }
}

// Cerrar modales al hacer clic fuera
window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregar');
    const modalEditar = document.getElementById('modalEditar');
    
    if (event.target == modalAgregar) {
        cerrarModalAgregar();
    }
    if (event.target == modalEditar) {
        cerrarModalEditar();
    }
}

// Cargar jugadores al iniciar
document.addEventListener('DOMContentLoaded', cargarJugadores);