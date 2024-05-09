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
        <form action="<?= base_url('Registro/registrarUsuario')?>" method="POST">
            <div class="row">
                <div class="col">
                    <h1 class="text-center">Registrarse</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email" class="form-label mt-3">E-mail:</label>
                    <input type="text" id="email" name="email" value="<?= old('email') ?>" class="form-control mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="password" class="form-label mt-3">Contraseña:</label>
                    <input type="password" id="password" name="password" value="<?= old('password') ?>" class="form-control mt-3">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 text-center mt-3">
                    <?php if (session()->has('errors')) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach (session('errors') as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    <?php endif ?>  
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <button type="submit" class="btn btn-primary mt-3">Registrarse</button>
                </div>
            </div>
        </form>
        <div class="row">
        <div class="col text-center">
                    <a href="<?= base_url('Auth') ?>" class="btn btn-secondary mt-3">Volver a iniciar sesión</a>
                </div>
            </div>
    </div>
</body>
</html>

