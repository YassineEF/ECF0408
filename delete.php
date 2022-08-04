<?php

    require 'connect.php';
    $id = $_GET['id'];

    
    if(isset($_GET['id'])){
        $stmt = $db->prepare(' DELETE et, ex FROM `examens` as ex INNER JOIN `etudiants` as et ON ex.`id_etudiant` = et.`id_etudiant` WHERE et.`id_etudiant` = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        header("Location: index.php");
    }else{
        echo"<h2>Error, aucun identifiant etudiant trouvée</h2>";
        echo'<a href="index.php"  class="buttons bg-blue-500 hover:bg-blue-600 focus:bg-blue-500 active:bg-blue-500">Home</a>';
    }