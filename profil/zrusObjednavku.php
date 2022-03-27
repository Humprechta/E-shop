<?php
session_start();
require_once '../connect.php'; 

    if(isset($_SESSION["sesIDZ"])){
            $idZakaznik = $_SESSION["sesIDZ"];
            $idObjednavky = $_POST["zrus"];

            $select_objednavka = $conn->query("SELECT nazev,velikost,pocet_ks from objednavka_bota where id_objednavka = $idObjednavky"); 
                    
         if ($select_objednavka->num_rows > 0) {
           while($row = $select_objednavka->fetch_assoc()) {
            $nazev = $row['nazev'];
            $velikost = $row['velikost'];
            $pocet_ks_zrusenych = $row['pocet_ks'];

            $sql = "UPDATE velikost_pocet set pocet_ks = pocet_ks + '$pocet_ks_zrusenych' ,blokovano = blokovano - '$pocet_ks_zrusenych'
            where id_bota =(select bota.id from bota where id = '$idObjednavky') and velikost = $velikost";

            if ($conn->query($sql) === TRUE) {
                //echo "Record updated successfully";
            } else {
                header("location:profil.php?err=405");
              echo "Error updating record: " . $conn->error;
              exit;
            }
           }
        }

            $sql = "UPDATE objednavka set stav_objednavky = '0' where id = $idObjednavky";
            if ($conn->query($sql) === TRUE) {
                header("location:profil.php?uspesne=x");
                exit;
                echo "Record updated successfully";
            } else {
                header("location:profil.php?err=405");
                exit;
              echo "Error updating record: " . $conn->error;
            }
    }
    header("location:profil.php?err=405");
    exit;

?>