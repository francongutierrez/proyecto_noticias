<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Noticias publicadas automaticamente</h1>
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
</div>

<nav class="navbar fixed-bottom navbar-light bg-light">
    <div class="container">
        <div class="col">
            <?= $pager->links() ?>
        </div>
    </div>
</nav>


<?= $this->endSection('content') ?>

