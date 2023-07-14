<?php
$bdd = new PDO('sqlite:users.sqlite');
$erreur ="";

if(isset($_POST['valid']))
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $pass = sha1($_POST['mdp']);

    if(isset($pseudo,$pass) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']))
    {
        $req = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND confirmkey = ?");
        $req->execute(array($pseudo,$pass));
        $userexist= $req-> rowCount();
        echo $userexist;
        if($userexist){
            $erreur = "User exist";
        }
        
    }else {
         $erreur = "Veillez entrer vos coordonnees";
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!--  <link rel="stylesheet" href="../css/popup.css"> -->
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
    <title>Contact des donnees</title>
</head>
<body>
    <style='
body{
    background-color: #cce5fa !important;
}

.header{
    text-align: center;
    color: #FFFFFF;
    margin-top: 10%;
}

#dialog {
    border-radius: 7px;
    background-color: #57dfcd;
    border: none;
    color: #FFF;
    margin-top: 1%;
}

.choix{
    background-color: #ddda23;
    border: none;
    border-radius: 4px;
    padding-top: 5px;
    padding-bottom: 5px;
    color: #FFF;
    font-weight: bold;
    margin-top: 10px;
}

#close{
    background-color: #28beece0;
    border: none;
    border-radius: 4px;
    padding-top: 5px;
    padding-bottom: 5px;
    color: #FFF;
    font-weight: bold;
    margin-top: 10px;
}

#send{
    background-color: #d30f0fe0;
    border: none;
    border-radius: 4px;
    padding-top: 5px;
    padding-bottom: 5px;
    color: #FFF;
    font-weight: bold;
    margin-top: 10px;
}'>

</style>
    <center>
        <h1 class="header">Commencer votre inscription</h1>
            <input type="button" class="choix" value="Continuer avec jaara" id="open">
            <dialog id="dialog">
            <form action="" method="post">
                <label for="pseudo">Pseudo</label><br>
                <input type="text" name="pseudo" id="champs" placeholder="Votre pseudo"><br>
                <label for="motdepasse">Mot de passe</label><br>
                <input type="password" name="mdp" id="champs" placeholder="Votre Mot de passe"><br>
                <input type="button" name="valid" value="Continuer" id="send">
                <input type="button"  value="Annuler" id="close">
            </form>
        </dialog>
        <? echo $erreur;?>
    </center>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
         -->
         <script src="../js/popup.js"></script>
</body>
</html>