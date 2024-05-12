<?= $this->extend('validador-editor/template') ?>

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
            <p><strong>Usuario editor: </strong> <?= esc($noticia['nombre_autor']) ?></p>
            <a href="<?= base_url('publicadas-automaticamente');?>" class="btn btn-primary mb-5">Volver a noticias publicadas automaticamente</a>
            <a href="<?= base_url('publicadas-automaticamente/despublicar/'.$noticia['id']);?>" class="btn btn-warning mb-5" onclick="return confirm('Estas seguro de que deseas despublicar esta noticia?')">Despublicar</a>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>