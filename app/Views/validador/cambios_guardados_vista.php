<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Se han guardado los cambios</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <a href="<?= base_url('Validar/deshacer/') . $id ?>" class="btn btn-warning" onclick="return confirm('¿Está seguro de que desea deshacer los cambios?')">Deshacer los cambios</a>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>
