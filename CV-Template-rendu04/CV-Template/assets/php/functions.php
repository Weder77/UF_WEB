<?php
function connectDB() {
    // Connect to DataBase
    $pdo = new PDO('mysql:host=localhost:3306;dbname=cv','root','');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function createUser() {
    if (isset($_POST['firstname']))
    $pdo = connectDB();

    $pass = password_hash($pass, PASSWORD_DEFAULT);

    $add = $pdo->prepare('INSERT INTO user');
}

function connection($mail, $pass) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $query->execute(array(
        'email' => $mail ));
    $result = $query->fetch();

    if (password_verify($pass, $result['pass'])) {
        session_start();
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $result['id_user'];

        header('Location:profile.php');
    } else {
        header('Location:login.php?error=yes');
    }
}

function register($mail, $pass, $verifpass, $lastname, $firstname) {
    if ($verifpass == $pass) {
        $pdo = connectDB();

        // Verify if email hasn't exist
        $query = $pdo->prepare('SELECT email FROM user WHERE email = :email');
        $query->execute(array(
            'email' => $mail
        ));

        $result = $query->fetch();

        if ($result['email'] == $mail) {
            echo 'Email already use';
        }
        else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $add = $pdo->prepare('INSERT INTO user VALUES(NULL, :email, :pass, :lastname, :firstname, NULL, NULL, NULL)');
            $add->execute(array(
                'email' => $mail,
                'pass' => $pass,
                'lastname' => $lastname,
                'firstname' => $firstname
            ));
        } 
    }
    else {
        echo 'Bad password';
    }
}

function getValuesUser($id) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM user WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

function getValuesContact($id) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM contact WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

function getValuesSkill($id) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM skill WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

function updateUser($id) {
    $pdo = connectDB();

    $update = $pdo->prepare('UPDATE user SET lastname = :lastname, firstname = :firstname, statut = :statut WHERE id_user = :id');
    $update->execute(array(
        'lastname' => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'statut' => $_POST['statut'],
        'id' => $_SESSION['id']
    ));

    header('Location:profile.php?change=ok');
}