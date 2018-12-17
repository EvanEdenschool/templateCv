<?php
  $_background = 'background.jpg';
  $_rounded_image = 'pierre.jpg';
  $_nom = 'Nom';
  $_prenom = 'Prenom';
  $_metier = 'Developpeur Web';
  $_adresse = '3 place du bec';
  $_mail_adresse = 'bec.kakic@free.fr';
  $_numero = '067898765';
  $_linkedin = 'Votre Linkedin';
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
        style="background-image:url('./img/<?php echo $_background;?>')">
      <div class="containerImage">
        <img class="roundedImage" src="./img/<?php echo $_rounded_image;?>" alt="image qui montre la tête"/>
      </div>
      <h1><?php echo $_prenom . '<span> ' . $_nom  .'</span>';?> </h1>
      <span><?php echo $_metier;?></span>
      <ul class="description">
        <li><i class="fas fa-map-marker-alt"></i><p><?php echo $_adresse;?></p></li>
        <li><i class="fas fa-envelope"></i><p><?php echo $_mail_adresse;?></p></li>
        <li><i class="fas fa-mobile-alt"></i><p><?php echo $_numero;?></p></li>
        <li><i class="fab fa-linkedin"></i><p><?php echo $_linkedin;?></p></li>
      </ul>
    </div>
  </body>
</html>
