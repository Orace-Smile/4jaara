<?php
session_start();

$bdd = new PDO('sqlite:users.sqlite');
$msg = "";
if(isset($_SESSION['id']))
{
    $requser = $bdd->prepare("SELECT * FROM membres WHERE  id=?");
    $requser->execute(array($_SESSION['id']));
    $user = $requser->fetch();
    //pseudo
    if(isset($_POST['newpseudo']) AND !empty($_POST['newpseudo']) AND $_POST['newpseudo'] != $user['pseudo'])
    {
        $newpseudo = htmlspecialchars($_POST['newpseudo']);
        $insertpseudo = $bdd->prepare("UPDATE membres SET pseudo = ? WHERE id= ?");
        $insertpseudo->execute(array($newpseudo,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//mail
    if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail'])
    {
        $newmail = htmlspecialchars($_POST['newmail']);
        $insertmail = $bdd->prepare("UPDATE membres SET mail = ? WHERE id= ?");
        $insertmail->execute(array($newmail,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//nom
    if(isset($_POST['newnom']) AND !empty($_POST['newnom']) AND $_POST['newnom'] != $user['nom'])
    {
        $newnom = htmlspecialchars($_POST['newnom']);
        $insertnom = $bdd->prepare("UPDATE membres SET nom = ? WHERE id= ?");
        $insertnom->execute(array($newnom,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//prenom
    if(isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND $_POST['newprenom'] != $user['prenom'])
    {
        $newprenom = htmlspecialchars($_POST['newprenom']);
        $insertprenom = $bdd->prepare("UPDATE membres SET prenom = ? WHERE id= ?");
        $insertprenom->execute(array($newprenom,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//mail de recuperation
    if(isset($_POST['newmail2']) AND !empty($_POST['newmail2']) AND $_POST['newmail2'] != $user['mail2'])
    {
        $newmail2 = htmlspecialchars($_POST['newmail2']);
        $insertmail2 = $bdd->prepare("UPDATE membres SET mailrecup = ? WHERE id= ?");
        $insertmail2->execute(array($newmail2,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//adresse
    if(isset($_POST['newadresse']) AND !empty($_POST['newadresse']) AND $_POST['newadresse'] != $user['adresse'])
    {
        $newadresse = htmlspecialchars($_POST['newadresse']);
        $insertadresse = $bdd->prepare("UPDATE membres SET adresse = ? WHERE id= ?");
        $insertadresse->execute(array($newadresse,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
//telephone
    if(isset($_POST['newtel']) AND !empty($_POST['newtel']) AND $_POST['newtel'] != $user['tel'])
    {
        $newtel = htmlspecialchars($_POST['newtel']);
        $inserttel = $bdd->prepare("UPDATE membres SET tel = ? WHERE id= ?");
        $inserttel->execute(array($newtel,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    //date de naissance
    if(isset($_POST['newnaissance']) AND !empty($_POST['newnaissance']) AND $_POST['newnaissance'] != $user['datedenaissance'])
    {
        $newnaissance = htmlspecialchars($_POST['newnaissance']);
        $insertnaissance = $bdd->prepare("UPDATE membres SET datedenaissance = ? WHERE id= ?");
        $insertnaissance->execute(array($newnaissance,$_SESSION['id']));
        header('Location: profil.php?id='.$_SESSION['id']);
    }
    // insertion d'avatar
    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {
        $tailleMax = 2097152;
        $extensionValides = array('jpg','jpeg','gif','png');
        if($_FILES['avatar']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'),1));
            if(in_array($extensionUpload,$extensionValides))
            {
                $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'],$chemin);
                if($resultat)
                {
                    $updateavatar = $bdd->prepare('UPDATE membres SET avatar = ? WHERE  id=?');
                    $updateavatar->execute(array($_SESSION['id'].".".$extensionUpload,$_SESSION['id']
                    ));
                    header('Location: profil.php?id='.$_SESSION['id']);
                }else{
                    $msg = "Erreur durant l'importation de votre photo de profil";
                }
            }else{
                $msg = "Votre photo doit être au format jpg , jpeg, gif ou png";
            }

        }else{
            $msg = "Votre photo de profil ne doit pas depassee 2Mo";

        }
    }

  /*   if(isset($_POST['newpseudo']) AND $_POST['pseudo'] == $user['pseudo'])
    {
        header('Location: profil.php?id='.$_SESSION['id']);
    } */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <link rel="stylesheet" href="../css/editionprofil.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Edition du profil</title>
</head>
<body>
    <div class="content">
        <div align="center">
            <h3>Edition de mon profil</h3> 
        </br></br>
        <form action="" method="post" enctype="multipart/form-data" >
            
                <label>Pseudo :</label></br>
                <input type="text" class="champs" name="newpseudo" placeholder="Pseudo" value="<?php echo $user['pseudo']; ?>" ></br>
                <label>Nom :</label></br>
                <input type="text" class="champs" name="newnom" placeholder="Nom" value="<?php echo $user['nom']; ?>"></br>
                <label>Prenom :</label></br>
                <input type="text" class="champs" name="newprenom" placeholder="Prenom" value="<?php echo $user['prenom']; ?>"></br>
                <label>Mail Officiel:</label></br>
                <input type="email" class="champs" name="newmail" placeholder="Mail Officiel" value="<?php echo $user['mail']; ?>"></br>
                <label>Mail de récupération:</label></br>
                <input type="email" class="champs" name="newmail2" placeholder="Mail de recuperation" value="<?php echo $user['mailrecup']; ?>"></br>
           
                <label>Telephone  :</label></br>
                <input type="tel" class="champs" name="newtel" placeholder="Telephone" value="<?php echo $user['tel']; ?>"></br>
                <label>Adresse physique :</label></br>
                <input type="text" class="champs" name="newadresse" placeholder="Adresse physique" value="<?php echo $user['adresse']; ?>"></br>
                <label>Date de naissance :</label></br>
                <input type="date" class="champs" name="newnaissance"  value="<?php echo $user['datedenaissance']; ?>"></br>
                <label>Avatar:</label></br>
                <input type="file" class="champs" name="avatar" ></br></br>
                <input type="submit" class="btn_confirm" value="Mettre a jour mon profil">
            
        </form>
        <?php
        echo '<font color = "red" >'.$msg."</font>";
        ?>
        </div>
    </div>
</body>
</html>
<?php
}
else{
    header("Location: connexion.php");
}
?>