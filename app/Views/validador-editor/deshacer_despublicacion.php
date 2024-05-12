<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Se deshicieron los cambios</h1>
            <a class="btn btn-primary" href="<?= base_url('publicadas-automaticamente') ?>">Volver a noticias publicadas automaticamente</a>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>