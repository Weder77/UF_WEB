<?php 
    require_once('../assets/php/functions.php'); 

    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['verif-password']) && isset($_POST['lastname']) && isset($_POST['firstname'])) {
        register($_POST['email'], $_POST['password'], $_POST['verif-password'], $_POST['lastname'], $_POST['firstname']);
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Register</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.css" />
    <link rel="stylesheet" type="text/css" href="../assets/css/login.css" />
</head>

<body class="centered">
    <form class="ui form centered" method="post">
        <i class="fas fa-user fa-logo"></i>
        <div class="two fields">
            <div class="field">
                <input type="text" name="firstname" placeholder="First name">
            </div>
            <div class="field">
                    <input type="text" name="lastname" placeholder="Last name">
            </div>
        </div>
        <div class="field">
            <input type="text" name="email" placeholder="Email">
        </div>
        <div class="two fields">
            <div class="field">
                <input type="password" name="password" placeholder="Password">
            </div>
            <div class="field">
                    <input type="password" name="verif-password" placeholder="Verify password">
            </div>
        </div>
        <div class="field">
            Already an account? <a href="">Login here!</a>
        </div>
        <button class="ui button text-center" type="submit">Register</button>
    </form>
</body>
</html>