<!--/* <?php
session_start();
$erreur = "";
$bdd = new PDO('sqlite:users.sqlite');
if(isset($_POST['confirmform']))
{
    if(isset($motdepass) AND !empty($motdepass))
    {
        $motdepass = sha1($_POST['generate_password']);
        $requser = $bdd->prepare("SELECT * FROM membres WHERE motdepassegenete=?");
        $requser->execute(array($motdepass));
        $userinfo = $requser->rowCount();
        if($userinfo == 1)
        {
            header('Location: connexion.php');
        }else{
            $erreur = "Veillez entrer le mot de passe envoyé a votre mail";
        }
    }
}
/* ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifier | compte</title>
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <center>
        <div class="principale">
            <h1>Verifier votre compte avec le mot de passe envoyé à votre adresse mail</h1>
        
            <form action="" method="post">
                <input type="password" name="generate_password" id="generate_password" placeholder = "Saisisez le code envoyé à votre mail">
                <br>
                <input type="submit" name="confirmform" value="Continuer" id="button" ></br>
                //<?php echo '<font color = "red" >'.$erreur."</font>";?>
            </form>
        </div>
    </center>
</body>
</html> -->
*/