<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

        <?php

        $dbhost = 'localhost:3307';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'nf92p018';
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

          $prenom =$_POST["fname"];
          $nom=$_POST["lname"];
          $bdate=$_POST["bdate"];
          $genre=$_POST["genre"];
          //récu^pération des données qui proviennent du formulaire html

          date_default_timezone_set('Europe/Paris');
          $date = date("Y-m-d");

          //vérification que les champs soient non vides, c'est une seconde vérification en plus du required dans la balise html
          if (empty($nom) or empty($prenom)) {
            echo "<p> Veuillez saisir votre nom ainsi que votre votre prénom </p>";
            echo "<a href='ajout_eleve.html' target='contenu'> Retour <a>";
          }
          else{
            //vérification du nom dans la BDD pour voir si il n'y est pas déjà
            $query = "SELECT * FROM eleves WHERE nom ='$nom' and prenom='$prenom'";
            $result = mysqli_query($connect, $query);
            $response=mysqli_fetch_array($result);

            if($response){
              if ($response['nom'] == $nom and $response['prenom'] == $prenom ){
                echo "<p> Le nom de cet élève est déjà présent dans la base de données</p>";
                echo "<form method='POST' action='valider_eleve.php'>";
                echo "<input type='hidden' name='nom' value ='".$nom."'>";
                echo "<input type='hidden' name='prenom' value ='".$prenom."'>";
                echo "<input type='hidden' name='bdate' value ='".$bdate."'>";
                echo "<input type='hidden' name='genre' value ='".$genre."'>";
                echo "<label for='valider1'> Valider l'ajout</label>";
                echo "<input type='radio' name='valider' id='valider1' selected value='1'><br><br>";
                echo "<label for='valider2'> Annuler l'ajout</label>";
                echo "<input type='radio' name='valider' id='valider2' value='2'><br><br>";
                echo "<input type='submit' value='Valider'>";
                echo "<input type='reset'>";
              }
              else{
                //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
                $query = "INSERT INTO eleves VALUES (NULL,"."'$nom'".","."'$prenom'".","."'$bdate'".","."'$date'".","."'$genre'".")";
                $result = mysqli_query($connect, $query);
                // $query utilise comme parametre de mysqli_query
                // le test ci-dessous est desormais impose pour chaque appel de :
                // mysqli_query($connect, $query)
                echo "<p>Votre inscription a bien été prise en compte</p>";
            }
            }
            else{
              //si l'utilisateur a bien rempli son nom et son prénom alors on envoie les informations vers la BDD
              $query = "INSERT INTO eleves VALUES (NULL,"."'$nom'".","."'$prenom'".","."'$bdate'".","."'$date'".")";
              $result = mysqli_query($connect, $query);
              // $query utilise comme parametre de mysqli_query
              // le test ci-dessous est desormais impose pour chaque appel de :
              // mysqli_query($connect, $query)
              echo "<p>Votre inscription a bien été prise en compte</p>";
          }
          }

          mysqli_close($connect);


          ?>

  </body>
</html>
