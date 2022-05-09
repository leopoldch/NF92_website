<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class='all_pages'>
  <h1 class="title">Suppression d'un thème</h1>

        <?php

        include('connexion.php');



            if(empty($_POST['theme_supp'])){
              //on vérifie d'abord si le theme qu'on souhaite supprimé est déjà dans la BDD
              //Si effectivement il ne si trouve pas, on ne peut pas le supprimer
              echo "<div class='retour'";
              echo "<p>Attention : Veuillez à bien selectionner un thème  </p>";
              echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
              echo "<a class='space' href='suppression_theme.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
            }
              else{
                  $idtheme = $_POST['theme_supp'];
                  $idtheme = mysqli_real_escape_string($connect, $idtheme);
                  $idtheme = htmlspecialchars($idtheme);

                  $query = "UPDATE theme SET supprime='1' WHERE idtheme='$idtheme';";
                  if (!$query){
                    echo "<br>erreur".mysqli_error($connect);
                    exit;
                    }
                  // La ligne du dessus change la valeur du booléen supprime de 0 à 1 pour signifier que le thème est supprimé
                  $result = mysqli_query($connect, $query);
                  echo "<div class='retour'";
                  echo "<p> Le thème a bien était supprimé</p>";
                  echo "<a class='space' href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
                  echo "<a class='space' href='suppression_theme.php'><input class='buttonclick'type='button' value='Retour'/></a></div>";
              }
          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright"><?php  include('footer.php'); ?></p>
          </footer>

  </body>
</html>
