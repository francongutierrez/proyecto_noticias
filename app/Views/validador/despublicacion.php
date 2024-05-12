<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-3">Noticia despublicada</h1>
            <a class="btn btn-primary" href="<?= base_url('publicadas-automaticamente') ?>">Volver a noticias publicadas automaticamente</a>
            <a class="btn btn-warning" href="<?= base_url('publicadas-automaticamente/deshacer/'.$id)?>" onclick="return confirm('Estas seguro de deshacer los cambios?')">Deshacer</a>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>