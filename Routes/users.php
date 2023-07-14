<?php
$users = json_decode(file_get_contents("http://localhost/Nouveau%20dossier/API/users/"));

ob_start();
?>

<form action="">
    <label for="nom">Nom</label></br>
    <input type="text" name="nom" id=""></br>
    <label for="prenom">Prenom</label></br>
    <input type="text" name="prenom" id=""></br>
    <label for="date">Date de naissance</label></br>
    <input type="date" name="naissance" id=""></br>
    <label for="genre" class="lab">Votre genre:</label></br>
    <input type = "radio" name = "sexe" value = "Masculin">
    <label for = "masculin_genre" class="lab">Masculin</label>
    <input type = "radio" name = "sexe" value = "Feminin">
    <label for = "feminin_genre" class="lab">Feminin</label></br>
    <label for="mail">Email</label></br>
    <input type="email" name="mail" id=""></br>
    <label for="mail2">Email de recuperation</label></br>
    <input type="email" name="mailrecup" id=""></br>
    <label for="tel">Telephone</label></br>
    <input type="tel" name="tel" id=""></br>
    <label for="adresse">Adresse</label></br>
    <input type="text" name="adresse" id=""></br>
    <label for="motdepasse">Mot de passe</label></br>
    <input type="password" name="motdepsse" id=""></br>
    <label for="confirmmotdepasse">Confirmer le mot de passe</label></br>
    <input type="text" name="motdepass2" id=""></br>
    <label for="fichier">Avatar</label></br>
    <input type="file" name="avatar" id=""></br>
    <input type="button" value="Continuer">
</form>


<?php
$content = ob_get_clean();
require_once("root.php");


?>