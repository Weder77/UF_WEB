<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Administration - CV</title>
		<link rel="stylesheet" type="text/css" href="assets/css/base.css" />
        <link rel="stylesheet" type="text/css" href="assets/css/admin.css" />
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css">
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li><a href="#accueil"><span>ACCUEIL</span></a></li>
					<li><a href="#a-propos"><span>A PROPOS</span></a></li>
					<li><a href="#competences"><span>COMPÉTENCES</span></a></li>
					<li><a href="#formations"><span>FORMATIONS</span></a></li>
					<li><a href="#realisations"><span>RÉALISATIONS</span></a></li>
					<li><a href="#contacts"><span>CONTACTS</span></a></li>
				</ul>
			</nav>
		</header>

		<main>
        <form class="ui form">
            <div class="field">
                <label>First Name</label>
                <input type="text" name="first-name" placeholder="First Name">
            </div>
            <div class="field">
                <label>Last Name</label>
                <input type="text" name="last-name" placeholder="Last Name">
            </div>
            <div class="field">
                <div class="ui checkbox">
                <input type="checkbox" tabindex="0" class="hidden">
                <label>I agree to the Terms and Conditions</label>
                </div>
            </div>
            <button class="ui button" type="submit">Submit</button>
        </form>

		</main>

	</body>
</html>