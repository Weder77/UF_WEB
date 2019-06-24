<?php
session_start();
require_once('assets/php/functions.php');

if (isConnected()) {
	header('Location:admin.php');
}

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['pass']) && isset($_POST['verif-pass']) && isset($_POST['email'])) {
	register($_POST['email'], $_POST['pass'], $_POST['verif-pass'], $_POST['lastname'], $_POST['firstname']);
}
?>

<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Inscription - CV</title>
	<link rel="stylesheet" type="text/css" href="assets/css/respon.css">
	<link rel="stylesheet" type="text/css" href="assets/css/base.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/login.css" />
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="index.php"><span>RETOUR AU CV</span></a></li>
				<li><a href="admin.php"><span>PERSONNALISER MON CV</span></a></li>
			</ul>
		</nav>
	</header>

	<div class="shw full-width aligned centered">
		<div class="shw segment login-div">
			<h2 class="shw title2">Inscription</h2>
			<form method="post">
				<div class="shw fields">
					<input type="text" name="lastname" placeholder="Nom" class="shw input" required>
					<input type="text" name="firstname" placeholder="Prénom" class="shw input" required>
				</div>
				<div class="shw field">
					<input type="text" name="email" placeholder="Email" class="shw input" required>
				</div>
				<div class="shw field">
					<input type="password" name="pass" placeholder="Mot de passe" class="shw input" required>
				</div>
				<div class="shw field">
					<input type="password" name="verif-pass" placeholder="Vérifier le mot de passe" class="shw input" required>
				</div>
				<div class="shw field centered">
					<button type="submit" class="shw validate">S'inscrire</button>
				</div>
			</form>
			<div class="shw text-center link">
				Déjà inscris ?
				<a href="login.php">Connecte-toi !</a>
			</div>
		</div>
	</div>

</body>

</html>