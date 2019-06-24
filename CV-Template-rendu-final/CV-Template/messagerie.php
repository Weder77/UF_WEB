<?php
session_start();
require_once('assets/php/functions.php');

// User connected?
if (!isConnected()) {
    // If user isn't connected, redirection to the signup page
    header('Location:login.php');
} else {
    $id = $_SESSION['id'];
    $user = getValuesUser($id);
    $messages = getMessages($id);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Messagerie</title>
    <link rel="stylesheet" type="text/css" href="assets/css/base.css">
    <link rel="stylesheet" type="text/css" href="assets/css/respond.css">
    <link rel="stylesheet" type="text/css" href="assets/css/messagerie.css">
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>

<body>
    <main>
        <header>
            <a href="admin.php">
                <img src="images/back.png">
            </a>
            <h1>Messagerie de <?= $user['firstname'] . ' ' . $user['lastname'] ?></h1>
        </header>
        <?php
        if (sizeof($messages) == 0) : ?>
            <div class="error">Aucun message.</div>
        <?php
        else :
            echo "<div class='message-container'>";
            for ($x = 0; $x < sizeof($messages); $x++) : ?>
                <div class="message">
                    <H3>Objet : <?= $messages[$x]['subject_mess'] ?></H3>
                    <p>
                        <?= nl2br($messages[$x]['txt_mess']) ?>
                    </p>
                    <span class="email">Message de : <?= $messages[$x]['name_from'] ?> (<?= $messages[$x]['mail_from'] ?>)</span> <br />
                </div>
            <?php
        endfor;
    endif;
    ?>
        </div>
    </main>
</body>

</html>