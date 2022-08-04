<?php

    require 'connect.php';
    $id = $_GET['id'];
    $idEtudiant = $_GET['id_etudiant'];
    
    if(isset($_GET['id'])){
        $stmt = $db->prepare(' DELETE  FROM `examens`  WHERE `id` = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        header("Location: update.php?id=".$idEtudiant);
    }else{
        echo"<h2>Error, aucun identifiant etudiant trouvée</h2>";
        echo'<a href="index.php"  class="buttons bg-blue-500 hover:bg-blue-600 focus:bg-blue-500 active:bg-blue-500">Home</a>';
    }