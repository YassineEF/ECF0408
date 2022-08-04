<?php

    require_once 'connect.php';
    if(isset($_GET['off']) && isset($_GET['page'])){
        $off = $_GET['off'];
        $page = $_GET['page']; 
    }else{
        $off = 0;
        $page = 1;
    }

    // $request = $db->query("SELECT et.`id_etudiant`,`prenom`,`nom`, `id_examen`, `matiere`, `note` FROM `etudiants` as et INNER JOIN `examens` as ex  ON et.`id_etudiant` = ex.`id_etudiant`");
    $request = $db->query("SELECT ex.`id_etudiant`,`prenom`,`nom`, GROUP_CONCAT(matiere,' : ',note  ORDER BY  matiere SEPARATOR ',   ') as matiere FROM `etudiants` as et INNER JOIN `examens` as ex  ON et.`id_etudiant` = ex.`id_etudiant` GROUP BY ex.id_etudiant LIMIT 6 OFFSET $off");
    $request2 = $db->query("SELECT `id_etudiant`, AVG(`note`) as moyenne FROM `examens` GROUP BY `id_etudiant`");

    $etudiants = $request->fetchAll(PDO::FETCH_ASSOC);
    $moyennes = $request2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ECF El Fallouhi</title>
    <link rel="stylesheet" href="css/output.css">
</head>
<body>
    <form action="search.php" method="GET" class="text-center mt-8">
        <input type="text" name="query" placeholder="Search a student" class="p-2 text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"/>
		<input type="submit" value="Search" class="inline-block p-2 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out cursor-pointer"/>
    </form>
    <table  class="mx-auto my-12 bg-emerald-400 rounded-md">
        <tr class="border-b">
            <!-- <th class="text-sm font-medium text-gray-900 px-6 py-4 text-left">ID-Student</th> -->
            <th class="tableTh text-center">Prenom</th>
            <th class="tableTh">Nom</th>
            <th class="tableTh text-center">Matiere</th>
            <th class="tableTh">Moyenne</th>

        </tr>
        <?php
        foreach($etudiants as $etudiant ){
            foreach($moyennes as $moyenne){
                if($moyenne['id_etudiant'] == $etudiant['id_etudiant']){
                    echo"<tr>";
                        // echo"<th class='tableTh'>".$etudiant['id_etudiant']."</th>";
                        echo"<th class='tableTh'>".$etudiant['prenom']."</th>";
                        echo"<th class='tableTh'>".$etudiant['nom']."</th>";
                        echo"<th class='tableTh'>".$etudiant['matiere']."</th>";
                        echo"<th class='tableTh'>".$moyenne['moyenne']."</th>";
                        echo'<th class="tableTh"><a href="update.php?id='.$etudiant['id_etudiant'].'"  class="buttons bg-blue-500 hover:bg-blue-600 focus:bg-blue-500 active:bg-blue-500">Update</a></th>';
                        echo'<th class="tableTh"><a href="delete.php?id='.$etudiant['id_etudiant'].'"  class="buttons bg-red-500 hover:bg-red-600 focus:bg-red-500 active:bg-red-500">Delete</a></th>';
                    echo"</tr>";
                }
            }
        }
        ?>
    </table>
    <div class="flex justify-between mx-20">
        <?php 
            if($off == 0){
                echo'<a href="#" class="buttons bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-500 active:bg-emerald-500">No Previous</a>';
                
            }else{
                
                ?>
        <a href="index.php?off=<?= $off-6 ?>&page=<?= $page-1 ?>" class="buttons bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-500 active:bg-emerald-500">Previous</a>
        <?php
        }
        ?>
        <p class="uppercase text-emerald-400 font-bold text-xl">Page <?= $page?></p>
        <?php
        if(count($etudiants) < 6){            
            echo'<a href="#" class="buttons bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-500 active:bg-emerald-500">No Next</a>';
        }else{
            ?>
        <a href="index.php?off=<?= $off+6 ?>&page=<?= $page+1 ?>" class="buttons bg-emerald-500 hover:bg-emerald-600 focus:bg-emerald-500 active:bg-emerald-500">Next</a>
        <?php
            }
            ?>
    </div>
</body>
</html>