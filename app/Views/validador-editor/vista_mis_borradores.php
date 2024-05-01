<?= $this->extend('template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Mis borradores</h1>
        </div>
    </div>
    <?php if (empty($noticias)) { ?>
        <div class="row">
            <div class="col">
                <h3>No hay borradores guardados.</h3>
            </div>
        </div>
    <?php } ?>
</div>

<?= $this->endSection('content') ?>