<nav class="nav mostrar-menu" id="menu">

    <ul class="list">

        <?php
        $tipo = $_SESSION['tipo_usuario'];
        if ($tipo == 1) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="txt-vino p-2">
                        <b><?php echo $_SESSION['nombre']; ?></b>
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
                    <a href="tabla_excel.php" class="nav__link">Buscar y Exportar</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 2) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <b><?php echo $_SESSION['nombre']; ?></b>
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
                    <a href="tabla_excel_super.php" class="nav__link">Buscar y Exportar</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/book.svg" class="list__img">
                    <a href="./Manuales/supervisor.pdf" class="nav__link" target="_blank">Manual</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 3) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <b><?php echo $_SESSION['nombre']; ?></b>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_usu.php" class="nav__link">Inicio</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/book.svg" class="list__img">
                    <a href="./Manuales/analista-3.pdf" class="nav__link" target="_blank">Manual</a>
                </div>
            </li>
        <?php
        } else if ($tipo == 4) {
        ?>
            <li class="list__item">
                <div class="list__button mb-3">
                    <span class="text-secondary p-2">
                        <b><?php echo $_SESSION['nombre']; ?></b>
                    </span>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/home.svg" class="list__img">
                    <a href="tabla_oficialia.php" class="nav__link">Inicio</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/add.svg" class="list__img">
                    <a href="form_nuevo_ofi.php" class="nav__link">Registrar Nuevo</a>
                </div>
            </li>
            <li class="list__item">
                <div class="list__button">
                    <img src="assets/icons/book.svg" class="list__img">
                    <a href="./Manuales/oficialia-4.pdf" class="nav__link" target="_blank">Manual</a>
                </div>
            </li>
        <?php } ?>

        <li class="list__item">
            <div class="list__button">
                <img src="assets/icons/exit.svg" class="list__img">
                <a href="desconectar.php" class="nav__link">Cerrar Sesión</a>
            </div>
        </li>

        <li class="list__item pointer">
            <div class="list__button" id="cerrar">
                <a class="nav__link">
                    <img src="assets/icons/menu-left.svg">
                </a>
            </div>
        </li>

    </ul>
</nav>

<div class="mostrar pt-1 pointer shadow" id="mostrar">
    <img src="assets/icons/menu-right.svg" >
</div>