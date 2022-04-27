<html>
    <body>

        <?php

        $dbhost = 'localhost:3307';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'nf92p018';
        //Connexion à la base de donnée avec le nom, le mot de passe, le lien et le nom de la base de donnée concernée.
        $connect = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ('Error connecting to mysql');
        //la ligne suivante permet d'éviter les problèmes d'accent entre la page web et le serveur mysql
        mysqli_set_charset($connect, 'utf8'); //les données envoyées vers mysql sont encodées en UTF-8

          $theme_name =$_POST["theme_name"];
          $description=$_POST["description"];
          $supprime=0;
          /*on récupère les données du formulaire HTML et on affecte par défaut la valeur 0 à supprime
          pour siginifer que par défaut l'élement n'est pas supprimé */

          if (empty($theme_name)){
            echo "<p> Veuillez rentrer le theme de votre séance </p>";
            echo "<a href='ajout_theme.html' target='contenu'> Retour <a>";
            exit();
          }
          /*Les lignes précédentes permettent de s'assurer que l'utilisateur rentre bien quelque chose dans le champ textuel pour
          éviter tout problème avec la base de donnée */


          //code de vérification si le nom n'existe pas déjà dans la BDD
          $name = $connect->query("SELECT * FROM theme WHERE nom='$theme_name'")->fetch_object();


          if (!empty($name)){
          /*teste si il y a bien une valeur dans ou non qui correspond au même nom*/
            if ($name->supprime){
            // Si la valeur est présente alors on regarde si elle est suprimée ou non
              $query3 = "UPDATE theme SET supprime='0' WHERE nom='$theme_name';";
              //si oui on lui affecte 0 pour montrer qu'elle n'est plus supprimée
              $result3 = mysqli_query($connect, $query3);//envoie la requête à la BDD
              echo "<p> Le thème a bien été remis à jour </p>";
            }
            else {
              /* sinon on indique que la valeur est déjà dans la base de données */
              echo "<p> Le thème est déjà dans la base de donnée </p>";
            }
          }
          else{
            //Si le même nom n'est pas présent dans la base de données alors on l'ajoute
            $query = "INSERT INTO theme VALUES (NULL,"."'$theme_name'".","."'$supprime'".","."'$description'".")";
            $result = mysqli_query($connect, $query); //envoie la requête à la BDD
            echo "<p> Votre thème a bien été enregistré</p>";
          }



          mysqli_close($connect);

          ?>

  </body>
</html>
