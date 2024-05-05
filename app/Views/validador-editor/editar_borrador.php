<?= $this->extend('validador-editor/template') ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2>Editar Borrador</h2>
            <form action="<?= base_url('MisBorradores/update/' . $borrador['id']) ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $borrador['id'] ?>">
                
                <label for="titulo" class="form-label mt-3">Título:</label><br>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo', $borrador['titulo']) ?>" required><br>

                <label for="descripcion" class="form-label mt-3">Descripción:</label><br>
                <textarea name="descripcion" class="form-control" required><?= set_value('descripcion', $borrador['descripcion']) ?></textarea><br>

                <label for="categoria" class="form-label mt-3">Categoría:</label><br>
                <select name="categoria" class="form-control">
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= $categoria['id'] ?>" <?= $categoria['id'] == $borrador['categoria'] ? 'selected' : '' ?>>
                        <?= $categoria['nombre'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

                <label for="fecha" class="form-label mt-3">Fecha:</label><br>
                <input type="date" id="fecha" name="fecha" class="form-control" min="2000-01-01" value="<?= set_value('fecha', $borrador['fecha']) ?>" required><br>
                
                <div class="custom-file mt-3">
                    <label class="custom-file-label" for="imagen">Elija un archivo:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                </div>

                <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" name="estado" id="borrador" value="borrador" <?= $borrador['estado'] == 'borrador' ? 'checked' : '' ?> required>
                    <label class="form-check-label" for="borrador">
                        Guardar como borrador
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="enviar" value="validar" <?= $borrador['estado'] == 'validar' ? 'checked' : '' ?>>
                    <label class="form-check-label" for="validar">
                        Enviar para validar
                    </label>
                </div>

                <input type="submit" name="enviar" value="Actualizar" class="btn btn-primary mt-3 mb-3">
            </form>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>