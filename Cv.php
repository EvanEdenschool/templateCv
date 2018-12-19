<?php
try {
	$bdd = new PDO('mysql:host=localhost;dbname=Cv;charset=utf8', 'root', 'root', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ));
}
catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
}
$id = $_GET['id'];
$reponse = $bdd->query("SELECT * FROM user WHERE id = '$id'");
$userdata = $reponse->fetch();

$competences = $bdd->prepare("SELECT * FROM competence WHERE user_id = $id ");
$competences->execute();

function showProgress ($nom_competence, $niveau_competence) {
	echo "<li><h4>$nom_competence</h4><progress max='100' value='$niveau_competence'></progress></li>";
}
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
        <li><i class="fas fa-enveope"></i><p><?php echo $userdata['adresse_mail'];?></p></li>
        <li><i class="fas fa-mobile-alt"></i><p><?php echo $userdata['numero'];?></p></li>
        <li><i class="fab fa-linkedin"></i><p><?php echo $userdata['linkedin'];?></p></li>
      </ul>
    </div>
		<section class="AllSides">
			<div class="LeftSide">
			<ul class="ButtonList">
				<a href="#">À propos de moi</a>
				<li><p><?php echo $userdata['description'];?></p></li>
				<a href="#" class="ButtonMARGE1">SKILLS</a>
				<ul class="SkillsList">
					<?php
					while($competence = $competences->fetch()) {
						showProgress($competence["nom_competence"], $competence["niveau_competence"]);
					}
					?>
				</ul>
				<a href="#" class="ButtonMARGE">PERSONAL SKILLS</a>
				<div class="listIconSkills">
						<ul class="IconList">
							<li>
								<i class="fas fa-heart"></i>
								<hr />
								<h4>Skill #1</h4>
							</li>
							<li>
								<i class="far fa-hand-paper"></i>
								<hr />
								<h4>Skill #2</h4>
							</li>
							<li>
								<i class="fas fa-chart-bar"></i>
								<hr />
								<h4>Skill #3</h4>
							</li>
						</ul>
					</div>
				</ul>
			</div>
			<div class="RightSide">
				<ul class="RightList">
					<li class="buttonContainer"><a href="#">WORK EXPERIENCE</a></li>
					<li><h3>PEG</h3></li>
					<li><h4>Marketing Specialist</h4></li>
					<li><p>johann est un petit enculer de nain,
						johann est un petit enculer de nain
						johann est un petit enculer de nain
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,
						johann est un petit enculer de nain
						johann est un petit enculer de nain
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,</p></li>
				</ul>

				<ul class="RightList">
					<li><h3>BACKGROUND MEDIA</h3></li>
					<li><h4>Digital Marketing Specialist</h4></li>
					<li><p>johann est un petit enculer de nain,
						johann est un petit enculer de nain
						johann est un petit enculer de nain
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,
						johann est un petit enculer de nain
						johann est un petit enculer de nain
						johann est un petit enculer de nain,
						johann est un petit enculer de nain,</p></li>
						<li class="buttonContainer"><a href="#">EDUCATION</a></li>
				</ul>
			<div class="FlexLastList">
				<ul class="LastList">
					 <li><h4>Collage</h4></li>
					 <li><p>johann est un petit enculer de nain,
					 johann est un petit enculer de nain,
					 johann est un petit enculer de nain,</p></li>
				 </ul>
				<ul class="LastList">
					 <li><h4>Specialization</h4></li>
					 <li><p>johann est un petit enculer de nain,
					 johann est un petit enculer de nain,
					 johann est un petit enculer de nain,</p></li>
				</ul>
				</div>
			</div>
		</section>
  </body>
</html>
