<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>


<div class="container mt-5">
    <div class="row">
        <div class="col">
            <h1>Se ha deshecho el descarte del borrador</h1>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="d-flex mt-3">
                <a href="<?= base_url('MisBorradores') ?>" class="btn btn-primary">Volver a Mis Borradores</a>
            </div>
        </div>
    </div>

</div>


<?= $this->endSection('content') ?>