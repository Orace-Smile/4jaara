<?php
    $bdd = new PDO('sqlite:users.sqlite');
    $erreur = "";
    if(isset($_GET['pseudo'], $_GET['key']) AND !empty($_GET['pseudo']) AND !empty($_GET['key']))
    {
        $pseudo = htmlspecialchars(urldecode($_GET['pseudo']));
        $key = htmlspecialchars($_GET['key']);
        
        $requser = $bdd->prepare("SELECT * FROM membres WHERE pseudo = ? AND confirmkey = ?");
        $requser->execute(array($pseudo, $key));
        $userexist = $requser->rowCount();
        $motdepasse = htmlspecialchars($_POST['confirm_password']);
        if(isset($_POST['valid'])){
            if(/* isset($motdepasse) AND */ $motdepasse == $key){
                header('Location: connexion.php');
            }else{
                $erreur = "Verifier votre boite mail";
            }
        }
        if($userexist == 1){
            $user = $requser->fetch();
            if($user['confirme'] == 0){
                $updateuser = $bdd ->prepare("UPDATE membres SET confirme = 1 WHERE pseudo = ? AND confirmkey = ?");
                $updateuser->execute(array($pseudo.$key));
                $erreur = "Votre compte a bien ete confirme ";
            }else{
                $erreur = "Votre compte a deja ete confirme !";
            }
        }else{
            $erreur = "L'utilisateur n'existe pas !";
        }
    } 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/confirm.css">
    <title>Confirmer votre compte</title>
</head>
<body>
        <div class="container">
            <div class="header">
                <center>
                    <h1 class="header">Confirmer votre compte</h1>
                </center>
            </div>
            <div class="content">
                <form action="" method="post">
                    <center>
                <label for="confirm_password" class="mot_de_passe">Mot de passe de confirmation</label></br>
                <input type="password" class="champs" name="confirm_password" id="confirm_password" placeholder="Mot de passe de confirmation"></br></center>
                <center><input type="submit" name="valid" value="Confirmer" class="btn_confirm"></center>
                </form>
                 <?php echo $erreur;?>
            </div>
        </div>    
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>
