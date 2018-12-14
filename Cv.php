

<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="/css/cv.min.css">
    <title>Cv template</title>
  </head>
  <body>
    <div class="firstStrate">
      <img class="roundedImage" src="./img/bilal.png" alt="image qui montre la tête"/>
      <h1>Prenom <span>Nom</span></h1>
      <p>Description (en 2 ligne)</p>
    </div>

    <style type="text/css">
      .firstStrate {
        display: flex;
        text-align: center;
        align-items: center;
        flex-direction: column;
      }
      .roundedImage{
          overflow:hidden;
          -webkit-border-radius:50px;
          -moz-border-radius:50px;
          border-radius:50px;
          width:90px;
          height:90px;
      }
    </style>
  </body>
</html>
