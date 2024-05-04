<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h1>Mis borradores</h1>
        </div>
    </div>
    <?php if (!empty($borradores)): ?>
        <h2>Borradores</h2>
        <div class="row">
            <?php foreach ($borradores as $borrador): ?>
                <!-- FORMATOS -->
                <?php
                        $descripcion = $borrador['descripcion'];
                        $limite_caracteres = 100;
                        
                        // Longitud de la descripción
                        if (strlen($descripcion) > $limite_caracteres) {
                            $descripcion = substr($descripcion, 0, $limite_caracteres) . '...';
                        }
                        $fecha_formateada = DateTime::createFromFormat('Y-m-d', $borrador['fecha'])->format('d-m-Y');
                        // URL de la imagen
                        $urlImagen = base_url('public/uploads/' . basename($borrador['imagen']));

                ?>

                <div class="col-md-6">
                    <div class="card mb-3">
                        <img src="<?= $urlImagen ?>" class="card-img-top" alt="Imagen">
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($borrador['titulo']) ?></h5>

                            <p class="card-text"><?= esc($borrador['descripcion']) ?></p>
                            <p class="card-text"><small class="text-muted">Fecha: <?= esc($fecha_formateada) ?></small></p>
                            <a href="<?= base_url('MisBorradores/edit/' . $borrador['id']) ?>" class="btn btn-primary">Editar</a>
                            <a href="<?= base_url('MisBorradores/descartar/' . $borrador['id']) ?>" class="btn btn-danger" onclick="return confirm('¿Está seguro de que quieres descartar esta noticia? Esta acción no se puede deshacer')">Descartar</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No hay borradores disponibles.</p>
    <?php endif; ?>
</div>

<?= $this->endSection('content') ?>