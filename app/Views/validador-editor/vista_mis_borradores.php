<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Mis borradores</h1>
        </div>
    </div>
    <?php if (!empty($borradores)): ?>
        <?php foreach ($borradores as $borrador): ?>
            <?php
                $descripcion = $borrador['descripcion'];
                $limite_caracteres = 100;
                
                if (strlen($descripcion) > $limite_caracteres) {
                    $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                }
                $fecha_formateada = DateTime::createFromFormat('Y-m-d', $borrador['fecha'])->format('d-m-Y');
                $urlImagen = base_url('public/uploads/' . basename($borrador['imagen']));
            ?>
            <div style="border: 1px solid #ccc; margin-bottom: 20px; padding: 10px;">
                <div class="row">
                    <div class="col-md-4">
                        <img src="<?= $urlImagen ?>" style="width: 100%;" alt="Imagen">
                    </div>
                    <div class="col-md-8">
                        <h5 class="card-title mt-5"><?= esc($borrador['titulo']) ?></h5>
                        <p class="card-text"><?= esc($descripcion) ?></p>
                        <p class="card-text"><small class="text-muted">Fecha: <?= esc($fecha_formateada) ?></small></p>
                        <a href="<?= base_url('MisBorradores/edit/' . $borrador['id']) ?>" class="btn btn-primary">Editar</a>
                        <a href="<?= base_url('MisBorradores/descartar/' . $borrador['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que quieres descartar esta noticia?')">Descartar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="row">
            <div class="col">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('MisBorradores') ?>?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                        <?php endif; ?>
                        <li class="page-item disabled"><span class="page-link">Página <?= $currentPage ?></span></li>
                        <?php if ($totalBorradores > ($currentPage * $perPage)) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('MisBorradores') ?>?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php else: ?>
        <p>No hay borradores disponibles.</p>
    <?php endif; ?>
</div>




<?= $this->endSection('content') ?>