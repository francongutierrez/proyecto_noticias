<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Noticias por validar</h1>
        </div>
    </div>
    <?php if (!empty($validar)): ?>
        <div class="row">
            <?php foreach ($validar as $noticia): ?>
                <!-- FORMATOS -->
                <?php
                    $descripcion = $noticia['descripcion'];
                    $limite_caracteres = 100;
                    
                    // Longitud de la descripción
                    if (strlen($descripcion) > $limite_caracteres) {
                        $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                    }
                    $fecha_formateada = DateTime::createFromFormat('Y-m-d', $noticia['fecha'])->format('d-m-Y');
                    // URL de la imagen
                    $urlImagen = base_url('public/uploads/' . basename($noticia['imagen']));
                ?>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <img src="<?= $urlImagen ?>" class="card-img-top" alt="Imagen">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($noticia['titulo']) ?></h5>
                            <p class="card-text"><?= esc($descripcion) ?></p>
                            <p class="card-text"><small class="text-muted">Fecha: <?= esc($fecha_formateada) ?></small></p>
                            <a href="<?= base_url('Validar/show/' . $noticia['id']) ?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="row">
            <?= $pager->links() ?>
        </div>
    <?php else: ?>
        <p>No hay noticias para validar.</p>
    <?php endif; ?>
</div>


<?= $this->endSection('content') ?>