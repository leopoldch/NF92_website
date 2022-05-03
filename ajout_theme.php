<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class='title'>Ajouter un thème</h1>

        <?php

        include('connexion.php');

          $theme_name =$_POST["theme_name"];
          $description=$_POST["description"];

          $theme_name = mysqli_real_escape_string($connect, $theme_name);
          $description = mysqli_real_escape_string($connect, $description);

          $supprime=0;
          /*on récupère les données du formulaire HTML et on affecte par défaut la valeur 0 à supprime
          pour siginifer que par défaut l'élement n'est pas supprimé */

          if (empty($theme_name)){
            echo "<div class='retour'>";
            echo "<p>Attention : Veuillez rentrer le theme de votre séance.</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_theme.html'><input class='buttonclick'type='button' value='Ajouter un autre thème'/></a></div>";
            exit();
          }
          /*Les lignes précédentes permettent de s'assurer que l'utilisateur rentre bien quelque chose dans le champ textuel pour
          éviter tout problème avec la base de donnée */


          //code de vérification si le nom n'existe pas déjà dans la BDD
          $result = mysqli_query($connect,"SELECT * FROM theme WHERE nom='$theme_name'");
          if (!$result){
            echo "<br>erreur".mysqli_error($connect);
            exit;
            }
          $array = mysqli_fetch_array($result);

          if ($array){
          /*teste si il y a bien une valeur dans ou non qui correspond au même nom*/
            if ($array['supprime']){
            // Si la valeur est présente alors on regarde si elle est suprimée ou non
              $query3 = "UPDATE theme SET supprime='0' WHERE nom='$theme_name';";
              //si oui on lui affecte 0 pour montrer qu'elle n'est plus supprimée
              $result3 = mysqli_query($connect, $query3);//envoie la requête à la BDD
              if (!$result3){
                echo "<br>erreur".mysqli_error($connect);
                exit;
                }
              echo "<div class='retour'>";
              echo "<p> Le thème a bien été remis à jour </p>";
              echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
              echo "<a class='space' href='ajout_theme.html'><input class='buttonclick'type='button' value='Ajout thème'/></a></div>";
            }
            else {
              /* sinon on indique que la valeur est déjà dans la base de données */
              echo "<div class='retour'>";
              echo "<p>Attention : Le thème est déjà dans la base de donnée.</p>";
              echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
              echo "<a class='space' href='ajout_theme.html'><input class='buttonclick'type='button' value='Ajout thème '/></a></div>";

            }
          }
          else{
            //Si le même nom n'est pas présent dans la base de données alors on l'ajoute
            $query = "INSERT INTO theme VALUES (NULL,"."'$theme_name'".","."'$supprime'".","."'$description'".")";
            $result = mysqli_query($connect, $query); //envoie la requête à la BDD
            if (!$result){
              echo "<br>erreur".mysqli_error($connect);
              exit;
              }
            echo "<div class='retour'>";
            echo "<p> Votre thème a bien été enregistré</p>";
            echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
            echo "<a class='space' href='ajout_theme.html'><input class='buttonclick'type='button' value='Ajout thème'/></a></div>";
          }



          mysqli_close($connect);

          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>
  </body>
</html>
