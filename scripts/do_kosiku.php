<?php
session_start();
require_once '../connect.php'; 

if(isset($_POST["pridat"])){ 

    $idProduktu = $_POST["id"];
    $idVelikosti = $_POST["vybranaVelikost"];
    $pocet = $_POST["pocet"];
    $idZakaznik = $_SESSION["sesIDZ"];

    if($idVelikosti == "0"){
      exit;
    }

    $sql = "insert into kosik (zakaznik_id,bota_id,počet,velikost) values('$idZakaznik','$idProduktu','$pocet','$idVelikosti')";
  
      if ($conn->query($sql) == TRUE) {
        header("location:../index.php?uspesne=3");
                exit;
      }else{
        header("location:../index.php?err=405");
      exit;
      }

    echo "id produktu: ".$idProduktu." id velikoasti produktu: ".$idVelikosti." pocet ks: ".$pocet ." id zakaznika: ".$idZakaznik;
    exit;

  }




?>