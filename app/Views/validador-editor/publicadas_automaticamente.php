<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Noticias publicadas automáticamente</h1>
            <?php if (!empty($noticias)): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th></th> <!-- Boton -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($noticias as $noticia): ?>
                            <tr>
                                <td class="font-weight-bold"><?= esc($noticia['titulo']) ?></td>
                                <td>
                                    <a href="<?= base_url('publicadas-automaticamente/show/' . $noticia['id']) ?>" class="btn btn-primary">Ver detalles</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="mt-3">No se encontraron noticias publicadas automáticamente.</p>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <nav aria-label="Pagination">
                <ul class="pagination">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url('publicadas-automaticamente/index') ?>?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                    <?php endif; ?>
                    <li class="page-item disabled"><span class="page-link">Página <?= $currentPage ?></span></li>
                    <?php if ($totalNoticias > ($currentPage * $perPage)) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url('publicadas-automaticamente/index') ?>?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>







<?= $this->endSection('content') ?>

