<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Equipos</title>
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
            <h1>Catálogo de Equipos / Camisetas</h1>

            <div class="acciones-top">
                <button class="btn agregar" onclick="abrirModalAgregarEquipo()">+ Agregar Equipo</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Equipo</th>
                        <th>Dorsal</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaEquipos">
                    <tr>
                        <td colspan="5">Cargando equipos...</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Modal Agregar Equipo -->
<div id="modalAgregarEquipo" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModalAgregarEquipo()">&times;</span>
        <h2>Agregar Nuevo Equipo</h2>
        <form id="formAgregarEquipo" onsubmit="agregarEquipo(event)">
            <div class="form-group">
                <label>Nombre del Equipo:</label>
                <input type="text" name="nombre" required>
            </div>
            <div class="form-group">
                <label>Número de Dorsal:</label>
                <input type="number" name="dorsal" required min="1" max="99">
            </div>
            <div class="form-group">
                <label>Precio ($):</label>
                <input type="number" name="precio" step="0.01" required min="0.01">
            </div>
            <button type="submit" class="btn agregar">Guardar</button>
        </form>
    </div>
</div>

<!-- Modal Editar Equipo -->
<div id="modalEditarEquipo" class="modal">
    <div class="modal-content">
        <span class="close" onclick="cerrarModalEditarEquipo()">&times;</span>
        <h2>Editar Equipo</h2>
        <form id="formEditarEquipo" onsubmit="editarEquipo(event)">
            <input type="hidden" name="id" id="editarEquipoId">
            <div class="form-group">
                <label>Nombre del Equipo:</label>
                <input type="text" name="nombre" id="editarEquipoNombre" required>
            </div>
            <div class="form-group">
                <label>Número de Dorsal:</label>
                <input type="number" name="dorsal" id="editarEquipoDorsal" required min="1" max="99">
            </div>
            <div class="form-group">
                <label>Precio ($):</label>
                <input type="number" name="precio" id="editarEquipoPrecio" step="0.01" required min="0.01">
            </div>
            <button type="submit" class="btn editar">Actualizar</button>
        </form>
    </div>
</div>

<script src="equipos.js"></script>
</body>
</html>