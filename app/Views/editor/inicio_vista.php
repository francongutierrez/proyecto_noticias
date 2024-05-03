<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Noticias</h1>
        </div>
    </div>

    <?php if (empty($noticias)) { ?>
        <div class="row">
            <div class="col">
                <p>No hay noticias vigentes.</p>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <div class="col">
                <div class="card-group d-flex flex-wrap">
                    <?php 
                    $noticias = array_reverse($noticias);
                    foreach ($noticias as $noticia) { 
                        $descripcion = $noticia['descripcion'];
                        $limite_caracteres = 100;
                        
                        // Longitud de la descripción
                        if (strlen($descripcion) > $limite_caracteres) {
                            $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                        }
                        $fecha_formateada = DateTime::createFromFormat('Y-m-d', $noticia['fecha'])->format('d-m-Y');
                        // URL de la imagen
                        $urlImagen = base_url('public/uploads/' . basename($noticia['imagen']));
                        ?>
    
                        <div class="card" style="max-width: 300px; margin-right: 20px; margin-bottom: 20px;">
                            <img class="card-img-top" src="<?= $urlImagen ?>" alt="<?= $noticia['titulo'] ?>">
                            
                            <div class="card-body">
                                <h5 class="card-title"><?= $noticia['titulo'] ?></h5>
                                <p class="card-text"><?= $descripcion ?></p>
                                <small class="text-body-secondary"><?= $fecha_formateada ?></small>
                            </div>
                        </div>
    
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>

    <div>
        <?= $pager->links() ?>
    </div>
</div>





<?= $this->endSection('content') ?>
