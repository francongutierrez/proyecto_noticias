<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('public/styles/styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('public/styles/publicar_noticia_style.css'); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg open-sans-medium fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="<?php echo base_url('public/img/logo.jpeg'); ?>" alt="Logo">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Publicar noticia</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Borradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Mis noticias</a>
                        </li>
                        <li class="nav-item d-block d-lg-none">
                            <a class="nav-link" href="#">Nuevo Item</a>
                        </li>
                        <li class="nav-item pfp d-none d-lg-block">
                            <img src="<?php echo base_url('public/img/pfp.jpg'); ?>" alt="">
                        </li>                    
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <section id="mainPublicarNoticia">
        <div class="container">
            <div class="row">
                <div class="col">

                    <?php
                        array_unshift($categorias, ['nombre' => 'Seleccione una opción']);

                        $nombresCategorias = array_column($categorias, 'nombre');
                        $categoriasDropdown = array_combine($nombresCategorias, $nombresCategorias);

                        echo form_open(base_url('publicar_noticia/procesar')); 
                        echo form_label('Título:', 'título', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_input(array('name'=>'titulo', 'class'=>'form-control')) . '<br>';
                        echo form_label('Descripción:', 'descripcion', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_textarea(array('name'=>'descripcion', 'class'=>'form-control')) . '<br>';
                        echo form_label('Categoria:', 'categoria', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_dropdown('categoria', $categoriasDropdown, '', 'class="form-control"') . '<br>';
                        echo form_label('Fecha:', 'fecha', array('class'=>'form-label mt-3')) . '<br>';
                        echo form_input(array('name'=>'fecha', 'type'=>'date', 'class'=>'form-control')) . '<br>';
                        echo form_submit('enviar','Enviar', 'class="btn btn-primary mt-3 mb-3"');
                        echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h6>Centro de la pagina</h6>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>