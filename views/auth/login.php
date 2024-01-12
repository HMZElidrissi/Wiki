<!DOCTYPE html>
<html data-bs-theme="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Se connecter - Wiki™</title>
    <link rel="stylesheet" href="assets/dashboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/dashboard/fonts/fontawesome-all.min.css">
</head>

<body style="background-color: #2d2c38;">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9 col-lg-12 col-xl-10">
            <div class="card shadow-lg o-hidden border-0 my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-flex">
                            <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/dashboard/img/cover.jpg&quot;);"></div>
                        </div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h4 class="text-dark mb-4">Bienvenue à nouveau !</h4>
                                </div>
                                <div id="error" class="mb-3 text-danger small"></div>
                                <form class="user" method="POST" action="/login">
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                                    <div class="mb-3">
                                        <?php if (isset($_SESSION['errors']['user'])): ?>
                                            <p class="mb-3 text-danger small"><?= $_SESSION['errors']['user'] ?></p>
                                        <?php endif; ?>
                                        <input class="form-control form-control-user" type="email" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Entrez l'adresse e-mail..." name="email">
                                    </div>
                                    <div class="mb-3">
                                        <?php if (isset($_SESSION['errors']['password'])): ?>
                                            <p class="text-danger"><?= $_SESSION['errors']['password'] ?></p>
                                        <?php endif; ?>
                                        <input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Mot de passe" name="password">
                                    </div>
                                    <div class="mb-3">
                                        <div class="custom-control custom-checkbox small">
                                            <div class="form-check">
                                                <input class="form-check-input custom-control-input" type="checkbox" id="formCheck-1">
                                                <label class="form-check-label custom-control-label" for="formCheck-1">Se souvenir de moi</label>
                                            </div>
                                        </div>
                                    </div><button class="btn btn-primary d-block btn-user w-100" type="submit">Se connecter</button>
                                    <hr>
                                    <a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button">
                                        <i class="fab fa-google"></i>&nbsp; Se connecter avec Google
                                    </a>
                                    <a class="btn btn-primary d-block btn-facebook btn-user w-100" role="button">
                                        <i class="fab fa-facebook-f"></i>&nbsp; Se connecter avec Facebook
                                    </a>
                                    <hr>
                                </form>
                                <div class="text-center"><a class="small" href="#">Mot de passe oublié ?</a></div>
                                <div class="text-center"><a class="small" href="/register">Créer un compte !</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if (email === '' || password === '') {
            message('Veuillez remplir tous les champs !');
            return false;
        }

        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            message("L'adresse e-mail n'est pas valide !");
            return false;
        }

        return true;
    }

    function message(m) {
        document.getElementById("error").innerHTML = m;
    }
</script>
<script src="assets/dashboard/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/dashboard/js/bs-init.js"></script>
<script src="assets/dashboard/js/theme.js"></script>
</body>

</html>