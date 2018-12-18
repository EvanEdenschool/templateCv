<?php
session_start();
try {
	$bdd = new PDO('mysql:host=localhost;dbname=Cv;charset=utf8', 'root', 'root', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));
}
catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}

function uploadImage ($name) {
    $link = null;

    if (isset($_FILES[$name]) && $_FILES[$name]['error'] == 0) {
            // Testons si le fichier n'est pas trop gros
        if ($_FILES[$name]['size'] <= 1000000) {
          $infosfichier = pathinfo($_FILES[$name]['name']);
          $extension_upload = $infosfichier['extension'];
          $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
          if (in_array($extension_upload, $extensions_autorisees)) {
            $link = basename($_FILES[$name]['name']);
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $link);
            echo "L'envoi a bien été effectué !";
          }
        }
    }

    return $link;
}

if (isset($_POST['submit'])) {
  $backgroundLink = uploadImage('background');
  $imageLink = uploadImage('your_image');

  if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['metier']) && !empty($_POST['adresse']) && !empty($_POST['numero']) && !empty($_POST['adresse_mail']) && !empty($_POST['linkedin'])) {
    // Insertion
    $req = $bdd->prepare('INSERT INTO user(prenom, nom, metier, adresse, numero, adresse_mail, linkedin, background, your_image, id) VALUES(:prenom, :nom, :metier, :adresse, :numero, :adresse_mail, :linkedin, :background, :your_image, id)');
    $req->execute(array(
        'background' => $backgroundLink,
        'your_image' => $imageLink,
        'prenom' => $_POST['prenom'],
        'nom' => $_POST['nom'],
        'metier' => $_POST['metier'],
        'adresse' => $_POST['adresse'],
        'numero' => $_POST['numero'],
        'adresse_mail' => $_POST['adresse_mail'],
        'linkedin' => $_POST['linkedin']));
        

    header("Location: Cv.php");
  } else {
    echo "Erreur lors de l'enregistrement de vos données";
  }
}

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <form class="formAdmin" method="post" enctype="multipart/form-data">
        <label>Background :</label><input type="file" name="background" value="" placeholder="monimage.extension (jpg, png)"/>
        <label>Image Ronde :</label><input type="file" name="your_image" value="" placeholder="monimage.extension (jpg, png)"/>
        <label>Prénom :</label><input type="text" name="prenom" value=""/>
        <labeL>Nom :</label><input type="text" name="nom" value=""/>
        <label>Addresse</label><input type="text" name="adresse" value="" placeholder="3 rue du bec"/>
        <label>Adresse Mail</label><input type="Mail" name="adresse_mail" value="" placeholder="exemple@domaine.fr">
        <label>Numéro :</label><input type="text" name="numero" value="Numéro" placeholder="ex:0605030203"/>
        <label>Métier :</label><input type="text" name="metier" value=""/>
        <label>Linkedin</label><input type="text" name="linkedin" value="" placeholder="linkedin"/>
        <input type="submit" name="submit"/>
      </form>
  </body>
</html>

<?php

 ?>
