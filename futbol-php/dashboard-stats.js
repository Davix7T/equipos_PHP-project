let chartPorPosicion = null;
let chartPorEquipo = null;

// Cargar estadísticas
function cargarEstadisticas() {
    fetch('obtener_estadisticas.php')
        .then(response => response.json())
        .then(data => {
            // Actualizar tarjetas
            document.getElementById('totalJugadores').textContent = data.totalJugadores;
            document.getElementById('totalEquipos').textContent = data.totalEquipos;
            document.getElementById('edadPromedio').textContent = data.edadPromedio + ' años';
            document.getElementById('precioPromedio').textContent = '$' + data.precioPromedio;
            document.getElementById('jugadoresSinEquipo').textContent = data.jugadoresSinEquipo;
            document.getElementById('totalRegistros').textContent = 
                parseInt(data.totalJugadores) + parseInt(data.totalEquipos);

            // Crear gráfico de jugadores por posición
            crearGraficoPorPosicion(data.jugadoresPorPosicion);

            // Crear gráfico de jugadores por equipo
            crearGraficoPorEquipo(data.jugadoresPorEquipo);

            // Mostrar top equipos más caros
            mostrarTopEquipos(data.equiposCaros);
        })
        .catch(error => {
            console.error('Error al cargar estadísticas:', error);
        });
}

// Gráfico de jugadores por posición
function crearGraficoPorPosicion(datos) {
    const ctx = document.getElementById('chartPorPosicion').getContext('2d');
    
    // Destruir gráfico anterior si existe
    if (chartPorPosicion) {
        chartPorPosicion.destroy();
    }

    const posiciones = datos.map(d => d.posicion);
    const cantidades = datos.map(d => d.cantidad);

    chartPorPosicion = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: posiciones,
            datasets: [{
                data: cantidades,
                backgroundColor: [
                    '#667eea',
                    '#2c7a2c',
                    '#f0a500',
                    '#8E44AD'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
}

// Gráfico de jugadores por equipo
function crearGraficoPorEquipo(datos) {
    const ctx = document.getElementById('chartPorEquipo').getContext('2d');
    
    // Destruir gráfico anterior si existe
    if (chartPorEquipo) {
        chartPorEquipo.destroy();
    }

    const equipos = datos.map(d => d.equipo);
    const cantidades = datos.map(d => d.cantidad);

    chartPorEquipo = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: equipos,
            datasets: [{
                label: 'Cantidad de Jugadores',
                data: cantidades,
                backgroundColor: 'rgba(44, 122, 44, 0.7)',
                borderColor: '#2c7a2c',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}

// Mostrar top equipos más caros
function mostrarTopEquipos(equipos) {
    const container = document.getElementById('topEquipos');
    container.innerHTML = '';

    equipos.forEach((equipo, index) => {
        const item = document.createElement('div');
        item.className = 'top-item';
        
        item.innerHTML = `
            <div class="top-item-rank">#${index + 1}</div>
            <div class="top-item-name">${equipo.nombre}</div>
            <div class="top-item-value">$${parseFloat(equipo.precio).toFixed(2)}</div>
        `;
        
        container.appendChild(item);
    });
}

// Cargar estadísticas al iniciar
document.addEventListener('DOMContentLoaded', cargarEstadisticas);

// Recargar cada 30 segundos
setInterval(cargarEstadisticas, 30000);