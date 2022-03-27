<?php
require_once '../connect.php'; 
require_once 'zabezpeceniAdmin.php'; 

$nazev = $_POST['nazev'];

  if($nazev == ""){
    echo "takhle asi ne...";
  }else{
    $sql = "insert into znacka (znacka_nazev) values('$nazev')";

            if ($conn->query($sql) === TRUE) {
              header("location:../index.php?mssg=1a");
              exit;
            }else{
              echo "Error: " . $sql . "<br>" . $conn->error;
            }

  }

  

?>