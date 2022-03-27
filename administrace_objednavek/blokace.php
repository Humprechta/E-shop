<?php
session_start();
require_once '../connect.php';


if(isset($_SESSION["sesID1"])){
    if($_SESSION["sesA"] != 'superuser44'){
          echo "fatall err";
          exit;
      }

    $id = $_POST['id'];
     //echo "stav objednavky: ".$stav." id: ".$id;
    $sql = "UPDATE zakaznik SET aktivni = '1' WHERE id = $id";

   

        if ($conn->query($sql) === TRUE) {
            header("location:administrace.php?povedlose=x");
        echo " Record updated successfully";
        } else {
        echo "Error updating record: " . $conn->error;
        }

    $conn->close();

}
exit;

?>