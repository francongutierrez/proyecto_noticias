<?= $this->extend('validador/template_validador') ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="row">
        <div class="col">
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
                                <td>
                                    <?= esc(substr($cambio['titulo'], 0, 30)) . (strlen($cambio['titulo']) > 30 ? '...' : '') ?>
                                    <?php if (strlen($cambio['titulo']) > 30): ?>
                                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#tituloModal<?= esc($cambio['id']) ?>">Ver más</button>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?= esc(substr($cambio['descripcion'], 0, 30)) . (strlen($cambio['descripcion']) > 30 ? '...' : '') ?>
                                    <?php if (strlen($cambio['descripcion']) > 30): ?>
                                        <button type="button" class="btn btn-link p-0" data-toggle="modal" data-target="#descripcionModal<?= esc($cambio['id']) ?>">Ver más</button>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d-m-Y', strtotime($cambio['fecha'])) ?></td>
                                <td><?= esc($cambio['hora']) ?></td>
                                <td><?= esc($cambio['email_realizador']) ?></td>
                            </tr>

                            <div class="modal fade" id="tituloModal<?= esc($cambio['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="tituloModalLabel<?= esc($cambio['id']) ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="tituloModalLabel<?= esc($cambio['id']) ?>">Título Completo</h5>
                                        </div>
                                        <div class="modal-body">
                                            <?= esc($cambio['titulo']) ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="descripcionModal<?= esc($cambio['id']) ?>" tabindex="-1" role="dialog" aria-labelledby="descripcionModalLabel<?= esc($cambio['id']) ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="descripcionModalLabel<?= esc($cambio['id']) ?>">Descripción del Cambio</h5>
                                        </div>
                                        <div class="modal-body">
                                            <?= esc($cambio['descripcion']) ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <nav aria-label="Pagination">
                <ul class="pagination">
                    <?php if ($currentPage > 1) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url('Inicio/historial_de_cambios') ?>?page=<?= $currentPage - 1 ?>">Anterior</a></li>
                    <?php endif; ?>
                    <li class="page-item disabled"><span class="page-link">Página <?= $currentPage ?></span></li>
                    <?php if ($totalCambios > ($currentPage * $perPage)) : ?>
                        <li class="page-item"><a class="page-link" href="<?= base_url('Inicio/historial_de_cambios') ?>?page=<?= $currentPage + 1 ?>">Siguiente</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<?= $this->endSection('content') ?>