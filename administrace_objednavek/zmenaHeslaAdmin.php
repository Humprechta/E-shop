<?php
session_start();
require_once '../connect.php';


if(isset($_SESSION["sesID1"])){
    if($_SESSION["sesA"] != 'superuser44'){
          echo "fatall err";
          exit;
      }

         $p1 = $_POST['psswd'];
        $p2 = $_POST['psswd1'];
        if($p1 == $p2){
            $psswd = sha1($p1);
            $sql = "UPDATE zakaznik SET heslo = '$psswd' WHERE prijmeni = 'admin'";
        }else{
            header("location:administrace.php?err=1");
        }
        
    

   

        if ($conn->query($sql) === TRUE) {
            header("location:administrace.php?povedlose=3");
        echo " Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    $conn->close();

}
exit;

?>