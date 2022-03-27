<?php
session_start();
require_once '../connect.php'; 

    if(isset($_SESSION["sesID1"])){
        $datum = date("Y-m-d");
            $idObjednavky = $_POST["zrus"];
            //echo $idObjednavky." ";
            //die;

            $select_objednavka = $conn->query("SELECT nazev,velikost,pocet_ks from objednavka_bota 
            inner join objednavka on id_objednavka = objednavka.id
            where objednavka.id = $idObjednavky"); 
                    
         if ($select_objednavka->num_rows > 0) {
           while($row = $select_objednavka->fetch_assoc()) {
            $nazev = $row['nazev'];
            $velikost = $row['velikost'];
            $pocet_ks_zrusenych = $row['pocet_ks'];

            //echo $nazev." ".$velikost." ".$pocet_ks_zrusenych;
            
            $sql = "UPDATE velikost_pocet set pocet_ks = pocet_ks + '$pocet_ks_zrusenych',blokovano = blokovano - '$pocet_ks_zrusenych' 
            where id_bota =(select bota.id from bota where id = '$idObjednavky') and velikost = $velikost";

            if ($conn->query($sql) === TRUE) {
                //echo "Record updated successfully";
            } else {
                //header("location:administrace.php?err=405&1");
              echo "Error updating record: " . $conn->error;
              die;
              exit;
            }
           }
        }

            $sql = "UPDATE objednavka set stav_objednavky = '0',prevzato='$datum' where id = $idObjednavky";
            if ($conn->query($sql) === TRUE) {
                header("location:administrace.php?povedlose=xs");
                exit;
                echo "Record updated successfully";
            } else {
                header("location:administrace.php?err=405&2");
                exit;
              echo "Error updating record: " . $conn->error;
            }
    }
    header("location:administrace.php?err=405&3");
    exit;

?>