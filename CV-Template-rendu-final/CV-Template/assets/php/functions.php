<?php
// Connect to DataBase (Windows)
function connectDB()
{
    $pdo = new PDO('mysql:host=localhost:3306;dbname=cv', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

// Connect to DataBase (macOS)
// function connectDB() {
//     $pdo = new PDO('mysql:host=localhost:8889;dbname=madle', 'root', 'root');
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     return $pdo;
// }

//***********************//
//        ACCOUNT        //
//***********************//
// Create user
function register($mail, $pass, $verifpass, $lastname, $firstname)
{
    // If 2 passwords are same
    if ($verifpass == $pass) {
        $pdo = connectDB();

        // Verify if email hasn't exist
        $query = $pdo->prepare('SELECT email FROM user WHERE email = :email');
        $query->execute(array(
            'email' => $mail
        ));

        $result = $query->fetch();

        // If email already used
        if ($result['email'] == $mail) {
            header('Location:register.php?error=email');
        } else {
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $add = $pdo->prepare('INSERT INTO user VALUES(NULL, :email, :pass, :lastname, :firstname, NULL)');
            $add->execute(array(
                'email' => $mail,
                'pass' => $pass,
                'lastname' => $lastname,
                'firstname' => $firstname
            ));

            // Select the user ID
            $select = $pdo->prepare('SELECT id_user FROM user WHERE email = :email');
            $select->execute(array(
                'email' => $mail
            ));
            $id_user = $select->fetch();
            $select->closeCursor();

            // Create ref for About me
            $add = $pdo->prepare('INSERT INTO about_me VALUES(NULL, "default_profile.jpg", "Je suis un développeur / une coiffeuse...", "Je suis spécialisé dans le web/les dégradés...", :id_user)');
            $add->execute(array(
                'id_user' => $id_user[0]
            ));
            $add->closeCursor();

            // Create ref for Contact
            $add = $pdo->prepare('INSERT INTO contact VALUES(NULL, "mail", "0000000000", "Pseudo LinkedIn", "https://fr.linkedin.com/", "Pseudo GitHub", "https://github.com/", "Site Web", "www.google.fr", NULL, :id_user)');
            $add->execute(array(
                'id_user' => $id_user[0]
            ));
            $add->closeCursor();

            // Create 3 projects
            $add = $pdo->prepare('INSERT INTO production VALUES(NULL, "Projet", "Description", "default.jpg", :id_user)');
            for ($i=0; $i < 3; $i++) { 
                $add->execute(array(
                    'id_user' => $id_user[0]
                ));
                $add->closeCursor();
            }

            header('Location:login.php?register=ok');
        }
    } else {
        header('Location:register.php?error=passwords');
    }
}

// Connect user
function connection($mail, $pass)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM user WHERE email = :email');
    $query->execute(array(
        'email' => $mail
    ));
    $result = $query->fetch();

    if (password_verify($pass, $result['pass'])) {
        $_SESSION['connected'] = true;
        $_SESSION['id'] = $result['id_user'];
        return true;
    } else {
        return false;
    }
}

// Disconnect user
function logout()
{
    session_destroy();
    header('Location:index.php');
}

// User connected?
function isConnected()
{
    if (isset($_SESSION['connected'])) {
        return true;
    } else {
        return false;
    }
}

//************************//
//       GET VALUES       //
//************************//
function getValuesUser($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM user WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

function getValuesAboutMe($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM about_me WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

function getValuesSkill($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM skill WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetchAll();
    return $values;
}

function getValuesFormation($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM formation WHERE id_user = ? ORDER BY date_end_form DESC');
    $query->execute(array($id));
    $values = $query->fetchAll();
    return $values;
}

function getValuesProduction($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM production WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetchAll();
    return $values;
}

function getValuesContact($id)
{
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM contact WHERE id_user = ?');
    $query->execute(array($id));
    $values = $query->fetch();
    return $values;
}

//*************************//
//        UPDATE CV        //
//*************************//
function updateUser($id)
{
    $pdo = connectDB();

    $update = $pdo->prepare('UPDATE user SET lastname = :lastname, firstname = :firstname, statut = :statut WHERE id_user = :id');
    $update->execute(array(
        'lastname' => $_POST['lastname'],
        'firstname' => $_POST['firstname'],
        'statut' => $_POST['statut'],
        'id' => $id
    ));
}

function updateAboutMe($id, $picture) {
    $pdo = connectDB();

    if($picture['error'] == UPLOAD_ERR_OK) {
        $valid_ext = ['image/png', 'image/jpg', 'image/jpeg'];
        if(in_array($picture['type'], $valid_ext)) {
            uploadProfilePicture($picture, $id);
        }
    }

    $update = $pdo->prepare('UPDATE about_me SET text_primary = :text_primary, text_secondary = :text_secondary WHERE id_user = :id');
    $update->execute(array(
        'text_primary' => $_POST['primary-txt'],
        'text_secondary' => $_POST['secondary-txt'],
        'id' => $id
    ));

    header('Location:admin.php?change=ok');
    exit;
}

function updateProduction($id) {
    $pdo = connectDB();

    $projet1 = $_POST['project1'];
    $projet2 = $_POST['project2'];
    $projet3 = $_POST['project3'];
    $projets = [$projet1, $projet2, $projet3];

    for ($i=0; $i < 3; $i++) { 
        $update = $pdo->prepare('UPDATE production SET name_prod = :name_prod, info_prod = :info_prod WHERE id_user = :id_user AND id_prod = :id_prod');
        $update->execute(array(
            'name_prod' => $projets[$i]['name'],
            'info_prod' => $projets[$i]['about'],
            'id_user' => $id,
            'id_prod' => $id + $i
        ));
    }

    // header('Location:admin.php?change=ok');
    // exit;
}

function updateFormation($id_user, $id_form, $name, $school, $year_start, $year_end, $about) {
    $pdo = connectDB();

    $update = $pdo->prepare('UPDATE formation SET name_form=:name_form, school=:school, date_start_form=:date_start_form, date_end_form=:date_end_form, info_form=:info_form WHERE id_user = :id_user AND id_form = :id_form');
    $update->execute(array(
        'name_form' => $name,
        'school' => $school,
        'date_start_form' => $year_start,
        'date_end_form' => $year_end,
        'info_form' => $about,
        'id_user' => $id_user,
        'id_form' => $id_form
    ));

    header('Location:admin.php?change=ok');
    exit;
}

function updateSkills($id_skill, $competences, $percentages) {
    $pdo = connectDB();

    for ($x=0; $x < sizeof($competences); $x++) { 
        $update = $pdo->prepare('UPDATE skill SET name_skill=:name_skill, percentage_skill=:percentage_skill WHERE id_skill=:id_skill');
        $update->execute(array(
            'name_skill' => $competences[$x],
            'percentage_skill' => $percentages[$x],
            'id_skill' => $id_skill[$x]
        ));
    }

    header('Location:admin.php?change=ok');
    exit;
}

function updateContact($id, $cv)
{
    $pdo = connectDB();

    if(strlen($_POST['phone']) <= 13) {
        $update = $pdo->prepare('UPDATE contact SET mail = :mail, phone = :phone, linkedin_pseudo = :linkedin_pseudo, linkedin_link = :linkedin_link, github_pseudo = :github_pseudo, github_link = :github_link, website_name = :website_name, website_link = :website_link, url_cv_pdf = :url_cv WHERE id_user = :id');
        $update->execute(array(
            'mail' => $_POST['email'],
            'phone' => $_POST['phone'],
            'linkedin_pseudo' => $_POST['linkedin']['pseudo'],
            'linkedin_link' => $_POST['linkedin']['link'],
            'github_pseudo' => $_POST['github']['pseudo'],
            'github_link' => $_POST['github']['link'],
            'website_name' => $_POST['website']['name'],
            'website_link' => $_POST['website']['link'],
            'url_cv' => NULL,
            'id' => $id
        ));

        if($cv['error'] == UPLOAD_ERR_OK) {
            if($cv['type'] == 'application/pdf') {
                uploadCV($cv, $id);
            }
        }
    
        header('Location:admin.php?change=ok');
        exit;
    }

}

//*************************//
//       ADD SECTION       //
//*************************//
function addSkill($id, $name, $percentage) {
    $pdo = connectDB();

    $add = $pdo->prepare('INSERT INTO skill VALUES(NULL, :name_skill, :percentage_skill, :id_user)');
    $add->execute(array(
        'name_skill' => $name,
        'percentage_skill' => $percentage,
        'id_user' => $id
    ));

    header('Location:admin.php?add=ok');
    exit;
}

function addFormation($id, $name, $school, $date_start, $date_end, $about) {
    $pdo = connectDB();

    $add = $pdo->prepare('INSERT INTO formation VALUES(NULL, :name_form, :school, :date_start_form, :date_end_form, :info_form, :id_user)');
    $add->execute(array(
        'name_form' => $name,
        'school' => $school,
        'date_start_form' => $date_start,
        'date_end_form' => $date_end,
        'info_form' => $about,
        'id_user' => $id
    ));

    header('Location:admin.php?add=ok');
    exit;
}

// ADD MESSAGE TO DATABASE
function sendMessage($id_user, $name, $from, $subject, $message) {
    $pdo = connectDB();

    $add = $pdo->prepare('INSERT INTO messages VALUES(NULL, :name_from, :mail_from, :subject_mess, :txt_mess, :id_user)');
    $add->execute(array(
        'name_from' => $name,
        'mail_from' => $from,
        'subject_mess' => $subject,
        'txt_mess' => $message,
        'id_user' => $id_user
    ));

    header('Location:index.php?id='. $id_user .'&message=send#contact');
    exit;
}

// GET MESSAGES FROM DATABASE
function getMessages($id) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT * FROM messages WHERE id_user = ?');
    $query->execute(array($id));

    $messages = $query->fetchAll();

    return $messages;
}

// DOESN'T WORK IN LOCAL
// SEND MAIL TO USER
function sendMail($id, $name, $from, $subject, $message) {
    $pdo = connectDB();

    $query = $pdo->prepare('SELECT mail FROM contact WHERE id_user = :id_user');
    $query->execute(array(
        'id_user' => $id
    ));

    $to = $query->fetch();

    $headers = "Message de :" . $name . '(' . $from . ')';

    mail($to,$subject,$message, $headers);

    header('Location:index.php?id='. $id .'&message=send#contact');
    exit;
}


//************************//
//     DELETE SECTION     //
//************************//
function deleteSkill($id) {
    $pdo = connectDB();

    $delete = $pdo->prepare('DELETE FROM skill WHERE id_skill = :id_skill');
    $delete->execute(array(
        'id_skill' => $id
    ));

    header('Location:?delete=ok');
    exit;
}

function deleteFormation($id) {
    $pdo = connectDB();

    $delete = $pdo->prepare('DELETE * FROM formation WHERE id_skill = ?');
    $delete->execute(array($id));

    header('Location:?delete=ok');
    exit;
}


// UPLOAD
// PROFILE PICTURE
function uploadProfilePicture($fileInfo, $id) {
    $source = $fileInfo["tmp_name"];
    $name = $id . ".jpg";
    $destination = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatar' . DIRECTORY_SEPARATOR . $name;
    if(move_uploaded_file($source, $destination)) {
        $pdo = connectDB();
        $add = $pdo->prepare('UPDATE about_me SET profile_picture=:picture WHERE id_user = :id_user');
        $add->execute(array(
            'picture' => $name,
            'id_user' => $id
        ));
    } else {
        header('Location:admin?upload=error');
        exit;
    }
}

// CV PDF
function uploadCV($fileInfo, $id) {
    $source = $fileInfo["tmp_name"];
    $name = $id . ".pdf";
    $destination = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'cv-pdf' . DIRECTORY_SEPARATOR . $name;
    if(move_uploaded_file($source, $destination)) {
        $pdo = connectDB();
        $add = $pdo->prepare('UPDATE contact SET url_cv_pdf=:cv WHERE id_user=:id_user');
        $add->execute(array(
            'cv' => $name,
            'id_user' => $id
        ));
    } else {
        header('Location:admin?upload=error');
        exit;
    }
}

// PICTURE PRODUCTION
function uploadPictureProduction($fileInfo, $id_prod) {
    if($fileInfo['error'] == UPLOAD_ERR_OK) {
        $valid_ext = ['image/png', 'image/jpg', 'image/jpeg'];

        if(in_array($fileInfo['type'], $valid_ext)) {
            $source = $fileInfo["tmp_name"];
            $name = $id_prod . ".jpg";
            $destination = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'productions' . DIRECTORY_SEPARATOR . $name;

            if(move_uploaded_file($source, $destination)) {
                $pdo = connectDB();
                $add = $pdo->prepare('UPDATE production SET picture_rea=:picture_rea WHERE id_prod=:id_prod');
                $add->execute(array(
                    'picture_rea' => $name,
                    'id_prod' => $id_prod
                ));
            } 
            else {
                header('Location:admin?upload=error');
                exit;
            } 

        } 
        else {
            header('Location:admin?upload=error');
            exit;
        }
    } 
}


?>