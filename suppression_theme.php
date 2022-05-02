<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un thème</title>
</head>
<body>
    <h1 class="title">Suppression d'un thème</h1>
    <!--Création d'un formulaire en HTML avec le nom du thème à supprimer   -->
    <?php
    include('connexion.php');

      date_default_timezone_set('europe/paris');
      $aujourdhui = date("Y-m-d");

      $result = mysqli_query($connect,"SELECT * FROM theme WHERE supprime = 0");

      $resultCount=mysqli_num_rows($result);

      if($resultCount == 0){
        echo"<p>il faut ajouter un thème pour pouvoir en supprimer</p>";
        echo "<a href='ajout_theme.html'><input class='buttonclick'type='button' value='ajouter un thème'/></a>";
        echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
      }
      else{
        echo "<form method='post' action='supprimer_theme.php'>";
        echo "<fieldset style='width: 50%; height: 15%'>";
        echo "<label for='theme_supp'> Veuillez selectionner la séance à supprimer </label>";
        echo "<select name='theme_supp' id='theme_supp' size='4' style='width:20%; text-align: center'>";

        /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
        while($response = mysqli_fetch_array($result)) {
          echo "<option value=".$response['idtheme'].">".$response['nom']."</option>";
        }

        echo "</select><br><br>";
        echo "<input type='submit' value='Valider la suppression'>";
        echo "</form>";
        echo "</fieldset>";



      }

     ?>

     <footer>
       <p class="copyright">Auto école © 2022</p>
     </footer>

</body>
</html>
