<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1>Noticias</h1>
            <!-- <?php
                print_r($noticias);
                foreach ($noticias as $noticia) {
                    echo "Título: " . $noticia['titulo'] . "<br>";
                    echo "Descripción: " . $noticia['descripcion'] . "<br>";
                    echo "Categoría: " . $noticia['categoria_nombre'] . "<br>";
                    echo "Fecha: " . $noticia['fecha'] . "<br>";
                }

                // echo "Título: " . $noticias->titulo . "<br>";
                // echo "Descripción: " . $noticias->descripcion . "<br>";
                // echo "Categoría: " . $noticias->categoria . "<br>";
                // echo "Fecha: " . $noticias->fecha . "<br>";
            ?> -->
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card-group">
                <?php
                    print_r($noticias);
                    foreach ($noticias as $noticia) {
                        echo "Título: " . $noticia['titulo'] . "<br>";
                        echo "Descripción: " . $noticia['descripcion'] . "<br>";
                        echo "Categoría: " . $noticia['categoria_nombre'] . "<br>";
                        echo "Fecha: " . $noticia['fecha'] . "<br>";
                    }

                    // echo "Título: " . $noticias->titulo . "<br>";
                    // echo "Descripción: " . $noticias->descripcion . "<br>";
                    // echo "Categoría: " . $noticias->categoria . "<br>";
                    // echo "Fecha: " . $noticias->fecha . "<br>";
                ?>
                <div class="card">
                    <img src="<?php echo base_url('public/img/ejemplo.jpeg'); ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src="<?php echo base_url('public/img/ejemplo.jpeg'); ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <?php print_r($noticias); ?>
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
                <div class="card">
                    <img src="<?php echo base_url('public/img/ejemplo.jpeg'); ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
                    </div>
                    <div class="card-footer">
                        <small class="text-body-secondary">Last updated 3 mins ago</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>
