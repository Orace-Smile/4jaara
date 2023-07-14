<?php
require_once("./api.php");
try{
        if(!empty($_GET['demande'])){
            $url = explode("/",filter_var($_GET['demande'],FILTER_SANITIZE_URL));
            switch($url[0]){
                case "users" : 
                    if(empty($url[1])){
                        getUsers();
                    /* }elseif(empty($url[1][1])){
                        echo "test"; */
                    }else{
                        echo "Pas de user";
                    }// 
                break;
                case "user" :
                    if(!empty($url[1])){
                        getUserByPassword($url[1]);
                    }else{
                        throw new Exception("Vous n'avez pas renseigné le mot de passe de l'utisateur"); 
                    }
                break;
                default : throw new Exception("La demande n'est valide, vérifiez l'url");
                
            }
        }else{
            throw new Exception("Problème de récupération de données.");
        }
    }catch(Exception $e){
        $erreur =[
            "message" => $e->getMessage(),
            "code" => $e->getCode()
        ];
         print_r($erreur);
    }

?>
