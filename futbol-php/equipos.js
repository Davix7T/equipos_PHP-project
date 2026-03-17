// Cargar equipos
function cargarEquipos() {
    const tabla = document.getElementById('tablaEquipos');
    
    fetch('obtener_equipos.php')
        .then(response => response.json())
        .then(equipos => {
            tabla.innerHTML = '';
            
            if (equipos.length > 0) {
                equipos.forEach(equipo => {
                    const fila = document.createElement('tr');
                    
                    const celdaId = document.createElement('td');
                    celdaId.textContent = equipo.id;
                    
                    const celdaNombre = document.createElement('td');
                    celdaNombre.textContent = equipo.nombre;
                    
                    const celdaDorsal = document.createElement('td');
                    celdaDorsal.textContent = equipo.dorsal;
                    
                    const celdaPrecio = document.createElement('td');
                    celdaPrecio.textContent = '$' + parseFloat(equipo.precio).toFixed(2);
                    celdaPrecio.style.fontWeight = 'bold';
                    celdaPrecio.style.color = '#2c7a2c';
                    
                    const celdaAcciones = document.createElement('td');
                    celdaAcciones.className = 'acciones';
                    
                    const btnEditar = document.createElement('button');
                    btnEditar.className = 'btn editar';
                    btnEditar.textContent = 'Editar';
                    btnEditar.onclick = function() {
                        abrirModalEditarEquipo(equipo.id, equipo.nombre, equipo.dorsal, equipo.precio);
                    };
                    
                    const btnEliminar = document.createElement('button');
                    btnEliminar.className = 'btn eliminar';
                    btnEliminar.textContent = 'Eliminar';
                    btnEliminar.onclick = function() {
                        eliminarEquipo(equipo.id, equipo.nombre);
                    };
                    
                    celdaAcciones.appendChild(btnEditar);
                    celdaAcciones.appendChild(btnEliminar);
                    
                    fila.appendChild(celdaId);
                    fila.appendChild(celdaNombre);
                    fila.appendChild(celdaDorsal);
                    fila.appendChild(celdaPrecio);
                    fila.appendChild(celdaAcciones);
                    
                    tabla.appendChild(fila);
                });
            } else {
                tabla.innerHTML = '<tr><td colspan="5">No hay equipos registrados</td></tr>';
            }
        })
        .catch(error => {
            console.error('Error al cargar equipos:', error);
            tabla.innerHTML = '<tr><td colspan="5">Error al cargar equipos</td></tr>';
        });
}

// Modal Agregar Equipo
function abrirModalAgregarEquipo() {
    document.getElementById('modalAgregarEquipo').style.display = 'block';
}

function cerrarModalAgregarEquipo() {
    document.getElementById('modalAgregarEquipo').style.display = 'none';
    document.getElementById('formAgregarEquipo').reset();
}

// Modal Editar Equipo
function abrirModalEditarEquipo(id, nombre, dorsal, precio) {
    document.getElementById('editarEquipoId').value = id;
    document.getElementById('editarEquipoNombre').value = nombre;
    document.getElementById('editarEquipoDorsal').value = dorsal;
    document.getElementById('editarEquipoPrecio').value = precio;
    document.getElementById('modalEditarEquipo').style.display = 'block';
}

function cerrarModalEditarEquipo() {
    document.getElementById('modalEditarEquipo').style.display = 'none';
    document.getElementById('formEditarEquipo').reset();
}

// Agregar equipo
function agregarEquipo(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    
    fetch('agregar_equipo.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(respuesta => {
            alert(respuesta.message);
            
            if (respuesta.success) {
                cerrarModalAgregarEquipo();
                cargarEquipos();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al agregar equipo');
        });
}

// Editar equipo
function editarEquipo(event) {
    event.preventDefault();
    
    const formData = new FormData(event.target);
    
    fetch('editar_equipo.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(respuesta => {
            alert(respuesta.message);
            
            if (respuesta.success) {
                cerrarModalEditarEquipo();
                cargarEquipos();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al editar equipo');
        });
}

// Eliminar equipo
function eliminarEquipo(id, nombre) {
    if (confirm(`¿Estás seguro de eliminar el equipo ${nombre}?`)) {
        const formData = new FormData();
        formData.append('id', id);
        
        fetch('eliminar_equipo.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(respuesta => {
                alert(respuesta.message);
                
                if (respuesta.success) {
                    cargarEquipos();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al eliminar equipo');
            });
    }
}

// Cerrar modales al hacer clic fuera
window.onclick = function(event) {
    const modalAgregar = document.getElementById('modalAgregarEquipo');
    const modalEditar = document.getElementById('modalEditarEquipo');
    
    if (event.target == modalAgregar) {
        cerrarModalAgregarEquipo();
    }
    if (event.target == modalEditar) {
        cerrarModalEditarEquipo();
    }
}

// Cargar equipos al iniciar
document.addEventListener('DOMContentLoaded', cargarEquipos);