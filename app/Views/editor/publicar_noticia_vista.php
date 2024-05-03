<?= $this->extend('editor/template') ?>

<?= $this->section('content') ?>


<div class="container">
    <div class="row">
        <div class="col">
            <h1>Publicar noticia:</h1>
            <?php if(session()->getFlashdata('validation_errors') !== null) { ?>
                <div class='alert alert-danger'>
                    <?php foreach (session()->getFlashdata('validation_errors') as $error) { ?>
                        <?= esc($error) ?><br>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="<?= base_url('PublicarNoticia/procesar') ?>" method="post" enctype="multipart/form-data" onsubmit="return confirm('¿Estás seguro de que quieres enviar el formulario?');">
                <label for="titulo" class="form-label mt-3">Título:</label><br>
                <input type="text" name="titulo" class="form-control" value="<?= set_value('titulo') ?>" required><br>

                <label for="descripcion" class="form-label mt-3">Descripción:</label><br>
                <textarea name="descripcion" class="form-control" required><?= set_value('descripcion') ?></textarea><br>

                <label for="categoria" class="form-label mt-3">Categoría:</label><br>
                <select name="categoria" class="form-control">
                    <option value="">Seleccione una opción</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                    <?php } ?>
                </select>

                <label for="fecha" class="form-label mt-3">Fecha:</label><br>
                <input type="date" id="fecha" name="fecha" class="form-control" min="2000-01-01" value="<?= set_value('fecha') ?>" required><br>
                <div class="custom-file">
                    <label class="custom-file-label" for="customFile">Elija un archivo:</label>
                    <input type="file" class="form-control" id="inputFile" name="imagen">
                </div>
                <div class="form-check mt-3">
                    <input class="form-check-input" type="radio" name="estado" id="borrador" value="borrador" required>
                    <label class="form-check-label" for="borrador">
                        Guardar como borrador
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="estado" id="enviar" value="validar">
                    <label class="form-check-label" for="validar">
                        Enviar para validar
                    </label>
                </div>
                <input type="submit" name="enviar" value="Enviar" class="btn btn-primary mt-3 mb-3">
            </form>
        </div>
    </div>
</div>








<script>
    // Obtener la fecha actual en el formato YYYY-MM-DD
    var fechaActual = new Date().toISOString().split('T')[0];
    
    // Establecer el valor máximo del campo de fecha como la fecha actual
    document.getElementById("fecha").max = fechaActual;
</script>

<?= $this->endSection('content') ?>