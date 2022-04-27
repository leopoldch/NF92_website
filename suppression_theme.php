<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

        <?php
          $theme_name_supp = $_POST["theme_name_supp"];

          $dbhost = 'localhost:3307';
          $dbuser = 'root';
          $dbpass = '';
          $dbname = 'nf92p018';
          //Connexion à la BDD
          $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
          //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
          mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

            $name = $connect->query("SELECT * FROM theme WHERE nom='$theme_name_supp'")->fetch_object();

            if(empty($name)){
              //on vérifie d'abord si le theme qu'on souhaite supprimé est déjà dans la BDD
              //Si effectivement il ne si trouve pas, on ne peut pas le supprimer
              echo "<p>Aucun thème porte ce nom </p>";
              echo "<a href='suppression_theme.html' target='contenu'> Retour <a>";
            }
              else{
                //si il existe, alors on trouve la valeur de supprime dans name qui peut être soit 1 soit 0
                //si c'est 1, php retournera que le thèeme est déjà enregistré comme supprimé
                if($name->supprime){
                  echo"<p>Ce thème a déjà été supprimé</p>";
                  echo "<a href='suppression_theme.html' target='contenu'> Retour <a>";
                }
                else{
                  //sinon on envoie une requete pour modifier le 0 en 1 pour montrer que changer l'état de supprime
                  $query = "UPDATE theme SET supprime='1' WHERE nom='$theme_name_supp';";
                  // La ligne du dessus change la valeur du booléen supprime de 0 à 1 pour signifier que le thème est supprimé
                  $result = mysqli_query($connect, $query);
                  echo "<p> Le thème a bien était supprimée</p>";
                  echo "<a href='suppression_theme.html' target='contenu'> Retour <a>";
                }
              }
          mysqli_close($connect);


          ?>

  </body>
</html>
