<?php 
    session_start();

    if (isset($_SESSION['connected']) && $_SESSION['connected'] == true) {
        require_once('../assets/php/functions.php'); 
        $user = getValuesUser($_SESSION['id']);

        if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['statut'])) {
            updateUser($_SESSION['id']);
        }
    } 
    else {
        header('Location:login.php?connected=false');
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/base.css" />
</head>
<body>
    <div class="ui vertical menu sticky">
        <a href="" class="item">
            See my CV
        </a>
        <a href="" class="item">
            Logout
        </a>
    </div>

    <main class="ui container">
        <h2>User informations</h2>
        <form class="ui form segment" method="post">
            <div class="2 fields">
                <div class="field">
                    <label>First Name</label>
                    <input type="text" name="firstname" placeholder="First Name" value="<?= $user['firstname'] ?>" required>
                </div>
                <div class="field">
                    <label>Last Name</label>
                    <input type="text" name="lastname" placeholder="Last Name" value="<?= $user['lastname'] ?>" required>
                </div>
            </div>
            <div class="field">
                <label>Statut</label>
                <input type="text" name="statut" placeholder="Statut" value="<?php if(isset($user['statut'])) {echo $user['statut'];} ?>" required>
            </div>
            <button class="ui button" type="submit">Update</button>
        </form>

        <h2>Contact informations</h2>
        <form class="ui form segment" method="post">
        <div class="field">
                <label>Email</label>
                <input type="text" name="email" placeholder="Email" value="<?php if(isset($contact['statut'])) {echo $user['statut'];} ?>" required>
            </div>
            <div class="field">
                <label>LinkedIn</label>
                <div class="ui left icon input" data-children-count="1">
                    <input type="text" name="linkedin" placeholder="Link LinkedIn" value="<?php if(isset($contact['statut'])) {echo $user['statut'];} ?>" required>
                    <i class="linkedin icon"></i>
                </div>
            </div>
            <div class="field">
                <label>GitHub</label>
                <div class="ui left icon input" data-children-count="1">
                    <input type="text" name="github" placeholder="Link GitHub" value="<?php if(isset($contact['statut'])) {echo $user['statut'];} ?>" required>
                    <i class="github icon"></i>
                </div>
            </div>
            <button class="ui button" type="submit">Update</button>
        </form>
    </main>
</body>
</html>