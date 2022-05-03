<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
    <body class='all_pages'>

        <?php

        include('connexion.php');

          $selected_date =$_POST["date"];
          $idtheme=$_POST["idtheme"];
          $effectif=$_POST["effectif"];
          $valider=$_POST['valider'];

          $selected_date = mysqli_real_escape_string($connect, $selected_date);
          $idtheme = mysqli_real_escape_string($connect, $idtheme);
          $effectif = mysqli_real_escape_string($connect, $effectif);
          $valider = mysqli_real_escape_string($connect, $valider);

          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");

          if ($valider == 1){
            //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
            $query = "INSERT INTO seances VALUES (NULL,"."'$selected_date'".","."'$effectif'".","."'$idtheme'".","."'0'".")";
            $result = mysqli_query($connect, $query);
            if (!$result){
              echo "<br>erreur".mysqli_error($connect);
              exit;
              }
            // $query utilise comme parametre de mysqli_query
            // le test ci-dessous est desormais impose pour chaque appel de :
            // mysqli_query($connect, $query)
            echo "<div class='retour'>";
            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='retour'/></a></div>";

          }
          else{
            echo "<div class='retour'>";
            echo "<p>L'inscription a bien été annulée</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_seance.php'><input class='buttonclick'type='button' value='retour'/></a></div>";
          }

          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
