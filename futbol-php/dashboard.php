<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Estadísticas</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="sidebar.css">
    <link rel="stylesheet" href="dashboard-stats.css">
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
                <a href="dashboard.php" class="active">
                    <span class="sidebar-icon">📊</span>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="index.php">
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
            <h1>📊 Dashboard - Estadísticas Generales</h1>

            <!-- Tarjetas de resumen -->
            <div class="stats-cards">
                <div class="stat-card card-blue">
                    <div class="stat-icon">👤</div>
                    <div class="stat-info">
                        <h3 id="totalJugadores">0</h3>
                        <p>Total Jugadores</p>
                    </div>
                </div>

                <div class="stat-card card-green">
                    <div class="stat-icon">👕</div>
                    <div class="stat-info">
                        <h3 id="totalEquipos">0</h3>
                        <p>Total Equipos</p>
                    </div>
                </div>

                <div class="stat-card card-orange">
                    <div class="stat-icon">📅</div>
                    <div class="stat-info">
                        <h3 id="edadPromedio">0</h3>
                        <p>Edad Promedio</p>
                    </div>
                </div>

                <div class="stat-card card-purple">
                    <div class="stat-icon">💰</div>
                    <div class="stat-info">
                        <h3 id="precioPromedio">$0</h3>
                        <p>Precio Promedio</p>
                    </div>
                </div>
            </div>

            <!-- Gráficos y tablas -->
            <div class="charts-grid">
                
                <!-- Jugadores por posición -->
                <div class="chart-container">
                    <h2>Jugadores por Posición</h2>
                    <div class="chart-content">
                        <canvas id="chartPorPosicion"></canvas>
                    </div>
                </div>

                <!-- Jugadores por equipo -->
                <div class="chart-container">
                    <h2>Jugadores por Equipo</h2>
                    <div class="chart-content">
                        <canvas id="chartPorEquipo"></canvas>
                    </div>
                </div>

                <!-- Top equipos más caros -->
                <div class="chart-container">
                    <h2>Top 3 Camisetas Más Caras</h2>
                    <div class="top-list" id="topEquipos">
                        <p>Cargando...</p>
                    </div>
                </div>

                <!-- Información adicional -->
                <div class="chart-container">
                    <h2>Información Adicional</h2>
                    <div class="info-list">
                        <div class="info-item">
                            <span class="info-label">Jugadores sin equipo:</span>
                            <span class="info-value" id="jugadoresSinEquipo">0</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Total de registros:</span>
                            <span class="info-value" id="totalRegistros">0</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="dashboard-stats.js"></script>
</body>
</html>