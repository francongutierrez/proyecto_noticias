<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>


    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Noticias</h1>
                <h1><?php echo $id?></h1>
                <h1><?php echo print_r($registro)?></h1>
                <a href="<?= base_url('MisBorradores/deshacer/'.$id) ?>" class="btn btn-warning">Deshacer</a>
            </div>
        </div>
    </div>

<?= $this->endSection('content') ?>