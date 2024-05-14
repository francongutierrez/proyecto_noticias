<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <h1 class="mt-5">Mis noticias</h1>
    </div>
    <div class="row">
        <?php if (!empty($noticias)): ?>
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-12 mb-3" style="border: 1px solid #ccc; padding: 10px;">
                    <div class="row">
                        <div class="col-md-4">
                            <?php if (!empty($noticia['imagen'])): ?>
                                <img src="<?= base_url('public/uploads/' . basename($noticia['imagen'])) ?>" style="width: 100%;" alt="Imagen">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-8">
                            <h3 class="mt-3"><?= esc($noticia['titulo']) ?></h3>
                            <p><?= esc($noticia['descripcion']) ?></p>
                            <p><strong>Estado:</strong> <?= esc($noticia['estado']) ?></p>
                            <p><strong>Vigencia:</strong> <?= esc($noticia['vigencia']) ?></p>
                            <p><strong>Fecha:</strong> <?= (date('d-m-Y', strtotime($noticia['fecha']))) ?></p>
                            <a href="<?= base_url('mis-noticias/show/' . $noticia['id']) ?>" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-md-12">
                <nav aria-label="Pagination">
                    <ul class="pagination">
                        <?php if ($paginaActual > 1) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('mis-noticias?page_news=1') ?>">Primera</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url('mis-noticias?page_news=' . ($paginaActual - 1)) ?>">Anterior</a></li>
                        <?php endif; ?>
                        <li class="page-item disabled"><span class="page-link">Página <?= $paginaActual ?></span></li>
                        <?php if ($paginaActual < $totalPaginas) : ?>
                            <li class="page-item"><a class="page-link" href="<?= base_url('mis-noticias?page_news=' . ($paginaActual + 1)) ?>">Siguiente</a></li>
                            <li class="page-item"><a class="page-link" href="<?= base_url('mis-noticias?page_news=' . $totalPaginas) ?>">Última</a></li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <p>No hay noticias disponibles.</p>
            </div>
        <?php endif; ?>
    </div>
</div>





<?= $this->endSection('content') ?>