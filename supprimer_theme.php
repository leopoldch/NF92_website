<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  <h1 class="title">Suppression d'un thème</h1>

        <?php

        $dbhost = 'tuxa.sme.utc/pma/';
        $dbuser = 'nf92p018';
        $dbpass = 'vE5DSom3';
        $dbname = 'nf92p018';
          //Connexion à la BDD
          $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
          //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
          mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8



            if(empty($_POST['theme_supp'])){
              //on vérifie d'abord si le theme qu'on souhaite supprimé est déjà dans la BDD
              //Si effectivement il ne si trouve pas, on ne peut pas le supprimer
              echo "<p>Veuillez à bien selectionner un thème  </p>";
              echo "<a href='suppression_theme.php' target='contenu'> Retour <a>";
            }
              else{
                  $idtheme = $_POST['theme_supp'];
                  $query = "UPDATE theme SET supprime='1' WHERE idtheme='$idtheme';";
                  // La ligne du dessus change la valeur du booléen supprime de 0 à 1 pour signifier que le thème est supprimé
                  $result = mysqli_query($connect, $query);
                  echo "<p> Le thème a bien était supprimée</p>";
                  echo "<a href='suppression_theme.php' target='contenu'> Retour <a>";
              }
          mysqli_close($connect);


          ?>

  </body>
</html>
