<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=Cv;charset=utf8', 'root', 'root', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));
}
catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}
$reponse = $bdd->query('SELECT prenom, nom, metier, adresse, numero, adresse_mail, linkedin, background, your_image FROM user');
$userdata = $reponse->fetch();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link rel="stylesheet" href="./css/main.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
    <title>Cv template</title>
  </head>
  <body>
    <div class="firstStrate"
        style="background-image:url('./uploads/<?php echo $userdata['background'];?>')">
      <div class="containerImage">
        <img class="roundedImage" src="./uploads/<?php echo $userdata['your_image'];?>" alt="image qui montre la tête"/>
      </div>
      <h1><?php echo $userdata['prenom'] . '<span> ' . $userdata['nom']  .'</span>';?> </h1>
      <span><?php echo $userdata['metier'];?></span>
      <ul class="description">
        <li><i class="fas fa-map-marker-alt"></i><p><?php echo $userdata['adresse'];?></p></li>
        <li><i class="fas fa-envelope"></i><p><?php echo $userdata['adresse_mail'];?></p></li>
        <li><i class="fas fa-mobile-alt"></i><p><?php echo $userdata['numero'];?></p></li>
        <li><i class="fab fa-linkedin"></i><p><?php echo $userdata['linkedin'];?></p></li>
      </ul>
    </div>
  </body>
</html>
