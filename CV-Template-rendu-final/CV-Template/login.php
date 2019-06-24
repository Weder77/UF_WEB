<?php
session_start();
require_once('assets/php/functions.php');

if (isConnected()) {
    header('Location:admin.php');
}

if (isset($_POST['email']) && isset($_POST['pass'])) {
    if (connection($_POST['email'], $_POST['pass'])) {
        header('Location:login.php?error=connected');
    } else {
        header('Location:login.php?error=wrong');
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion - CV</title>

    <link rel="stylesheet" type="text/css" href="assets/css/respon.css">
    <link rel="stylesheet" type="text/css" href="assets/css/base.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/login.css" />
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php"><span>RETOUR AU CV</span></a></li>
                <li><a href="login.php"><span>PERSONNALISER MON CV</span></a></li>
            </ul>
        </nav>
    </header>

    <?php
    if (isset($_GET['error'])) {
        if ($_GET['error'] == 'wrong') { ?>
            <div class="shw message">
                <div class="shw error">
                    Identifiant et/ou mot de passe invalide.
                </div>
            </div>
        <?php
    }
}
?>

    <div class="shw full-width aligned centered">
        <div class="shw segment login-div">
            <h2 class="shw title2">Connexion</h2>
            <form method="post">
                <div class="shw field">
                    <input type="text" name="email" placeholder="Email" class="shw input" required>
                </div>
                <div class="shw field">
                    <input type="password" name="pass" placeholder="Mot de passe" class="shw input" required>
                </div>
                <div class="shw field centered">
                    <button type="submit" class="shw validate">Valider</button>
                </div>
            </form>
            <div class="shw text-center link">
                Pas encore de compte ? <br />
                <a href="register.php">Inscris-toi !</a>
            </div>
        </div>
    </div>

</body>

</html>