<?php
session_start();

$bdd = new PDO('sqlite:users.sqlite');

if(isset($_POST['formconnect']))
{
    $mailconnect = htmlspecialchars($_POST['mailconnect']);
    $mdpconnect = sha1($_POST['mdpconnect']);

    if(!empty($mailconnect) AND !empty($mdpconnect))
    {
        $requser = $bdd->prepare("SELECT * FROM membres WHERE mail=? AND motdepass=?");
        $requser->execute(array($mailconnect,$mdpconnect));
        $userexist = $requser->rowCount();
        if($userexist == 0)
        {
            $userinfo = $requser->fetch();
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['pseudo'] = $userinfo['pseudo'];
            $_SESSION['mail'] = $userinfo['mail'];
            header("Location: profil.php?id=".$_SESSION['id']);
        }else{
            $erreur = "Mauvais mail ou mot de passe";
        }
    }
    else{
        $erreur = "Tout les champs doivent etre complet";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="../css/animation.css">
    <title>S'Authentifier</title>
</head>
<body class="body">

<div class="container">
        <div class="wrap">
            <span style="--i:11"></span>
            <span style="--i:12"></span>
            <span style="--i:24"></span>
            <span style="--i:10"></span>
            <span style="--i:13"></span>
            <span style="--i:17"></span>
            <span style="--i:23"></span>
            <span style="--i:18"></span>
            <span style="--i:16"></span>
            <span style="--i:19"></span>
            <span style="--i:20"></span>
            <span style="--i:22"></span>
            <span style="--i:25"></span>
            <span style="--i:18"></span>
            <span style="--i:21"></span>
            <span style="--i:15"></span>
            <span style="--i:13"></span>
            <span style="--i:16"></span>
            <span style="--i:17"></span>
            <span style="--i:13"></span>
            <span style="--i:18"></span>
            <span style="--i:24"></span>
            <span style="--i:12"></span>
            <span style="--i:26"></span>
            <span style="--i:19"></span>
            <span style="--i:18"></span>
            <span style="--i:22"></span>
            <span style="--i:17"></span>
            <span style="--i:10"></span>
            <span style="--i:24"></span>
            <span style="--i:18"></span>
            <span style="--i:24"></span>
            <span style="--i:22"></span>
            <span style="--i:16"></span>
            <span style="--i:26"></span>
            <span style="--i:22"></span>
            <span style="--i:17"></span>
            <span style="--i:10"></span>
            <span style="--i:24"></span>
            <span style="--i:18"></span>
            <span style="--i:24"></span>
            <span style="--i:22"></span>
            <span style="--i:16"></span>
            <span style="--i:26"></span>
        </div>
        <div  class="centre" align="center">
            <h3 id="header">Connexion</h3> 
                </br></br>
                <form action="" method="post">
                    <input type="email" name="mailconnect"  placeholder="Mail" class="champs"></br>
                    <input type="password" name="mdpconnect"  placeholder="Mot de passe" class="champs"></br> 
                    <input type="submit" name="formconnect"  value="Se connecter" class="btn"></br>
                    <?php
                    echo "<a href=http://localhost/Nouveau%20dossier/API/inscription.php>Vous n'avez pas un compte ? Creer un !</a>";
                    if(isset($erreur))
                    {
                        echo '<font class = "red" >'.$erreur."</font>";
                    }
                ?>
                </form>
    </div>
</body>
</html>