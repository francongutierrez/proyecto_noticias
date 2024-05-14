<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>


<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h1>El borrador ha sido descartado</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="d-flex mt-3">
                <a href="<?= base_url('MisBorradores') ?>" class="btn btn-primary me-2">Volver a mis borradores</a>
                <a href="<?= base_url('MisBorradores/deshacerDescarte/' . $id) ?>" class="btn btn-warning">Deshacer</a>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection('content') ?>