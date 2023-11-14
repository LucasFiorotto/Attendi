<nav class="navbar navbar-expand-sm bg-info border-bottom border-5 border-secondary">
    <div class="container-fluid">
        <a class="navbar-brand" href="../Inicio/index.php"><img src="../bootstrap/icons/Attendi_logo.png" width="64" height="64"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse ms-2" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../ABM_Alumno/index.php"><p class="h5 m-2">ALUMNOS</p></a>
                </li>
          
                <li class="nav-item dropdown">
                    <a class="nav-link" role="button" data-bs-toggle="dropdown"><p class="h5 m-2">ASISTENCIAS</p></a>
                    <ul class="dropdown-menu border border-2 border-dark">
                        <li><a class="dropdown-item h5 text-center" href="../Toma_Asistencia/gestion_asistencias.php">GESTIONAR</a></li>
                        <li><a class="dropdown-item h5 text-center" href="../Toma_Asistencia/index.php">TOMAR</a></li>
                    </ul>
                </li>
            </ul>
        </div>

        <ul class="navbar-nav justify-content-end">
            <li class="nav-item me-2" style="display:flex; align-items:center;">
                <a href="../Configuracion/index.php"><img src="../bootstrap/icons/gear-fill.svg" role="img" width="38" height="38"></a>
            </li>
        </ul>
    </div>
</nav>