<?php
define("URL",str_replace("index.php","",(isset($_SERVER['HTTPS'])? "https" : "http").
"://".$_SERVER['HTTP_HOST'].$_SERVER["PHP_SELF"]));

    function getUsers(){
        $pdo = getConnexion();
        $req = "SELECT * from membres";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for($i=0;$i< count($users);$i++){
            $users[$i]['avatar'] = URL."membres/avatars/".$users[$i]['avatar'];
        }
        $stmt->closeCursor();
        sendJSON($users);
    }

  /*  
  tris des donnees par categorie
  function getusersByCategoie($categorie){
        $pdo = getConnexion();
        $req = "SELECT f.id,f.libelle,f.description,f.avatar,c.libelle as 'categorie' from user$user f inner join categorie c on f.categorie_id = c.id
        where c.libelle= :categorie";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":categorie",$categorie,PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        for($i=0;$i< count($users);$i++){
            $users[$i]['avatar'] = URL."membres/avatars/".$users[$i]['avatar'];
        }
        $stmt->closeCursor();
        sendJSON($users);
    } */

    //choix de l'user avec son mot de passe 
function getUserByPassword($password){
    $pdo = getConnexion();
        $req = "SELECT * from membres where confirmkey = :motDePass";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":motDePass",$password,PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $user['avatar'] = URL."membres/avatars/".$user['avatar'];
        $stmt->closeCursor();
        sendJSON($user);
}
// Connexion avec la base de donnee
function getConnexion(){
    return new PDO("sqlite:users.sqlite");
}

//recuperation des donnees sous format JSON
function sendJSON($infos){
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos,JSON_UNESCAPED_UNICODE);
}
?>
