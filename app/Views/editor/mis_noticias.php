<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <h1 class="mt-5">Mis noticias</h1>
    </div>
    <div class="row">
        <?php if (!empty($noticias)): ?>
            <?php foreach ($noticias as $noticia): ?>
                <div class="col-md-12 mb-3" style="border: 1px solid #ccc; padding: 10px;">
                    <h3 class="mt-3"><?= esc($noticia['titulo']) ?></h3>
                    <p><?= esc($noticia['descripcion']) ?></p>
                    <?php if (!empty($noticia['imagen'])): ?>
                        <img src="<?= base_url('public/uploads/' . basename($noticia['imagen'])) ?>" style="max-width: 20rem; display: block; margin: 0 auto;" alt="Imagen">
                    <?php endif; ?>
                    <p><strong>Estado:</strong> <?= esc($noticia['estado']) ?></p>
                    <p><strong>Vigencia:</strong> <?= esc($noticia['vigencia']) ?></p>
                    <p><strong>Fecha:</strong> <?= esc($noticia['fecha']) ?></p>

                    <a href="<?= base_url('mis-noticias/show/' . $noticia['id']) ?>" class="btn btn-primary">Ver</a>
                </div>
            <?php endforeach; ?>
            <!-- Mostrar enlaces de paginación -->
            <div class="col-md-12">
                <?= $enlacesPaginacion->links() ?>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <p>No hay noticias disponibles.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?= $this->endSection('content') ?>