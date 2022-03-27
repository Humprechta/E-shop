<?php
session_start();
require_once '../connect.php';


if(isset($_SESSION["sesID1"])){
    if($_SESSION["sesA"] != 'superuser44'){
          echo "fatall err";
          exit;
      }

      $datum = date("Y-m-d");

      

    $id = $_POST['objednavka_bota_id'];
    $stav = $_POST['pocetNove'];
    $orderby = $_POST['orderby'];
   //echo"id: ".$id;
      //echo"stav: ".$stav;
     // die;
    if($stav == 1 or $stav == 2 or $stav == 3){
        $sql = "UPDATE objednavka SET stav_objednavky = '$stav',prevzato = '0000-00-00' WHERE id=(select id_objednavka from objednavka_bota where id =$id)";
    }else{
        $sql = "UPDATE objednavka SET stav_objednavky = '$stav',prevzato = '$datum'  WHERE id=(select id_objednavka from objednavka_bota where id =$id)";
    }
     //echo "stav objednavky: ".$stav." id: ".$id;
    
    if($orderby=='idecko'){
        $orderby = '3';
    }
    if($orderby=='stav_objednavky'){
        $orderby = '1';
    }
    if($orderby=='stav_objednavky desc'){
        $orderby = '2';
    }
    if($orderby=='idecko desc'){
        $orderby = '0';
    }
     
   

        if ($conn->query($sql) === TRUE) {
        header("location:administrace.php?povedlose=1&razeni=$orderby");
        echo " Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    $conn->close();

}
exit;

?>