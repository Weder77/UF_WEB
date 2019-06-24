<?php
require_once('assets/php/functions.php');

if (!isset($_GET['id'])) {
	$id = 0;
} else {
	$id = $_GET['id'];
	// ENVOI DU MESSAGE
	if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
		sendMessage($id, $_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message']);
	}
}
?>

<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<?php if ($id == 0) : ?>
		<title>Prénom Nom - CV</title>
	<?php else :
	$user = getValuesUser($id); ?>
		<title><?= mb_strtoupper(htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname'])) ?> - CV</title>
	<?php endif; ?>
	<link rel="stylesheet" type="text/css" href="assets/css/base.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/timeline.css">
	<link rel="stylesheet" type="text/css" href="assets/css/animations.css">
	<link rel="stylesheet" type="text/css" href="assets/css/respon.css">
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/scripts.js" async></script>
	<script type="text/javascript" src="assets/js/jquery-animation.js" async></script>
	<script src="https://kit.fontawesome.com/70551be3aa.js" async></script>
</head>

<body>
	<div class="edit-cv-button">
		<?php if ($id == 0) : ?>
		<?php 
			echo "<a class='edit-cv' href='register.php'>Créer mon CV</a>";
		else :
			echo "<a class='edit-cv' href='admin.php'>Modifier mon CV</a>";
		endif; ?>
	</div>

	<div id="burger" class="animOff" onclick="burger()">
		<div class="brg-barres animOffBarre1" id="barre1"></div>
		<div class="brg-barres animOffBarre2" id="barre2"></div>
		<div class="brg-barres animOffBarre3" id="barre3"></div>
	</div>

	<main>
		<section id="accueil">
			<div id="accueilPres">
				<span class="name"><?php if ($id == 0) : ?>
						PRÉNOM NOM
					<?php
				else :
					echo mb_strtoupper($user['firstname'] . ' ' . $user['lastname']);
				endif; ?>
				</span> <br />
				<span class="statut"><?php if ($id == 0) : ?>
						STATUT / EMPLOI <?php
								else :
									echo mb_strtoupper($user['statut']);
								endif; ?></span>
			</div>
		</section>

		<header>
			<nav>
				<ul>
					<li><a href="#accueil" id="headerAccueil" class="header-a-hover"><span>ACCUEIL</span></a></li>
					<li><a href="#apropos" id="headerApropos"><span>A PROPOS</span></a></li>
					<li><a href="#competences" id="headerCompetences"><span>COMPÉTENCES</span></a></li>
					<li><a href="#formations" id="headerFormations"><span>FORMATIONS</span></a></li>
					<li><a href="#realisations" id="headerRealisations"><span>RÉALISATIONS</span></a></li>
					<li><a href="#contact" id="headerContact"><span>CONTACT</span></a></li>
				</ul>
			</nav>
		</header>

		<section id="apropos">
			<h2 id="aproposH2">A PROPOS DE MOI</h2>
			<div id="presentation">
				<?php if ($id == 0) : ?>
					<img src="images/avatar/default_profile.jpg" />
					<p class="pres-txt" id="aproposTextPres">
						<span class="infos-importantes">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						</span> <br />
						<br />
						Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iure aliquam iusto et culpa labore sapiente
						dolorum omnis, quibusdam totam officiis voluptas minus nesciunt veniam,
						quod, libero earum quas ullam blanditiis?
					</p>
				<?php
			else :
				$user = getValuesAboutMe($id); ?>
					<img src="images/avatar/<?= htmlspecialchars($user['profile_picture']) ?>" />
					<p class="pres-txt" id="aproposTextPres">
						<span class="infos-importantes">
							<?= htmlspecialchars($user['text_primary']) ?>
						</span> <br />
						<br />
						<?= htmlspecialchars($user['text_secondary']) ?>
					</p>
				<?php endif; ?>
			</div>
		</section>

		<section id="competences">
			<h2 id="competencesH2">COMPÉTENCES</h2>
			<article>
				<?php if ($id == 0) :
					for ($i = 1; $i <= 6; $i++) : ?>
						<div class="comp">
							<span class="nom-comp">Compétence</span>
							<div class="skills">
								<div class="barre-prog">
									<div class="progression" id="prog<?= $i ?>">
										<!--div class="prog-anim"></div-->
									</div>
								</div>
								<span class="pourcentage" id="pourcentage<?= $i ?>">60%</span>
							</div>
						</div>
					<?php
				endfor;
			else :
				$user =  getValuesSkill($id);
				for ($x = 0; $x < sizeof($user); $x++) : ?>
						<div class="comp">
							<span class="nom-comp"><?= htmlspecialchars($user[$x]['name_skill']) ?></span>
							<div class="skills">
								<div class="barre-prog">
									<div class="progression" id="prog<?= $x + 1 ?>">
										<!--div class="prog-anim"></div-->
									</div>
								</div>
								<span class="pourcentage" id="pourcentage<?= $x + 1 ?>"><?= htmlspecialchars($user[$x]['percentage_skill']) ?></span>
							</div>
						</div>
					<?php
				endfor;
			endif;
			?>
			</article>
		</section>

		<section id="formations">
			<h2 id="formationsH2">FORMATIONS</h2>
			<div id="form-timeline">
				<div class="timeline" id="formationsVisible">
					<?php
					if ($id == 0) : ?>
						<div class="container left-init" id="formationContainerLeft1">
							<div class="content">
								<h3>Master en Latin</h3>
								<h4>Insitut de lettre<span class="color">,</span> 2010 - 2013</h4>
								<ul>
									<li>Lorem ispum</li>
									<li>consectetur adipisicing elit, sed do eiusmod</li>
									<li>Dolor sit amet</li>
									<li>Incididunt ut labore</li>
								</ul>
							</div>
						</div>

						<div class="container right-init" id="formationContainerRight1">
							<div class="content">
								<h3>BAC culture escargots</h3>
								<h4>Lycée Baveux<span class="color">,</span> 2008 - 2010</h4>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
									tempor dolore magna aliqua. Ut enim ad minim veniam.
								</p>
							</div>
						</div>
					<?php
				else :
					$user = getValuesFormation($id);
					for ($x = 0; $x < sizeof($user); $x++) :
						if ($x % 2 == 0) {
							$sens[0] = "Left" . ($x + 1);
							$sens[1] = "left";
						} else {
							$sens[0] = "Right" . ($x + 1);
							$sens[1] = "right";
						} ?>
							<div class="container <?= $sens[1] ?>-init" id="formationContainer<?= $sens[0] ?>">
								<div class="content">
									<h3><?= htmlspecialchars($user[$x]['name_form']) ?></h3>
									<h4><?= htmlspecialchars($user[$x]['school']) ?><span class="color">,</span> <?= htmlspecialchars($user[$x]['date_start_form']) ?> - <?= htmlspecialchars($user[$x]['date_end_form']) ?></h4>
									<?= htmlspecialchars($user[$x]['info_form']) ?>
								</div>
							</div>
						<?php
					endfor;
				endif;
				?>
				</div>
			</div>
			</div>
		</section>

		<section id="realisations">
			<h2 id="realisationsH2">RÉALISATIONS</h2>
			<article>
				<?php
				if ($id == 0) : ?>
					<div class="rea" id="rea-1">
						<h4>PROJET</h4>
						<div class="rea-description">
							Lorem ipsum dolor sit amet
						</div>
					</div>

					<div class="rea" id="rea-2">
						<h4>PROJET</h4>
						<div class="rea-description">
							Incididunt ut labore et
						</div>
					</div>

					<div class="rea" id="rea-3">
						<h4>PROJET</h4>
						<div class="rea-description">
							Excepteur sint occaecat cupidatat non proident
						</div>
					</div>

				<?php
			else :
				$user = getValuesProduction($id);
				for ($x = 0; $x < 3; $x++) : ?>
						<div class="rea" id="rea-<?= $x + 1 ?>" style="background-image: url('images/productions/<?= $user[$x]['picture_rea'] ?>');">
							<h4><?= htmlspecialchars($user[$x]['name_prod']) ?></h4>
							<div class="rea-description">
								<?= htmlspecialchars($user[$x]['info_prod']) ?>
							</div>
						</div>
					<?php
				endfor;
			endif;
			?>
			</article>
		</section>

		<section id="contact">
			<h2 id="contactH2">CONTACT</h2>
			<article>
				<div id="cont-left">
					<form method="POST">
						<input type="text" name="name" placeholder=" NOM *" class="inp-2" id="form-name" required />
						<input type="mail" name="email" placeholder=" Email *" class="inp-2" required /> <br />
						<!-- <input type="text" name="entreprise" placeholder=" Société / Entreprise" class="inp-1" /> <br /> -->
						<input type="text" name="subject" placeholder=" Sujet *" class="inp-1" required /> <br />
						<textarea name="message" placeholder=" Message *"></textarea> <br />
						<?php
						if ($id > 0) : ?>
							<input type="hidden" name="id_mail" value="<?= $id ?>" />
						<?php endif; ?>
						<button type="submit" name="Envoyer">Envoyer</button>
					</form>
				</div>

				<div id="cont-right">
					<?php if ($id == 0) : ?>
						<div>
							<span class="name">Prénom Nom</span> <br />

							<div id="contact-info">
								<i class="fas fa-graduation-cap"></i>
								<span id="contact-statut">Statut</span>
							</div>
						</div>

						<div class="contact-infos">
							<i class="fas fa-phone-alt"></i>
							<span class="phone-number">06.XX.XX.XX.XX</span>
						</div>

						<div class="contact-infos">
							<i class="fas fa-envelope"></i>
							<span class="email">prenom.nom@mail.fr</span>
						</div>

						<div class="contact-infos">
							<i class="fab fa-linkedin"></i>
							<a href="https://www.linkedin.com/" target="_blank" title="Mon profil Linkedin" class="lien-linkedin">/Linkedin</a>
						</div>

						<div class="contact-infos">
							<i class="fab fa-github"></i>
							<a href="https://github.com" target="_blank" class="lien-github" title="Mon Github personnel">@GitHub</a>
						</div>

						<div class="contact-infos">
							<i class="fab fa-chrome"></i>
							<a href="https://www.google.fr" target="_blank" class="lien-website" title="Site de critique">Google.fr</a>
						</div>

					<?php
				else :
					$user = getValuesUser($id);
					?>
						<div>
							<span class="name"><?= mb_strtoupper(htmlspecialchars($user['firstname']) . ' ' . htmlspecialchars($user['lastname'])) ?></span> <br />

							<div id="contact-info">
								<i class="fas fa-graduation-cap"></i>
								<span id="contact-statut"><?= mb_strtoupper(htmlspecialchars($user['statut'])) ?></span>
							</div>
						</div>

						<?php $user = getValuesContact($id); ?>

						<div class="contact-infos">
							<i class="fas fa-phone-alt"></i>
							<span class="phone-number"><?= htmlspecialchars($user['phone']) ?></span>
						</div>

						<div class="contact-infos">
							<i class="fas fa-envelope"></i>
							<span class="email"><?= htmlspecialchars($user['mail']) ?></span>
						</div>

						<div class="contact-infos">
							<i class="fab fa-linkedin"></i>
							<a href="<?= htmlspecialchars($user['linkedin_link']) ?>" target="_blank" title="Mon profil Linkedin" class="lien-linkedin">/<?= htmlspecialchars($user['linkedin_pseudo']) ?></a>
						</div>

						<div class="contact-infos">
							<i class="fab fa-github"></i>
							<a href="<?= htmlspecialchars($user['github_link']) ?>" target="_blank" class="lien-github" title="Mon Github personnel">@<?= htmlspecialchars($user['github_pseudo']) ?></a>
						</div>

						<div class="contact-infos">
							<i class="fab fa-chrome"></i>
							<a href="<?= htmlspecialchars($user['website_link']) ?>" target="_blank" class="lien-website" title="Mon site personnel"><?= htmlspecialchars($user['website_name']) ?></a>
						</div>
					<?php endif; ?>
				</div>
			</article>
		</section>

		<section id="dl-cv">
			<?php if ($id == 0) : ?>
				<a href="cv-pdf/1.pdf" target="_blank">
				<?php else : ?>
					<a href="cv-pdf/<?= $user['url_cv_pdf'] ?>" target="_blank">
					<?php endif; ?>
					<button>TÉLÉCHARGER MON CV</button></a>
		</section>
	</main>

	<footer>
		<div>
			© Template développé par <a href="index.php?id=1">Grelet Théo</a> - Tous droits réservés
		</div>
	</footer>
</body>

</html>