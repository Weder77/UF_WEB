<?php
session_start();
require_once('assets/php/functions.php');

// User connected?
if (!isConnected()) {
	// If user isn't connected, redirection to the signup page
	header('Location:login.php');
} else {
	$id = $_SESSION['id'];
	if (isset($_GET['action']) && $_GET['action'] == 'logout') {
		logout();
	} else if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['statut']) && isset($_POST['primary-txt']) && isset($_POST['secondary-txt'])) {
		updateUser($id);
		updateAboutMe($id, $_FILES['profile_picture']);
	} else if (isset($_POST['project1']['name']) && isset($_POST['project1']['about']) && isset($_POST['project2']['name']) && isset($_POST['project2']['about']) && isset($_POST['project3']['name']) && isset($_POST['project3']['about'])) {
		updateProduction($id);
		if(isset($_FILES['upload_project1'])) {
			uploadPictureProduction($_FILES['upload_project1'], $_POST['id_proj1']);
		}
		if(isset($_FILES['upload_project2'])) {
			uploadPictureProduction($_FILES['upload_project2'], $_POST['id_proj2']);
		}
		if(isset($_FILES['upload_project3'])) {
			uploadPictureProduction($_FILES['upload_project3'], $_POST['id_proj3']);
		}
		header('Location:?change=ok');
		exit;
	} else if (isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['github']['pseudo']) && isset($_POST['github']['link']) && isset($_POST['linkedin']['pseudo']) && isset($_POST['linkedin']['link']) && isset($_POST['website']['name']) && isset($_POST['website']['link'])) {
		updateContact($id, $_FILES['upload_cv']);
	} else if (isset($_POST['new_comp']) && isset($_POST['new_pourc'])) {
		addSkill($id, $_POST['new_comp'], $_POST['new_pourc']);
	} else if (isset($_POST['id_skill']) && isset($_POST['comp']) && isset($_POST['pourc'])) {
		updateSkills($_POST['id_skill'], $_POST['comp'], $_POST['pourc']);
	} else if (isset($_POST['new_diplome']) && isset($_POST['new_school']) && isset($_POST['new_year_start']) && isset($_POST['new_year_end']) && isset($_POST['new_about_form'])) {
		addFormation($id, $_POST['new_diplome'], $_POST['new_school'], $_POST['new_year_start'], $_POST['new_year_end'], $_POST['new_about_form']);
	} else if (isset($_POST['diplome']) && isset($_POST['school']) && isset($_POST['year_start']) && isset($_POST['year_end']) && isset($_POST['about_form']) && isset($_POST['id_form'])) {
		updateFormation($id, $_POST['id_form'], $_POST['diplome'], $_POST['school'], $_POST['year_start'], $_POST['year_end'], $_POST['about_form']);
	}
}

?>

<!DOCTYPE html>

<html lang="fr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Administration - CV</title>
	<link rel="stylesheet" type="text/css" href="assets/css/base.css" />
	<link rel="stylesheet" type="text/css" href="assets/css/admin.css" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/admin.js" async></script>
	<title>Admin page</title>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="index?id=<?= $id ?>"><span>MON CV</span></a></li>
				<li><a href="messagerie.php"><span>MESSAGERIE</span></a></li>
				<li><a href="?action=logout"><span>DECONNEXION</span></a></li>
			</ul>
		</nav>
	</header>
	<main>
		<div class="container">
			<div class="item1 item">
				<h2>
					Informations :
				</h2>
				<form method="post" id="information-form" enctype="multipart/form-data" class="scroll">
					<?php $user = getValuesUser($id); ?>
					<input type="text" name="lastname" placeholder="Nom" value="<?= $user['lastname'] ?>" required>
					<input type="text" name="firstname" placeholder="Prénom" value="<?= $user['firstname'] ?>" required>
					<input type="text" name="statut" placeholder="Situation/Emploi actuel" value="<?= $user['statut'] ?>" required>
					<?php $user = getValuesAboutMe($id); ?>
					<input type="text" name="primary-txt" placeholder="Présentation principale" value="<?= $user['text_primary'] ?>" required>
					<textarea type="text" name="secondary-txt" placeholder="Présentation secondaire" rows="5" required><?= $user['text_secondary'] ?></textarea>
					<input type="file" name="profile_picture">
				</form>
				<div class="submit-button">
					<input type="submit" form="information-form" class="shw validate" value="Modifier" />
				</div>
			</div>
			<div class="item2 item">
				<h2>
					Contact :
				</h2>
				<div class="contact-container">
					<form method="post" id="contact-form" enctype="multipart/form-data" class="scroll">
						<?php
						$user = getValuesContact($id);
						?>
						<div class="item-contact">
							<input type="phone" name="phone" placeholder="Téléphone" value="<?= $user['phone'] ?>" class="left" required>
							<input type="email" name="email" placeholder="Email professionnel" value="<?= $user['mail'] ?>" class="right" required>
						</div>
						<div class="item-contact">
							<input type="text" name="linkedin[pseudo]" placeholder="Pseudo LinkedIn" value="<?= $user['linkedin_pseudo'] ?>" class="left" required>
							<input type="text" name="linkedin[link]" placeholder="Lien LinkedIn" value="<?= $user['linkedin_link'] ?>" class="right" required>
						</div>
						<div class="item-contact">
							<input type="text" name="github[pseudo]" placeholder="Pseudo GitHub" value="<?= $user['github_pseudo'] ?>" class="left" required>
							<input type="text" name="github[link]" placeholder="Lien GitHub" value="<?= $user['github_link'] ?>" class="right" required>
						</div>
						<div class="item-contact">
							<input type="text" name="website[name]" placeholder="Nom site" value="<?= $user['website_name'] ?>" class="left" required>
							<input type="text" name="website[link]" placeholder="Lien site" value="<?= $user['website_link'] ?>" class="right" required>
						</div>
						<input type="file" name="upload_cv">
					</form>
					<div class="submit-button">
						<input type="submit" form="contact-form" class="shw validate" value="Modifier" />
					</div>
				</div>
			</div>
			<div class="item3 item">
				<h2>Formations</h2>
				<?php $user = getValuesFormation($id); ?>
				<form method="post" id="formation-form" class="scroll">
					<?php for ($x = 0; $x < sizeof($user); $x++) : ?>
						<input type="hidden" name="id_form" value="<?= $user[$x]['id_form'] ?>" />
						<input type="text" name="diplome" placeholder="Nom diplome / qualification" value="<?= $user[$x]['name_form'] ?>" required />
						<input type="text" name="school" placeholder="Ecole / Institut" value="<?= $user[$x]['school'] ?>" required />
						<input type="number" name="year_start" placeholder="Année de début" value="<?= $user[$x]['date_start_form'] ?>" required />
						<input type="number" name="year_end" placeholder="Année de fin" value="<?= $user[$x]['date_end_form'] ?>" required />
						<textarea name="about_form" placeholder="Description du diplôme" required><?= $user[$x]['info_form'] ?></textarea>
						<?php if ($x != sizeof($user) - 1) : ?>
							<hr />
						<?php
					endif;
				endfor;
				?>
				</form>
				<div class="submit-button">
					<input type="submit" form="formation-form" class="modify shw validate" value="Modifier" />
					<button type="button" id="add-formation" class="add shw validate">+</button>
				</div>
			</div>
			<div class="item4 item">
				<h2>
					Compétences
				</h2>
				<form method="post" id="skills-form" class="scroll">
					<?php
					$user = getValuesSkill($id);
					for ($x = 0; $x < sizeof($user); $x++) : ?>
						<input type="hidden" name="id_skill[<?= $x ?>]" placeholder="Nom compétence" value="<?= $user[$x]['id_skill'] ?>" required />
						<input type="text" name="comp[<?= $x ?>]" placeholder="Nom compétence" value="<?= $user[$x]['name_skill'] ?>" class="skills-input-name" required />
						<input type="number" name="pourc[<?= $x ?>]" placeholder="%" value="<?= $user[$x]['percentage_skill'] ?>" class="skills-input-percentage" required />
						<!-- <button type="submit" name="delete[id]" value="<?= $user[$x]['id_skill'] ?>">Supprimer</button> -->
						<br />
					<?php endfor; ?>
				</form>
				<div class="submit-button">
					<input type="submit" form="skills-form" class="modify shw validate" value="Modifier" />
					<button type="button" id="add-skill" class="add shw validate">+</button>
				</div>
			</div>
			<div class="item5 item">
				<div class="project">
					<h2>
						Projets :
					</h2>
					<div class="projects-container">
						<?php $user = getValuesProduction($id); ?>
						<form method="post" id="project-form" enctype="multipart/form-data" class="scroll">
							<div class="project-container">
								<input type="hidden" name="id_proj1" value="<?= $user[0]['id_prod'] ?>">
								<input type="text" name="project1[name]" placeholder="Nom du projet" value="<?= $user[0]['name_prod'] ?>" required>
								<input type="text" name="project1[about]" placeholder="Courte description" value="<?= $user[0]['info_prod'] ?>" required>
								<input type="file" name="upload_project1">
							</div>
							<div class="project-container">
								<input type="hidden" name="id_proj2" value="<?= $user[1]['id_prod'] ?>">
								<input type="text" name="project2[name]" placeholder="Nom du projet" value="<?= $user[1]['name_prod'] ?>" required>
								<input type="text" name="project2[about]" placeholder="Courte description" value="<?= $user[1]['info_prod'] ?>" required>
								<input type="file" name="upload_project2">
							</div>
							<div class="project-container">
								<input type="hidden" name="id_proj3" value="<?= $user[2]['id_prod'] ?>">
								<input type="text" name="project3[name]" placeholder="Nom du projet" value="<?= $user[2]['name_prod'] ?>" required>
								<input type="text" name="project3[about]" placeholder="Courte description" value="<?= $user[2]['info_prod'] ?>" required>
								<input type="file" name="upload_project3">
							</div>
						</form>
						<div class="submit-button">
							<input type="submit" form="project-form" class="shw validate" value="Modifier" />
						</div>
					</div>
				</div>

			</div>
		</div>
	</main>
</body>
<!-- POPUP -->
<!-- ADD FORMATION -->
<div class="popup-close" id="popup-add-formation">
	<div class="popup-content">
		<button type="button" id="close-formation" class="close-popup add shw validate ">x</button>
		<h2>Ajouter une formations</h2>
		<form method="post" id="formation-form-popup" class="scroll">
			<input type="text" name="new_diplome" placeholder="Nom diplome / qualification" value="" required />
			<input type="text" name="new_school" placeholder="Ecole / Institut" value="" required />
			<input type="number" name="new_year_start" placeholder="Année de début" value="" required />
			<input type="number" name="new_year_end" placeholder="Année de fin" value="" required />
			<textarea name="new_about_form" placeholder="Description du diplôme" required></textarea>
		</form>
		<div class="submit-button-popup">
			<button type="submit" id="add-formation-popup" form="formation-form-popup" class="add shw validate">Ajouter</button>
		</div>
	</div>
</div>

<!-- ADD SKILL -->
<div class="popup-close" id="popup-add-skill">
	<div class="popup-content">
		<button type="button" id="close-skill" class="close-popup add shw validate ">x</button>
		<h2>Ajouter une compétences</h2>
		<form method="post" id="new_skills-form" class="scroll">
			<input type="text" name="new_comp" placeholder="Nom compétence" class="skills-input-name" required />
			<input type="number" name="new_pourc" placeholder="%" class="skills-input-percentage" required />
		</form>
		<div class="submit-button-popup">
			<button type="submit" id="add-skill" form="new_skills-form" class="add shw validate">Ajouter</button>
		</div>
	</div>
</div>

</html>