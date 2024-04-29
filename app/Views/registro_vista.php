<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=" <?= base_url("public/styles/login_style.css") ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container main">
        <?php if(session()->getFlashdata('error') != null) { ?>
                <div class='alert alert-danger'>
                    <?= session()->getFlashdata('error') ?>
            </div>

        <?php }       
        ?>


        <form action="<?= base_url('Auth/login')?>" method="POST">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Registrarse</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label mt-3">Usuario:</label>
                    <input type="text" name="usuario" class="form-control mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label mt-3">Contraseña:</label>
                    <input type="password" name="password" class="form-control mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="form-label mt-3">Imagen:</label>
                    <input type="img" name="img" class="form-control mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-light mt-3">Registrarse</button>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <?php if (isset($errors)): ?>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <div class="alert alert-danger">
                                <ul>
                                <?php foreach ($errors as $error): ?>
                                        <li><?= esc($error) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>
</html>

