<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppression d'un thème</title>
</head>
<body class='all_pages'>
    <h1 class="title">Suppression d'un thème</h1>
    <!--Création d'un formulaire en HTML avec le nom du thème à supprimer   -->
    <?php
    include('connexion.php');

      date_default_timezone_set('europe/paris');
      $aujourdhui = date("Y-m-d");

      //on sélectionne les thèmes qui ne sont pas encore supprimés

      $result = mysqli_query($connect,"SELECT * FROM theme WHERE supprime = 0");

      if (!$result){
        echo "<br>erreur".mysqli_error($connect);
        exit;
        }

      $resultCount=mysqli_num_rows($result);

      // si il n'y a pas de thèmes à supprimer on affiche un message d'erreur

      if($resultCount == 0){
        echo "<div class='retour'>";
        echo"<p>Attention : Il faut ajouter un thème pour pouvoir en supprimer</p>";
        echo "<a class='space' href='bienvenue.html'><input class='formbutton' type='button' value='Accueil' /></a>";
        echo "<a class='space' href='ajout_theme.html'><input class='formbutton'type='button' value='Ajout thème'/></a></div>";
      }
      else{
        //sinon on propose de selectionner un de thème pour le supprimer cf envoyer à l'autre formulaire 
        echo "<fieldset >";
        echo "<legend><p>Supprimer un thème</p></legend>";
        echo "<form method='post' action='supprimer_theme.php'>";
        echo "<p style='margin-bottom:-1%;'> Veuillez selectionner la séance à supprimer :</p><br>";
        echo "<select name='theme_supp' size='4' style='width:20%; text-align: center; margin-bottom:5%;'>";

        /*Tant qu'on a des choses qui rentrent dans notre tableau alors on va afficher les noms qu'on récupère dans une balise <select> en html*/
        while($response = mysqli_fetch_array($result)) {
          echo "<option value=".$response['idtheme'].">".$response['nom']."</option>";
        }

        echo "</select><br><br>";
        echo "<input class='formbutton' type='submit' value='Valider'>";
        echo "</form>";
        echo "</fieldset>";



      }

     ?>

     <footer>
       <p class="copyright"><?php  include('footer.php'); ?></p>
     </footer>

</body>
</html>
