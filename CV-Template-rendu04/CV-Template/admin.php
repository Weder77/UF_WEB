<!DOCTYPE html>

<html lang="fr">
	<head>
		<meta charset="utf-8" />
		<title>Administration - CV</title>
		<link rel="stylesheet" type="text/css" href="assets/css/base.css" />
		<link rel="stylesheet" type="text/css" href="assets/css/admin.css" />
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
			<section id="accueil">
				<h2>Informations de base</h2>
				<form>
					<input type="text" name="name" placeholder="Prénom Nom" required /> <br />
					<input type="text" name="statut" placeholder="Statut actuel" required /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

			<section id="a-propos">
				<h2>Informations détaillées</h2>
				<form>
					<input type="text" name="pres-imp" placeholder="Présentation importante" required /> <br />
					<input type="text" name="pres-comp" placeholder="Informations complémentaires" required /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

			<section id="competences">
				<h2>Compétences</h2>
				<form>
					<input type="text" name="comp1" placeholder="Nom compétence" required />
					<input type="number" name="pourc1" placeholder="%" required /> <br />
					<br />
					<input type="text" name="comp2" placeholder="Nom compétence" required />
					<input type="number" name="pourc2" placeholder="%" required /> <br />
					<br />
					<input type="text" name="comp3" placeholder="Nom compétence" required />
					<input type="number" name="pourc3" placeholder="%" required /> <br />
					<br />
					<input type="text" name="comp4" placeholder="Nom compétence" required />
					<input type="number" name="pourc4" placeholder="%" required /> <br />
					<br />
					<input type="text" name="comp5" placeholder="Nom compétence" required />
					<input type="number" name="pourc5" placeholder="%" required /> <br />
					<br />
					<input type="text" name="comp6" placeholder="Nom compétence" required />
					<input type="number" name="pourc6" placeholder="%" required /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

			<section id="formations">
				<h2>Formations / Cursus</h2>
				<form>
					<input type="text" name="dip1" placeholder="Nom diplome / qualification" requiered /> <br />
					<input type="text" name="institut1" placeholder="Ecole / Institut" required />
					<input type="number" name="annee1" placeholder="Année" required /> <br />
					<br />
					<input type="text" name="dip2" placeholder="Nom diplome / qualification" requiered /> <br />
					<input type="text" name="institut2" placeholder="Ecole / Institut" required />
					<input type="number" name="annee2" placeholder="Année" required /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

			<section id="realisations">
				<h2>Réalisations / Projets</h2>
				<form>
					<input type="text" name="titre-rea1" placeholder="Nom Réalisation" required /> <br />
					<input type="text" name="desc-rea1" placeholder="Taches  / Rôle" required /> <br />
					<br />
					<input type="text" name="titre-rea2" placeholder="Nom Réalisation" required /> <br />
					<input type="text" name="desc-rea2" placeholder="Taches  / Rôle" required /> <br />
					<br />
					<input type="text" name="titre-rea3" placeholder="Nom Réalisation" required /> <br />
					<input type="text" name="desc-rea3" placeholder="Taches  / Rôle" required /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

			<section id="contacts">
				<h2>Contacts</h2>
				<form>
					<input type="phone" name="phone" placeholder="Numéro de téléphone" required> <br />
					<input type="mail" name="mail" placeholder="email" required /> <br />
					<input type="text" name="linkedin-pseudo" placeholder="Pseudo Linkedin" required />
					<input type="text" name="linkedin-lien" placeholder="Lien Linkedin" required/> <br />
					<input type="text" name="github-pseudo" placeholder="Pseudo GitHub" required />
					<input type="text" name="github-lien" placeholder="Lien GitHub" required/> <br />
					<input type="text" name="website-pseudo" placeholder="Nom du site" />
					<input type="text" name="website-lien" placeholder="Lien du site" /> <br />
					<button type="submit">Envoyer</button>
				</form>
			</section>

		</main>

	</body>
</html>