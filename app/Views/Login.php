<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Perlawatan GKI Delima</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="<?= base_url('assets/images/logo-gki.png'); ?>" />
    <!--===============================================================================================-->
    <link rel=" stylesheet" type="text/css" href="<?= base_url('/assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css'); ?>" />
    <!--===============================================================================================-->
    <link rel=" stylesheet" type="text/css" href="<?= base_url('/assets/vendor/animate/animate.css'); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="<?= base_url('/assets/vendor/css-hamburgers/hamburgers.min.css'); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/vendor/select2/select2.min.css'); ?>" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/styles/util-login.css'); ?>" />
    <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/styles/main-login.css'); ?>" />
    <!--===============================================================================================-->
</head>

<body>
    <div class="limiter">
        <div class="container-login100">
            <!-- Tampilkan pesan error jika login gagal -->
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="<?= base_url('/assets/images/logo-gki.png'); ?> " alt="IMG" width="250" height="250" />
                </div>
                <form class="login100-form validate-form" method="POST" action="<?= base_url('/login/login'); ?>">
                    <span class="login100-form-title"> Login </span>
                    <?php if (session()->has('error')): ?>
                        <div class="alert alert-danger text-center" role="alert">
                            <?= session('error') ?>
                        </div>
                    <?php endif ?>
                    <div class="wrap-input100 validate-input" data-validate="Username is required">
                        <input class="input100" type="text" name="username" placeholder="Username" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="password" placeholder="Password" />
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?= base_url('/assets/vendor/jquery/jquery-3.2.1.min.js'); ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('/assets/vendor/bootstrap/js/popper.js'); ?>"></script>
    <script src=" <?= base_url('/assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <!--===============================================================================================-->
    <script src="<?= base_url('/assets/vendor/select2/select2.min.js'); ?>"></script>
    <!--===============================================================================================-->
    <script src=" <?= base_url('/assets/vendor/tilt/tilt.jquery.min.js'); ?>"></script>
    <script>
        $(".js-tilt").tilt({
            scale: 1.1,
        });
    </script>
    <!--===============================================================================================-->
    <script src="<?= base_url('/assets/script/main-login.js'); ?>"></script>
</body>

</html>