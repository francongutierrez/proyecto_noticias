<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Vista de la noticia</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header"><?= $noticia['titulo'] ?></div>

                <div class="card-body">
                    <?php
                        // URL de la imagen
                        $urlImagen = base_url('public/uploads/' . basename($noticia['imagen']));
                    ?>
                    <img class="card-img-top" src="<?= $urlImagen ?>" alt="<?= $noticia['titulo'] ?>">

                    <p><strong>Descripción:</strong> <?= $noticia['descripcion'] ?></p>
                    <p><strong>Categoría:</strong> <?= $noticia['nombre_categoria'] ?></p>
                    <p><strong>Fecha:</strong> <?= $noticia['fecha'] ?></p>
                    <p><strong>Autor:</strong> <?= $noticia['nombre_autor'] ?></p>
                    <a href="<?= base_url('Validar/publicar/') . $noticia['id'] ?>" class="btn btn-success" onclick="return confirm('¿Está seguro de que desea publicar esta noticia?')">Publicar</a>
                    <a href=" <?= base_url('Validar/enviar-correccion/') . $noticia['id'] ?>" class="btn btn-warning" onclick="return confirm('¿Está seguro de que desea enviar esta noticia a corrección?')">Enviar a corrección</a>
                    <a href=" <?= base_url('Validar/rechazar/') . $noticia['id'] ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que desea rechazar esta noticia?')">Rechazar</a>
                </div>
            </div>
        </div>
    </div>
</div>



<?= $this->endSection('content') ?>