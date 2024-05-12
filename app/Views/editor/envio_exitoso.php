<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>

    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Se ha guardado la noticia exitosamente</h1>
                <a href="<?= base_url('inicio') ?>" class="btn btn-primary">Volver a inicio</a>
                <a href="<?= base_url('MisBorradores/deshacer/'.$id) ?>" class="btn btn-warning">Deshacer</a>
                <div class="espacio-en-blanco"></div>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>