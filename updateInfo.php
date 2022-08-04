<?php

    require 'connect.php';
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $request = $db->query('SELECT `id`,`id_examen`,`id_etudiant`,`matiere`,`note` FROM `examens` WHERE `id` =' .$id);
        $note = $request->fetchAll(PDO::FETCH_ASSOC);

    }elseif(isset($_GET['id_etudiant'])){
        $idetudiant = $_GET['id_etudiant'];
        $request = $db->query('SELECT `id_etudiant`,`prenom`,`nom` FROM `etudiants` WHERE `id_etudiant` =' .$idetudiant);
        $etudiant = $request->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        echo"<h2>Error, aucun identifiant etudiant trouvée</h2>";
        echo'<th class="tableTh"><a href="index.php"  class="buttons bg-blue-500 hover:bg-blue-600 focus:bg-blue-500 active:bg-blue-500">Home</a></th>';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ecf-El-InfoUpdate</title>
    <link rel="stylesheet" href="css/output.css">
</head>
<body>
    <h1 class="text-center text-5xl text-green-300 font-bold uppercase">Update Informations</h1>
    <form action="updateDB.php" method="post" class="text-center my-12">
        <?php
        if(isset($note)){
            echo '<input type="hidden" name="id"  value="'.$note[0]['id'].'">';
            echo '<input type="hidden" name="idEleve"  value="'.$note[0]['id_etudiant'].'">';
            echo'<h2 class="uppercase text-2xl text-emerald-400 font-bold">'.$note[0]['matiere'].'</h2>';
            echo'<input type="text" name="note" value="'.$note[0]['note'].'" class="p-2 text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">';
            
        }elseif(isset($etudiant)){
            echo'<h2 class="uppercase text-2xl text-emerald-400 font-bold">Nom et prenom</h2>';
            echo '<input type="hidden" name="id_etudiant"  value="'.$etudiant[0]['id_etudiant'].'">';
            echo'<input type="text" name="prenom" value="'.$etudiant[0]['prenom'].'" class="p-2 text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">';
            echo'<input type="text" name="nom" value="'.$etudiant[0]['nom'].'" class="p-2 text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">';
        }
    ?>
    <input type="submit" value="Update" class="inline-block p-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out cursor-pointer"/>

    </form>
</body>
</html>
