<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1 class="mt-5 mb-4">Cambios de Noticias</h1>
    
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Título de la Noticia</th>
                    <th>Descripción del Cambio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Email del Realizador</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cambios as $cambio): ?>
                    <tr>
                        <td><?= esc(substr($cambio['titulo'], 0, 30)) . (strlen($cambio['titulo']) > 30 ? '...' : '') ?></td>
                        <td><?= esc($cambio['descripcion']) ?></td>
                        <td><?= date('d-m-Y', strtotime($cambio['fecha'])) ?></td>
                        <td><?= esc($cambio['hora']) ?></td>
                        <td><?= esc($cambio['email_realizador']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?= $pager->links() ?> <!-- Controles de paginación -->
</div>


<?= $this->endSection('content') ?>