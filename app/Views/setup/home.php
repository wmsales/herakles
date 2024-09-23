<?php include __DIR__ . '/../layout/header.php'; ?>


<div class="bg-dark w-100 vh-100 d-flex justify-content-center align-items-center">
    <div class="text-center">
        <p><span class="cinzel text-white">Aquilles</span></p>
        <p class="fs-6 text-white">Un Framework de PHP basado en MVC</p>
        <p class="fs-6 text-white">El propósito de este proyecto es facilitar a los desarrolladores el inicio de proyectos basados en el patrón MVC. <br>
            Puedes iniciar la configuración de tu proyecto desde un instalador super simple y amigable</p>
        <a class="btn btn-light fw-semibold mt-5 mb-5" href="/setup">Iniciar instalación</a>
        <p class="fs-2 fw-bold text-light a mb-5 text-sm">Versión: <?php echo $_ENV['APP_VERSION']; ?></p>
        <p class="text-light fs-6 mt-5 fw-light">PHP <?php echo phpversion(); ?> | Motor de base de datos <?php echo $_ENV['APP_DB_MOTOR']; ?></p>
    </div>
</div>


<?php include __DIR__ . '/../layout/footer.php'; ?>