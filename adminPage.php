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
  if (
		!empty($_POST['prenom']) &&
		!empty($_POST['nom']) &&
		!empty($_POST['metier']) &&
		!empty($_POST['adresse']) &&
		!empty($_POST['numero']) &&
		!empty($_POST['adresse_mail']) &&
		!empty($_POST['linkedin']) &&
		!empty($_POST['description']) &&
		!empty($_POST['nom_competence']) &&
		!empty($_POST['niveau_competence'])
	) {
		if (preg_match("#^[a-z-._0-9]+@[a-z-.0-9]+\.[a-z0-9]+$#i", $_POST['adresse_mail']) && preg_match("#^0[6-7][0-9]{8}$#i", $_POST['numero'])) {
			$backgroundLink = uploadImage('background');
			$imageLink = uploadImage('your_image');

			$req = $bdd->prepare('INSERT INTO user(prenom, nom, metier, adresse, numero, adresse_mail, linkedin, background, your_image, description) VALUES(:prenom, :nom, :metier, :adresse, :numero, :adresse_mail, :linkedin, :background, :your_image, :description)');
	    $req->execute(array(
	        'background' => $backgroundLink,
	        'your_image' => $imageLink,
	        'prenom' => $_POST['prenom'],
	        'nom' => $_POST['nom'],
	        'metier' => $_POST['metier'],
	        'adresse' => $_POST['adresse'],
	        'numero' => $_POST['numero'],
	        'adresse_mail' => $_POST['adresse_mail'],
	        'linkedin' => $_POST['linkedin'],
					'description' => $_POST['description']));

					$id = $bdd->lastInsertId();
					foreach ($_POST['nom_competence'] as $i => $nom) {
						if (!empty($nom)) {
							$req1 = $bdd->prepare('INSERT INTO competence(nom_competence, niveau_competence, user_id) VALUES (:nom_competence, :niveau_competence, :user_id)');
							$req1->execute(array(
								'nom_competence' => $nom,
								'niveau_competence' => $_POST['niveau_competence'][$i],
								'user_id' => $id
							));
						}
					}

	    header("Location: Cv.php?id=$id");
		}
		else {
			echo "veuillez renseigner des informations valide";
		}
		// Insertion

  } else {
    echo "Erreur lors de l'enregistrement de vos données";
  }
}
list(
	'prenom' => $prenom,
	'nom' => $nom,
	'adresse' => $adresse,
	'adresse_mail' => $adresse_mail,
	'numero' => $numero,
	'metier' => $metier,
	'linkedin' => $linkedin,
	'description' => $description,
	'nom_competence' => $nom_competence,
	'niveau_competence' => $niveau_competence
) = array_merge([
	'prenom' => "",
	'nom' => "",
	'adresse' => "",
	'adresse_mail' => "",
	'numero' => "",
	'metier' => "",
	'linkedin' => "",
	'description' => "",
	'nom_competence' => "",
	'niveau_competence' => ""
], $_POST);

list(
	'background' => $background,
	'your_image' => $your_image,
) = array_merge([
	'background' => "",
	'your_image' => ""
], $_FILES);

?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
      <form class="formAdmin" method="post" enctype="multipart/form-data">
				<h1>Vos informations</h1>
        	<label>Background :</label><input type="file" name="background"  placeholder="monimage.extension (jpg, png)"/><br/>
        	<label>Image :</label><input type="file" name="your_image" placeholder="monimage.extension (jpg, png)"/><br/>
        	<label>Prénom :</label><input type="text" name="prenom" value="<?php echo $prenom;?>"/><br/>
        	<labeL>Nom :</label><input type="text" name="nom" value="<?php echo $nom;?>"/><br/>
        	<label>Addresse</label><input type="text" name="adresse" value="<?php echo $adresse;?>" placeholder="3 rue du bec"/><br/>
        	<label>Adresse Mail</label><input type="Mail" name="adresse_mail" value="<?php echo $adresse_mail;?>" placeholder="exemple@domaine.fr"><br/>
        	<label>Numéro :</label><input type="text" name="numero" value="<?php echo $numero;?>" placeholder="ex:0605030203"/><br/>
        	<label>Métier :</label><input type="text" name="metier" value="<?php echo $metier;?>"/><br/>
        	<label>Linkedin</label><input type="text" name="linkedin" value="<?php echo $linkedin;?>" placeholder="linkedin"/><br/>
					<label>Description :</label><input type="text" name="description" value="<?php echo $description;?>" /><br/><br/>
					<h2>Compétence</h2>
					<ul>
						<?php
						for ($i = 0; $i < 3; $i++){
							?>
							<li>
								<label>Nom de la compétence :</label><input type="text" name="nom_competence[]" value="<?php echo $nom_competence[$i];?>"/><br/>
								<label>Niveau de la compétence sur 100 :</label><input type="text" name="niveau_competence[]" value="<?php echo $niveau_competence[$i];?>" placeholder="ex: 70"><br/><br/>
							</li>
							<?php
						}
						?>
					</ul>
					<input type="submit" name="submit"/>
      </form>
  </body>
</html>

<?php

 ?>
