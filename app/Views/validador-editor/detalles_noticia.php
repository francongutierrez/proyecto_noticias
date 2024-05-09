<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

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

            <!-- Mostrar botones -->
            <?php if ($noticia['recien_creada'] == 1): ?>
                <?php if ($noticia['vigencia'] == 'activa'): ?>
                    <a href="<?= base_url('mis-noticias/desactivar/' . $noticia['id']) ?>" onclick="return confirm('¿Estás seguro de que deseas desactivar esta noticia?')" class="btn btn-danger">Desactivar</a>
                <?php elseif ($noticia['vigencia'] == 'desactiva'): ?>
                    <a href="<?= base_url('mis-noticias/activar/' . $noticia['id']) ?>" onclick="return confirm('¿Estás seguro de que deseas activar esta noticia?')" class="btn btn-success">Activar</a>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>


<?= $this->endSection('content') ?>