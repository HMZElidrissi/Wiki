<!DOCTYPE html>
<html data-bs-theme="light" lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>S'inscrire - Wiki™</title>
    <link rel="stylesheet" href="assets/dashboard/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/dashboard/fonts/fontawesome-all.min.css">
</head>

<body style="background-color: #2d2c38;">
<div class="container">
    <div class="card shadow-lg o-hidden border-0 my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-5 d-none d-lg-flex">
                    <div class="flex-grow-1 bg-register-image" style="background-image: url(&quot;assets/dashboard//img/cover.jpg&quot;);"></div>
                </div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h4 class="text-dark mb-4">Créez un compte !</h4>
                        </div>
                        <div id="error" class="mb-3 text-danger small"></div>
                        <form class="user" method="POST" onsubmit="return validateForm()">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <div class="mb-3">
                                <input class="form-control form-control-user" type="text" id="name" placeholder="Nom complet" name="name">
                            </div>
                            <div class="mb-3">
                                <input class="form-control form-control-user" type="email" id="email" placeholder="Adresse e-mail" name="email">
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input class="form-control form-control-user" type="password" id="password" placeholder="Mot de passe" name="password">
                                </div>
                                <div class="col-sm-6">
                                    <input class="form-control form-control-user" type="password" id="passwordRepeat" placeholder="Répéter le mot de passe" name="password_repeat">
                                </div>
                            </div>
                            <button class="btn btn-primary d-block btn-user w-100" type="submit">S'inscrire</button>
                            <hr>
                            <a class="btn btn-primary d-block btn-google btn-user w-100 mb-2" role="button">
                                <i class="fab fa-google"></i>&nbsp; S'inscrire avec Google
                            </a>
                            <a class="btn btn-primary d-block btn-facebook btn-user w-100" role="button">
                                <i class="fab fa-facebook-f"></i>&nbsp; S'inscrire avec Facebook
                            </a>
                            <hr>
                        </form>
                        <div class="text-center">
                            <a class="small" href="/login">Vous avez déjà un compte ? Connectez-vous !</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        let name = document.getElementById('name').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let passwordRepeat = document.getElementById('passwordRepeat').value;

        if (name === '' || email === '' || password === '' || passwordRepeat === '') {
            message('Veuillez remplir tous les champs !');
            return false;
        }

        let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(email)) {
            message("L'adresse e-mail n'est pas valide !");
            return false;
        }

        if (password !== passwordRepeat) {
            message('Les mots de passe ne correspondent pas !');
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