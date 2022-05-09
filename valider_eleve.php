<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body class='all_pages'>
      <h1 class="title">Ajouter un élève</h1>

        <?php

        include('connexion.php');

        //récupération des données

          $prenom =$_POST["prenom"];
          $nom=$_POST["nom"];
          $bdate=$_POST["bdate"];
          $valider=$_POST['valider'];
          $genre = $_POST['genre'];


          //vérification injection SQL
          $prenom = mysqli_real_escape_string($connect, $prenom);
          $nom = mysqli_real_escape_string($connect, $nom);
          $bdate = mysqli_real_escape_string($connect, $bdate);
          $genre = mysqli_real_escape_string($connect, $genre);
          $valider = mysqli_real_escape_string($connect, $valider);

          //vérification execution de scripts
          $nom = htmlspecialchars($nom);
          $prenom = htmlspecialchars($prenom);
          $bdate = htmlspecialchars($bdate);
          $genre = htmlspecialchars($genre);
          $valider = htmlspecialchars($valider);

          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");

          //si l'utilisateur souhaite valider l'ajout de l'élève alors on envoie la requete SQL
          if ($valider == 1){
            //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
            $query = "INSERT INTO eleves VALUES (NULL,"."'$nom'".","."'$prenom'".","."'$bdate'".","."'$date'".","."'$genre'".")";

            $result = mysqli_query($connect, $query);
            
            if (!$result){
              echo "<br>erreur".mysqli_error($connect);
              exit;
              }


            echo "<div class='retour'>";
            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_eleve.html'><input class='buttonclick'type='button' value='retour'/></a></div>";
          }


          //si l'utilisateur a choisi d'annuler on affiche juste un message
          else{
            echo "<div class='retour'>";
            echo "<p>L'inscription a bien été annulée</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_eleve.html'><input class='buttonclick'type='button' value='retour'/></a></div>";
          }

          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
