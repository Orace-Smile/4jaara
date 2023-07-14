<?php
session_start();

$bdd = new PDO('sqlite:users.sqlite');

if(isset($_GET['id']) AND $_GET['id'] > 0 )
{
    $getid = intval($_GET['id']);
    $requser = $bdd->prepare("SELECT * FROM membres WHERE id=?");
    $requser->execute(array($getid));
    $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Compte | Utilisateur</title>
</head>
<body>
    <div align="center">
        <h3>Profil de <?php echo $userinfo['pseudo']; ?></h3> 
        </br></br>
        <?php
        if(!empty($userinfo['avatar']))
        {
        ?>
        <img src="membres/avatars/<?php echo $userinfo['avatar'];?>" width="150"/>
        <?php
        }
        ?>
        </br>
        <?php echo $userinfo['pseudo']; ?>
        </br>
        <?php echo $userinfo['nom']; ?><?php echo " ".$userinfo['prenom']; ?>
        </br>
        <?php echo $userinfo['datedenaissance']; ?>
        </br>
        <?php echo $userinfo['genre']; ?>
        </br>
        <?php echo $userinfo['tel']; ?>
        </br>
        <?php echo $userinfo['mail']; ?>
        </br>
    <?php
        if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
        {
    ?>
        <a href="editionprofil.php">Editer mon profil</a>
        <a href="deconnexion.php">Se deconnecter</a>

    <?php
        }
    ?>
    </div>
</body>
</html>
<?php
}
?>