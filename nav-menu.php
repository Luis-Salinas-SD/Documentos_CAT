<nav class="nav">

    <ul class="list">

        <?php
        $tipo = $_SESSION['tipo_usuario'];
        if ($tipo == 1) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <?php echo $_SESSION['nombre']; ?>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_admon.php" class="nav__link">Inicio</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/up.svg" class="list__img">
                    <a href="form_nuevo.php" class="nav__link">Nuevo Registro</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/search.svg" class="list__img">
                    <a href="tabla_excel.php" class="nav__link">Buscar y Explorar</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 2) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <?php echo $_SESSION['nombre']; ?>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_super.php" class="nav__link">Inicio</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/search.svg" class="list__img">
                    <a href="tabla_excel_super.php" class="nav__link">Buscar y Explorar</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 3) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <?php echo $_SESSION['nombre']; ?>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_usu.php" class="nav__link">Inicio</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 4) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <?php echo $_SESSION['nombre']; ?>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_oficialia.php" class="nav__link">Inicio</a>
                </div>
            </li>
        <?php } ?>

        <li class="list__item">
            <div class="list__button">
                <img src="assets/icons/exit.svg" class="list__img">
                <a href="desconectar.php" class="nav__link text-danger">Cerrar Sesión</a>
            </div>
        </li>

    </ul>
</nav>