<?php
    require 'connect.php';
    if(isset($_POST['id_etudiant'])){
        $idEtudiant=$_POST['id_etudiant'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $stmt = $db->prepare("UPDATE `etudiants` SET `prenom`=:prenom,`nom`=:nom WHERE `id_etudiant` = :idEtudiant");
        $stmt->execute(['prenom'=>$prenom, 'nom'=>$nom, 'idEtudiant'=>$idEtudiant ]);
        header("Location: update.php?id=".$idEtudiant);
    }elseif(isset($_POST['id'])){
        $id=$_POST['id'];
        $idEtudiant=$_POST['idEleve'];
        $note = $_POST['note'];
        if(is_numeric($note)){
            if($note > 20){
                $note = 20;
            }elseif($note<0){
                $note = 0;
            }else{
                $note;
            }
            $stmt = $db->prepare("UPDATE `examens` SET `note`= :note WHERE `id` = :id");
            $stmt->execute(['note'=>$note, 'id'=>$id ]);
            header("Location: update.php?id=".$idEtudiant);
        }else{
            $idEtudiant=$_POST['idEleve'];
            header("Location: update.php?id=".$idEtudiant);  
        }
    }else{
        header("Location: index.php");  
    }