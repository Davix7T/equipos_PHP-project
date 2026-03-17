<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Jugadores</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="sidebar.css">
</head>
<body>

<div class="dashboard-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
    <div class="sidebar-header">
        <h2>⚽ Fútbol System</h2>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="dashboard.php">
                <span class="sidebar-icon">📊</span>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="index.php" class="active">
                <span class="sidebar-icon">👤</span>
                <span>Jugadores</span>
            </a>
        </li>
        <li>
            <a href="equipos.php">
                <span class="sidebar-icon">👕</span>
                <span>Equipos / Camisetas</span>
            </a>
        </li>
    </ul>
</aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="container">
            <h1>Lista de Jugadores</h1>

            <div class="acciones-top">
                <button class="btn agregar" onclick="abrirModalAgregar()">+ Agregar Jugador</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Posición</th>
                        <th>Equipo</th>
                        <th>Edad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaJugadores">
                    <tr>
                        <td colspan="5">Cargando jugadores...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Modal Agregar -->
<div id="modalAgregar" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModalAgregar()">&times;</span>
        <h2>Agregar Nuevo Jugador</h2>
        <form id="formAgregar" onsubmit="agregarJugador(event)">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Posición:</label>
                <select name="posicion" required>
                    <option value="">Seleccione una posición</option>
                    <option value="DC">DC - Delantero Centro</option>
                    <option value="MC">MC - Mediocampista</option>
                    <option value="DEF">DEF - Defensa</option>
                    <option value="PO">PO - Portero</option>
                </select>
            </div>
            <div class="form-group">
                <label>Equipo:</label>
                <select name="equipo_id" id="selectEquipoAgregar">
                    <option value="">Sin equipo</option>
                </select>
            </div>
            <div class="form-group">
                <label>Edad:</label>
                <input type="number" name="edad" required min="1" max="99">
            </div>
            <button type="submit" class="btn agregar">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Editar -->
<div id="modalEditar" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModalEditar()">&times;</span>
        <h2>Editar Jugador</h2>
        <form id="formEditar" onsubmit="editarJugador(event)">
            <input type="hidden" name="id" id="editarId">
            <div class="form-group">
                <label>Nombre:</label>
                <input type="text" name="nombre" id="editarNombre" required>
            </div>
            <div class="form-group">
                <label>Posición:</label>
                <select name="posicion" id="editarPosicion" required>
                    <option value="">Seleccione una posición</option>
                    <option value="DC">DC - Delantero Centro</option>
                    <option value="MC">MC - Mediocampista</option>
                    <option value="DEF">DEF - Defensa</option>
                    <option value="PO">PO - Portero</option>
                </select>
            </div>
            <div class="form-group">
                <label>Equipo:</label>
                <select name="equipo_id" id="editarEquipo">
                    <option value="">Sin equipo</option>
                </select>
            </div>
            <div class="form-group">
                <label>Edad:</label>
                <input type="number" name="edad" id="editarEdad" required min="1" max="99">
            </div>
            <button type="submit" class="btn editar">Actualizar</button>
        </form>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>