<?php include __DIR__ . '/../layout/header.php'; ?>





<div class="bg-dark w-100 vh-100 d-flex justify-content-center align-items-center">



    <div class="text-center">
        <p><span class="cinzel text-white">Herakles</span></p>
        <p class="fs-6 text-white">Micro-Framework para PHP</p>
        <?php if (isset($success)) {
        ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo $success; ?>
            </div>
            <a class="btn btn-light fw-semibold mt-5 mb-5" href="/">Regresar al inicio</a>
        <?php } else { ?>
            <form action="/setup" method="POST" class="container mt-5">
                <div class="mb-3">
                    <label for="env" class="form-label  text-light">Selecciona el entorno:</label>
                    <select name="env" class="form-select" required>
                        <option value="dev">Desarrollo</option>
                        <option value="prod">Producción</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="db_name" class="form-label text-light">Nombre de la base de datos:</label>
                    <input type="text" name="db_name" class="form-control" required autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="db_user" class="form-label text-light">Usuario:</label>
                    <input type="text" name="db_user" class="form-control" required autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="db_password" class="form-label text-light">Contraseña:</label>
                    <input type="password" name="db_password" class="form-control" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-light mt-3 fw-semibold">Instalar configuración</button>
            </form>
        <?php } ?>

        <p class="mt-5 mb-3 text-light fw-light">Recuerda que puedes modifica esto manualmente esto.</p>
        <p class="text-light fs-6 mt-5 fw-light">PHP <?php echo phpversion(); ?> | Motor de base de datos <?php echo $_ENV['APP_DB_MOTOR']; ?></p>
    </div>
</div>




<?php include __DIR__ . '/../layout/footer.php'; ?>