<?php
session_start();
require_once '../connect.php'; 

    if(isset($_SESSION["sesIDZ"])){
            $idZakaznik = $_SESSION["sesIDZ"];
            $email1 = $_SESSION["sesID1"];
            $email2 = "@@@";
            $email12 = $email2 . $email1;
            $sql = "UPDATE zakaznik set aktivni = '1',email='$email12' where id = $idZakaznik";
            if ($conn->query($sql) === TRUE) {
                session_unset();
                header("location:../index.php?uspesne=x");
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

