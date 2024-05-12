<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('public/styles/styles.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="icon" href="<?= base_url('public/img/logo.ico'); ?>" type="image/png">
    <title>Portal de noticias</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg open-sans-medium fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url('inicio'); ?>">
                    <img src="<?php echo base_url('public/img/logo.jpeg'); ?>" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('PublicarNoticia/new'); ?>">Publicar noticia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Validar'); ?>">Noticias a validar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Inicio/historial_de_cambios'); ?>">Historial de cambios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('MisBorradores'); ?>">Borradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('mis-noticias'); ?>">Mis noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('publicadas-automaticamente'); ?>">Noticias publicadas automaticamente</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url('Inicio/logout'); ?>">Cerrar sesión</a>
                        </li>                
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section class="main">
        <?= $this->renderSection('content'); ?>
    </section>
    <footer>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>