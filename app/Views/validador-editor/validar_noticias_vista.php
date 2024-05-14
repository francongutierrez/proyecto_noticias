<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Noticias por validar</h1>
        </div>
    </div>
    <?php if (!empty($validar)): ?>
        <?php foreach ($validar as $noticia): ?>
            <!-- FORMATOS -->
            <?php
                $descripcion = $noticia['descripcion'];
                $limite_caracteres = 100;
                
                if (strlen($descripcion) > $limite_caracteres) {
                    $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                }
                $fecha_formateada = DateTime::createFromFormat('Y-m-d', $noticia['fecha'])->format('d-m-Y');
                $urlImagen = base_url('public/uploads/' . basename($noticia['imagen']));
            ?>

            <div class="row mb-3">
                <div class="col-md-3">
                    <img src="<?= $urlImagen ?>" class="img-fluid" alt="Imagen">
                </div>
                <div class="col-md-9">
                    <h5><?= esc($noticia['titulo']) ?></h5>
                    <p><?= esc($descripcion) ?></p>
                    <p><small class="text-muted">Fecha: <?= esc($fecha_formateada) ?></small></p>
                    <a href="<?= base_url('Validar/show/' . $noticia['id']) ?>" class="btn btn-primary">Ver</a>
                </div>
            </div>
            <hr>
        <?php endforeach; ?>
        <div class="row">
            <div class="col">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('Validar/index') ?>?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                        <?php endif; ?>
                        <li class="page-item disabled"><span class="page-link">Página <?= $currentPage ?></span></li>
                        <?php if ($totalNoticias > ($currentPage * $perPage)) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('Validar/index') ?>?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php else: ?>
        <p>No hay noticias para validar.</p>
    <?php endif; ?>
</div>




<?= $this->endSection('content') ?>