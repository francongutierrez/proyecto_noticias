<?= $this->extend('validador-editor/template_validador') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col-md-12 mt-5">
            <h2><?= esc($noticia['titulo']) ?></h2>
            <?php if (!empty($noticia['imagen'])): ?>
                <div class="text-center">
                    <img src="<?= base_url('public/uploads/' . basename($noticia['imagen'])) ?>" class="img-fluid mt-3 mb-4" alt="Imagen">
                </div>
            <?php endif; ?>
            <p><?= esc($noticia['descripcion']) ?></p>
            <p><strong>Fecha:</strong> <?= esc(date('d-m-Y', strtotime($noticia['fecha']))) ?></p>
            <p><strong>Categoría:</strong> <?= esc($noticia['nombre_categoria']) ?></p>
            <a href="<?= base_url('inicio');?>" class="btn btn-primary mb-5">Volver a inicio</a>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>
