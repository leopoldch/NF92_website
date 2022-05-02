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

          $prenom =$_POST["prenom"];
          $nom=$_POST["nom"];
          $bdate=$_POST["bdate"];
          $valider=$_POST['valider'];
          $genre = $_POST['genre'];

          $prenom = mysqli_real_escape_string($connect, $prenom);
          $nom = mysqli_real_escape_string($connect, $nom);
          $bdate = mysqli_real_escape_string($connect, $bdate);
          $genre = mysqli_real_escape_string($connect, $genre);
          $valider = mysqli_real_escape_string($connect, $valider);

          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");

          if ($valider == 1){
            //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
            $query = "INSERT INTO eleves VALUES (NULL,"."'$nom'".","."'$prenom'".","."'$bdate'".","."'$date'".","."'$genre'".")";
            $result = mysqli_query($connect, $query);
            // $query utilise comme parametre de mysqli_query
            // le test ci-dessous est desormais impose pour chaque appel de :
            // mysqli_query($connect, $query)
            echo "<p>L'inscription a bien été prise en compte</p>";
            echo "<br><a href='ajout_eleve.html'><input class='buttonclick'type='button' value='retour'/></a><br>";
            echo "<a href='suppression_theme.php'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }
          else{
            echo "<p>L'inscription a bien été annulée</p>";
            echo "<br><a href='ajout_eleve.html'><input class='buttonclick'type='button' value='retour'/></a><br>";
            echo "<a href='bienvenue.html'><input class='buttonclick' type='button' value='Accueil' /></a>";
          }

          mysqli_close($connect);


          ?>
          <footer>
            <p class="copyright">Auto école © 2022</p>
          </footer>

  </body>
</html>
