<?php

    require 'connect.php';
    $id = $_GET['id'];

    if(isset($_GET['id'])){
        $request = $db->query('SELECT `id_etudiant`,`prenom`,`nom` FROM `etudiants` WHERE `id_etudiant` =' .$id);
        $request2 = $db->query('SELECT `id`,`id_examen`,`id_etudiant`,`matiere`,`note` FROM `examens` WHERE `id_etudiant` =' .$id);
        $etudiant = $request->fetchAll(PDO::FETCH_ASSOC);
        $matieres = $request2->fetchAll(PDO::FETCH_ASSOC);
    }else{
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
    <title>EcF-El-Update</title>
    <link rel="stylesheet" href="css/output.css">
</head>
<body>
    <h1 class="text-center text-5xl text-green-300 font-bold uppercase">Update Informations</h1>

    <div class='flex justify-center my-20'>
        <h2 class="mx-8 uppercase text-2xl text-emerald-400 font-bold"><?= $etudiant[0]['prenom']?></h2>
        <h2 class="mx-8 uppercase text-2xl text-emerald-400 font-bold"><?= $etudiant[0]['nom']?></h2>
        <a href="updateInfo?id_etudiant=<?= $etudiant[0]['id_etudiant']?>" class="buttons bg-blue-500 hover:bg-blue-600">Update Personal info</a>
        <a href="delete.php?id=<?= $etudiant[0]['id_etudiant']?>"  class="buttons bg-red-500 hover:bg-red-600 focus:bg-red-500 active:bg-red-500">Delete</a>
    </div>
    <?php
            foreach($matieres as $matiere){
                echo"<div class='flex justify-center my-20'>";
                echo"<h2 class='mx-8 uppercase text-2xl text-emerald-400 font-bold'>".$matiere['matiere']."</h2>";
                echo"<h2 class='mx-8 uppercase text-2xl text-emerald-400 font-bold'>".$matiere['note']."</h2>";
                echo"<a href='updateInfo?id=". $matiere['id']."' class='buttons bg-blue-500 hover:bg-blue-600'>Update Note </a>";
                echo"<a href='deleteNote?id=". $matiere['id']."&id_etudiant=". $matiere['id_etudiant']."' class='buttons bg-red-500 hover:bg-red-600'>Delete Note </a>";
                echo"</div>";
            }
    ?>
    <div class="text-center">
        <a href='index.php' class='buttons bg-emerald-400 hover:bg-emerald-500'>Home</a>
    </div>
</body>
</html>

