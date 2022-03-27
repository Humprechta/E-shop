<?php
require_once '../connect.php'; 
require_once 'zabezpeceniAdmin.php'; 

if(isset($_POST["tst"])){ 

    $kusu = $_POST['kusu'];
    $velikost = $_POST['velikost'];
    $id = $_POST['id'];
  
    $sql = "insert into velikost_pocet (pocet_ks,velikost,id_bota,blokovano) values('$kusu','$velikost','$id','0')";
  
              if ($conn->query($sql) == TRUE) {
                header("location:../index.php?mssg=1a");
                exit;
              }else{
                echo "Error: " . $sql . "<br>" . $conn->error;
              }
  
  }else{}


?>