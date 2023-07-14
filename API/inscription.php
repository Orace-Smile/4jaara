<?php
error_reporting(1);
$jaaramail ="";
try{

    $bdd = new PDO('sqlite:users.sqlite');

    $bdd->exec("CREATE TABLE membres(id INTEGER PRIMARY KEY,pseudo TEXT,nom TEXT,prenom TEXT,mail TEXT,mailrecup TEXT,genre TEXT,datedenaissance TEXT,adresse TEXT,tel VARCHAR,motdepass TEXT,confirmkey VARCHAR,confirm INT,avatar VARCHAR)");


}catch(PDOException $execpt){
    $execpt->getMessage();
}

if(isset($_POST['forminscription']))
{
    /* $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $shfl = str_shuffle($comb);
    $pwd = substr($shfl,0,8);
    $headers = "From: <$jaaramail>\r\nReply-To: $jaaramail ";
    mail($mail, "Votre mot de passe de confirmation", $pwd, $headers); */
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $tel = htmlspecialchars($_POST['tel']);
    $genre = htmlspecialchars($_POST['sexe']);
    $date =htmlspecialchars($_POST['naissance']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);

    if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['sexe']) AND !empty($_POST['adresse']) AND !empty($_POST['tel']) AND !empty($_POST['naissance']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']))
    {
        $pseudolength = strlen($pseudo);
        if($pseudolength <= 255)
        {
            if(isset($mail))
            {
                if(filter_var($mail,FILTER_VALIDATE_EMAIL))
                {
                    $reqmail = $bdd->prepare("SELECT * FROM membres WHERE mail = ?");
                    $reqmail->execute(array($mail));
                    $mailexist = $reqmail->rowCount();
                    if(!$mailexist)
                    {
                        if($mdp == $mdp2)
                        {
                            $longueurkey = 15;
                            $key = "";
                            for($i=1;$i<$longueurkey;$i++)
                            {
                                $key .= mt_rand(0,9);
                            }
                            $insertmbr = $bdd->prepare("INSERT INTO membres(pseudo,nom,prenom,tel,adresse,datedenaissance,genre,mailrecup,mail,motdepass,confirmkey) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                            $insertmbr->execute(array($pseudo,$nom,$prenom,$tel,$adresse,$date,$genre,$mail2,$mail,$mdp,$key));

                            $header = "MINE-Version:1.0\r\n";
                            $header .= 'From:"4Jaara"<jaara@mail.com>'."\n";
                            $header .= 'Content-Type:text/html; charset="UTF-8"'."\n";
                            $header .= 'Content-Transfer-Encoding: 8bit';

                            $message ='
                                <html>
                                    <body>
                                        <div align="center">
                                            <a href="http://localhost/Nouveau%20dossier/API/confirmation.php?pseudo='.urldecode($pseudo).'&key='.$key.'">Confirmez votre compte</a>
                                        </div>
                                    </body>
                                </html>
                            ';
                            mail($mail,"Confirmation du compte",$message,$header);

                            $erreur = 'Votre compte a bien été crée!  <a href="http://localhost/Nouveau%20dossier/API/confirmation.php?pseudo='.urldecode($pseudo).'&key='.$key.'">Suivant</a>';
                        }
                        else{
                                $erreur =  "Vos mot de passe ne correspondent pas!";
                        }
                    }else{
                        $erreur = "Adresse mail déjà utilisée";
                    }
                }else{
                    $erreur = "Votre adresse mail n'est pas valide";
                }
            }
            else{
                    $erreur = "Vos adresse mail ne correspondent pas !";
                }
        }else
        {
            $erreur = " Votre Pseudo ne doit pas depasser 255 caracteres ! ";
        }
    }
    else{
        $erreur = "Tous les champs doivent être remplies ";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/inscription.css">
    <link rel="shortcut icon" href="../images/jaara.jpg">
    <script src=""></script>                                                                                   
    <title>Créer un compte</title>
</head>
<body class="body">
        <div class="principale">
        </br>
            <form action="" method="post">
                <div class="formulaire">
                    <h1 class="phrase">Inscrivez-vous Maintenant</h1> 
                    <div class="champ">
                    
                            <div class="pourleschamps">
                                <label for="pseudo" class="lab">Pseudo:</label><br>
                                <input type="text" class="champs" name="pseudo" id="pseudo" placeholder="Votre pseudo" value="<?php if(isset($pseudo)){ echo $pseudo;} ?>">
                            </div>
                            <div class="pourleschamps">
                                <label for="nom" class="lab">Nom:</label><br>
                                <input type="text" class="champs" name="nom" id="nom" placeholder="Votre Nom" value="<?php if(isset($nom)){ echo $nom;} ?>">
                            </div>
                            <div class="pourleschamps">
                                <label for="prenom" class="lab">Prenom:</label><br>
                                <input type="text" class="champs" name="prenom" id="prenom" placeholder="Votre prenom" value="<?php if(isset($prenom)){ echo $prenom;} ?>">
                            </div>
                            <div class="pourleschamps">
                                <label for="tel" class="lab">Telephone:</label><br>
                                <input type="tel" class="champs" name="tel" id="tel" placeholder="Votre numero de telephone" value="<?php if(isset($tel)){ echo $tel;} ?>">
                            </div>
                            <div class="pourleschamps">          
                                <label for="mail" class="lab">Mail Officiel:</label><br>
                                <input type="email" class="champs" name="mail" id="mail" placeholder="Votre mail" value="<?php if(isset($mail)){ echo $mail;} ?>">
                            </div>
                            <div class="pourleschamps">
                                <label for="adresse" class="lab">Adresse physique:</label><br>
                                <input type="text" class="champs" name="adresse" id="adresse" placeholder="Votre adresse physique" value="<?php if(isset($adresse)){ echo $adresse;} ?>">
                            </div>
                            <div class="pourleschamps">
                                <label for="mdp" class="lab">Mot de passe:</label><br>
                                <input type="password" class="champs" name="mdp" id="mdp" placeholder="Votre mot de passe">
                            </div>
                            <div class="pourleschamps">
                                <label for="mdp2" class="lab">Confirmer mot de passe:</label><br>
                                <input type="password" class="champs" name="mdp2" id="mdp2" placeholder="Confirmer votre mot de passe">
                            </div>
                            <div class="pourleschamps">
                                <label for="naissance" class="lab">Date de naissance:</label><br>
                                <input type="date" class="champs" name="naissance" id="naissance"  value="<?php if(isset($date)){ echo $date;} ?>">
                            </div> 
                        <div class="pourleschamps">
                            <label for="mail2" class="lab">Mail de Récupération:</label><br>
                            <input type="email" class="champs" name="mail2" id="mail2" placeholder="Confirmer votre mail" value="<?php if(isset($mail2)){ echo $mail2;} ?>">
                        </div>
                            <div class="pourleschamps">
                                <label for="genre" class="lab">Votre genre:</label>
                                <input type = "radio" name = "sexe" value = "Masculin">
                                <label for = "masculin_genre" class="lab">Masculin</label>
                                <input type = "radio" name = "sexe" value = "Feminin">
                                <label for = "feminin_genre" class="lab">Feminin</label>
                            </div>
                        <div class="pourleschamps">
                                <input type="submit"  class="button" name="forminscription" value="Je m'inscris">
                        </div>
                        <?php
                    echo "<a href=http://localhost/Nouveau%20dossier/API/connexion.php>Vous avez un compte ? Se connecter !</a>";

                if(isset($erreur))
                {
                    echo '<font color = "red" >'.$erreur."</font>";
                }
            ?>
                    </div> 
                </div> 
                
            </form>
            
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>    
</body>
</html>