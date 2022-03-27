<?php
session_start();
require_once '../connect.php'; 

    if(isset($_POST['firstname'])){

    $jmeno = $_POST['firstname'];
    $prijmeni = $_POST['lastname'];
    $adresa = $_POST['adress'];
    $tel = $_POST['tel'];
    $e = $_POST['email'];
    $zeme = $_POST['radio'];
    $pohlave = $_POST['radio2'];

    $idZakaznik = $_SESSION["sesIDZ"];

    $sql = "UPDATE zakaznik set jmeno = '$jmeno',prijmeni = '$prijmeni',adresa = '$adresa',tel = '$tel',email = '$e',zem = '$zeme',pohlave = '$pohlave'
            where id=$idZakaznik";

                        if ($conn->query($sql) === TRUE) {
                            header("location:profil.php?uspesne=4");
                            //echo "Record updated successfully";
                            exit;
                        } else {
                            header("location:profil.php?err=405");
                            //echo "Error updating record: " . $conn->error;
                            exit;
                        }
                    }else{
                        exit;
                    }
                    


?>