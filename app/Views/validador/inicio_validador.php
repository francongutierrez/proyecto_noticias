<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Noticias</h1>
        </div>
    </div>

    <?php if (empty($noticias)) { ?>
        <div class="row">
            <div class="col">
                <p>No hay noticias vigentes.</p>
            </div>
        </div>
    <?php } else {
        $noticias_por_fila = 3;
        $chunks = array_chunk($noticias, $noticias_por_fila);
        foreach ($chunks as $chunk) { ?>
            <div class="row">
                <?php foreach ($chunk as $noticia) {
                    $descripcion = $noticia['descripcion'];
                    $limite_caracteres = 100;

                    if (strlen($descripcion) > $limite_caracteres) {
                        $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                    }
                    $fecha_formateada = DateTime::createFromFormat('Y-m-d', $noticia['fecha'])->format('d-m-Y');
                    $urlImagen = base_url('public/uploads/' . basename($noticia['imagen']));
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card" style="max-width: 300px;">
                            <img class="card-img-top" src="<?= $urlImagen ?>" alt="<?= $noticia['titulo'] ?>">

                            <div class="card-body">
                                <h5 class="card-title"><?= $noticia['titulo'] ?></h5>
                                <p class="card-text"><?= $descripcion ?></p>
                                <small class="text-muted"><?= $fecha_formateada ?></small>
                            </div>
                            <div class="card-footer">
                                <a href="<?= base_url('inicio/show/' . $noticia['id']) ?>" class="btn btn-primary btn-block">Ver más</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($currentPage > 1) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('Inicio/index') ?>?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                        <?php endif; ?>
                        <li class="page-item disabled"><span class="page-link">Página <?= $currentPage ?></span></li>
                        <?php if ($totalNoticias > ($currentPage * $perPage)) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('Inicio/index') ?>?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        </div>
    <?php } ?>
</div>








<?= $this->endSection('content') ?>
