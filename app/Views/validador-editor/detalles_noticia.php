<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<!-- Vista: detalle_noticia.php -->
<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h2><?= esc($noticia['titulo']) ?></h2>
            <p><?= esc($noticia['descripcion']) ?></p>
            <p><strong>Estado:</strong> <?= esc($noticia['estado']) ?></p>
            <p><strong>Vigencia:</strong> <?= esc($noticia['vigencia']) ?></p>
            <p><strong>Fecha:</strong> <?= esc($noticia['fecha']) ?></p>
            <?php if (!empty($noticia['imagen'])): ?>
                <img src="<?= base_url('public/uploads/' . basename($noticia['imagen'])) ?>" style="max-width: 300px; display: block; margin: 0 auto;" alt="Imagen">
            <?php endif; ?>
            <a href="<?= base_url('mis-noticias');?>" class="btn btn-primary mt-5 mb-5">Volver a mis noticias</a>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>